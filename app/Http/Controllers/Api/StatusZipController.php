<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use ubl21dian\Templates\SOAP\GetStatus;
use ubl21dian\Templates\SOAP\GetStatusZip;
use App\Http\Requests\Api\StatusZipRequest;
use Storage;

class StatusZipController extends Controller
{
    /**
     * Document.
     *
     * @param StatusZipRequest $request
     *
     * @return array
     */
    public function statuszip(StatuszipRequest $request)
    {
        try {
            if (!base64_decode($request->certificate, true)) {
                throw new Exception('The given data of the certificate was invalid.');
            }
            if (!openssl_pkcs12_read($certificateBinary = base64_decode($request->certificate), $certificate, $request->password)) {
                throw new Exception('The certificate could not be read.');
            }
        } catch (Exception $e) {
            if (false == ($error = openssl_error_string())) {
                return response([
                    'message' => $e->getMessage(),
                    'errors' => [
                        'errors' => 'The base64 encoding is not valid.',
                    ],
                ], 422);
            }

            return response([
                'message' => $e->getMessage(),
                'errors' => [
                    'certificate' => $error,
                    'password' => $error,
                ],
            ], 422);
        }

        $name = "{$request->password}.p12";
        Storage::put("certificates/{$name}", $certificateBinary);

        if($request->ambiente == 'HABILITACION')
            $getStatus = new GetStatusZip(storage_path("app/certificates/".$name), $request->password, 'https://vpfe-hab.dian.gov.co/WcfDianCustomerServices.svc');
        else
            $getStatus = new GetStatusZip(storage_path("app/certificates/".$name), $request->password, 'https://vpfe.dian.gov.co/WcfDianCustomerServices.svc');

        $getStatus->trackId = $request->zipkey;

        if (!is_dir(storage_path("app/public/{$request->password}"))) {
                mkdir(storage_path("app/public/{$request->password}"));
            }
            
        return [
            'message' => 'Consulta generada con éxito',
            'ResponseDian' => $getStatus->signToSend(storage_path("app/public/{$request->password}/ReqZIP-".$request->zipkey.".xml"))->getResponseToObject(storage_path("app/public/{$request->password}/RptaZIP-".$request->zipkey.".xml")),
        ];
    }
}

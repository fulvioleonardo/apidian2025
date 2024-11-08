<ext:UBLExtensions>
    <ext:UBLExtension>
        <ext:ExtensionContent>
            <FabricanteSoftware>
                <InformacionDelFabricanteDelSoftware>
                    <Name>NombreApellido</Name>
                    <Value>{{$request['software_manufacturer']['name']}}</Value>
                    <Name>RazonSocial</Name>
                    <Value>{{$request['software_manufacturer']['business_name']}}</Value>
                    <Name>NombreSoftware</Name>
                    <Value>{{$request['software_manufacturer']['software_name']}}</Value>
                </InformacionDelFabricanteDelSoftware>
            </FabricanteSoftware>
        </ext:ExtensionContent>
    </ext:UBLExtension>
    <ext:UBLExtension>
        <ext:ExtensionContent>
            <BeneficiosComprador>
                <InformacionBeneficiosComprador>
                    <Name>Codigo</Name>
                    <Value>{{$request['buyer_benefits']['code']}}</Value>
                    <Name>NombresApellidos</Name>
                    <Value>{{$request['buyer_benefits']['name']}}</Value>
                    <Name>Puntos</Name>
                    <Value>{{$request['buyer_benefits']['points']}}</Value>
                </InformacionBeneficiosComprador>
            </BeneficiosComprador>
        </ext:ExtensionContent>
    </ext:UBLExtension>
    <ext:UBLExtension>
        <ext:ExtensionContent>
            <PuntoVenta>
                <InformacionCajaVenta>
                    <Name>PlacaCaja</Name>
                    <Value>{{$request['cash_information']['plate_number']}}</Value>
                    <Name>UbicaciónCaja</Name>
                    <Value>{{$request['cash_information']['location']}}</Value>
                    <Name>Cajero</Name>
                    <Value>{{$request['cash_information']['cashier']}}</Value>
                    <Name>TipoCaja</Name>
                    <Value>{{$request['cash_information']['cash_type']}}</Value>
                    <Name>CódigoVenta</Name>
                    <Value>{{$request['cash_information']['sales_code']}}</Value>
                    <Name>SubTotal</Name>
                    <Value>{{$request['cash_information']['subtotal']}}</Value>
                </InformacionCajaVenta>
            </PuntoVenta>
        </ext:ExtensionContent>
    </ext:UBLExtension>
    <ext:UBLExtension>
        <ext:ExtensionContent>
            <sts:DianExtensions>
                @isset($resolution)
                    @if (preg_replace("/[\r\n|\n|\r]+/", "", $resolution->type_document_id) === '1' || preg_replace("/[\r\n|\n|\r]+/", "", $resolution->type_document_id) === '2' || preg_replace("/[\r\n|\n|\r]+/", "", $resolution->type_document_id) === '3' || preg_replace("/[\r\n|\n|\r]+/", "", $resolution->type_document_id) === '11' || preg_replace("/[\r\n|\n|\r]+/", "", $resolution->type_document_id) === '15')
                        @includeWhen($resolution->resolution, 'xml._invoice_control')
                    @endif
                @endisset
                <sts:InvoiceSource>
                    <cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.1">{{preg_replace("/[\r\n|\n|\r]+/", "", $company->country->code)}}</cbc:IdentificationCode>
                </sts:InvoiceSource>
                <sts:SoftwareProvider>
                    <sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" @if (preg_replace("/[\r\n|\n|\r]+/", "", $company->type_document_identification_id) === '6' || preg_replace("/[\r\n|\n|\r]+/", "", $company->type_document_identification_id) === '3') schemeID="{{preg_replace("/[\r\n|\n|\r]+/", "", $company->dv)}}" @endif @if (preg_replace("/[\r\n|\n|\r]+/", "", $company->type_document_identification_id) === '6' || preg_replace("/[\r\n|\n|\r]+/", "", $company->type_document_identification_id) === '3') schemeName="31" @else schemeName="{{preg_replace("/[\r\n|\n|\r]+/", "", $company->type_document_identification->code)}}" @endif >{{preg_replace("/[\r\n|\n|\r]+/", "", $company->identification_number)}}</sts:ProviderID>
                    <sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)">{{preg_replace("/[\r\n|\n|\r]+/", "", $company->software->identifier_eqdocs)}}</sts:SoftwareID>
                </sts:SoftwareProvider>
                <sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)"/>
                <sts:AuthorizationProvider>
                    <sts:AuthorizationProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeID="4" schemeName="31">800197268</sts:AuthorizationProviderID>
                </sts:AuthorizationProvider>
                @if(isset($QRCode))
                    <sts:QRCode>{{$QRCode}}</sts:QRCode>
                @endif
            </sts:DianExtensions>
        </ext:ExtensionContent>
    </ext:UBLExtension>
    <ext:UBLExtension>
        <ext:ExtensionContent/>
    </ext:UBLExtension>
</ext:UBLExtensions>


<table width="100%">
    <tr>
        <td style="width: 23%;" class="text-center vertical-align-top">
            <div id="reference">
                <br>
                <br>
                <br>
                <p style="color: black; font-weight: bold; font-size: 11px;">DOCUMENTO SOPORTE A NO OBLIGADOS No.</p>
                <p style="color: black;
                    font-weight: bold;
                    font-size: 11px;">{{$resolution->prefix}} - {{$request->number}}</p>
                    <br>
                <p>Fecha Validación DIAN: {{$date}}<br>
                    Hora Validación DIAN: {{$time}}</p>
            </div>
        </td>
        <td style="width: 60%; padding: 0 1rem;" class="text-center vertical-align-top">
            <div id="empresa-header">
                <p style="color: black; font-weight: bold; font-size: 14px; margin-bottom: 2px; padding: 0px 0px 0px 0px;">{{$user->name}}</p>
                @if(isset($request->establishment_name) && $request->establishment_name != 'Oficina Principal')
                    <p style="color: black; font-weight: bold; font-size: 14px; margin-bottom: 2px; padding: 0px 0px 0px 0px;">{{$request->establishment_name}}</p>
                @endif
            </div>
            <div id="empresa-header1">
                @if(isset($request->ivaresponsable))
                    @if($request->ivaresponsable != $company->type_regime->name)
                        <p style="color: black; font-weight: bold; font-size: 12px; margin-bottom: 2px; padding: 0px 0px 0px 0px;">NIT: {{$company->identification_number}}-{{$company->dv}}</p>
                        <p style="color: black; font-size: 10px; margin-bottom: 2px; padding: 0px 0px 0px 0px;">{{$company->type_regime->name}}</p>
                    @else
                        <p style="color: black; font-weight: bold; font-size: 12px; margin-bottom: 2px; padding: 0px 0px 0px 0px;">NIT: {{$company->identification_number}}-{{$company->dv}}</p>
                        <p style="color: black; font-size: 10px; margin-bottom: 2px; padding: 0px 0px 0px 0px;">{{$company->type_regime->name}}</p>
                    @endif
                @else
                    <p style="color: black; font-weight: bold; font-size: 12px; margin-bottom: 2px; padding: 0px 0px 0px 0px;">NIT: {{$company->identification_number}}-{{$company->dv}}</p>
                    <p style="color: black; font-size: 10px; margin-bottom: 2px; padding: 0px 0px 0px 0px;">{{$company->type_regime->name}}</p>
                @endif
                <p style="color: black; font-size: 11px; margin-bottom: 2px; padding: 0px 0px 0px 0px;">
                    @if(isset($request->tarifaica) && $request->tarifaica != '100')
                        TARIFA ICA: {{$request->tarifaica}}%
                    @endif
                    @if(isset($request->tarifaica) && isset($request->actividadeconomica))
                        -
                    @endif
                    @if(isset($request->actividadeconomica))
                        ACTIVIDAD ECONOMICA: {{$request->actividadeconomica}}
                    @endif
                    @if(isset($request->seze))
                        <?php
                            $aseze = substr($request->seze, 0, strpos($request->seze, '-', 0));
                            $asociedad = substr($request->seze, strpos($request->seze, '-', 0) + 1);
                        ?>
                        Regimen SEZE Año: {{$aseze}} Constitución Sociedad Año: {{$asociedad}}
                    @endif
                    <br>
                    @if(isset($request->establishment_address))
                        {{$request->establishment_address}} -
                    @else
                        {{$company->address}} -
                    @endif
                    @inject('municipality', 'App\Municipality')
                    @if(isset($request->establishment_municipality))
                        {{$municipality->findOrFail($request->establishment_municipality)['name']}} - {{$municipality->findOrFail($request->establishment_municipality)['department']['name']}} -
                    @else
                        {{$company->municipality->name}} - {{$municipality->findOrFail($company->municipality->id)['department']['name']}} -
                    @endif
                    {{$company->country->name}}
                    <br>
                    @if(isset($request->establishment_phone))
                        Teléfono - {{$request->establishment_phone}}<br>
                    @else
                        Teléfono - {{$company->phone}}<br>
                    @endif
                    @if(isset($request->establishment_email))
                        E-mail: {{$request->establishment_email}} <br>
                    @else
                        E-mail: {{$user->email}} <br>
                    @endif
                    @if (isset($request->seze))
                        FAVOR ABSTENERSE DE PRACTICAR RETENCION EN LA FUENTE REGIMEN ESPECIAL DECRETO 2112 DE 2019
                   @endif
                   </p>REPRESENTACION GRAFICA DEL DOCUMENTO SOPORTE A NO OBLIGADOS</p>
                   <br>
                </p>
            </div>
        </td>
        <td style="width: 25%; text-align: right;" class="vertical-align-top">
            <br>
            <img  style="width: 150px; height: auto;" src="{{$imgLogo}}" alt="logo">
        </td>
    </tr>
</table>

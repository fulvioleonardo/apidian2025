<footer id="footer">
    <hr style="margin-bottom: 4px;">
    <p id='mi-texto'>Nota de Ajuste Documento Soporte No: {{$resolution->prefix}} - {{$request->number}} - Fecha y Hora de Generación: {{$date}} - {{$time}}<br> CUDS: <strong>{{$cufecude}}</strong></p>
    @isset($request->foot_note)
        <p id='mi-texto-1'><strong>{{$request->foot_note}}</strong></p>
    @endisset
</footer>

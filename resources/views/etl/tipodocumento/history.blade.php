<ul>
    <li>TTD_SPV: {{$tipodocumento->TTD_SPV}}</li>
    <li>DESCRIPCIÓN: {{$tipodocumento->DESCRIPCION}}</li>
    <li>TTD_SOFTLAND: {{$tipodocumento->TTD_SOFTLAND}}</li>
    <li>TIPO_ASIENTO: {{$tipodocumento->TIPO_ASIENTO == 'H'?'HABER':'DEBE'}}</li>
</ul>

<h4>Historial</h4>
<table border="1">
    <thead>
        <tr>
            <th>USUARIO</th>
            <th>FECHA</th>
            <th>OPERACION</th>
            <th>CODIGO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tipodocumento->LOG as $log)
        <tr>
            <td>{{$log->COD_USUARIO}}</td>
            <td>{{$log->FECHA}}</td>
            <td>{{$log->OPERACION}}</td>
            <td><a href="{{url("tipodocumento/{$log->IDLOG}/log")}}">{{ $log->IDLOG }}</a></td> 
        </tr>
        @endforeach
    </tbody>
</table>
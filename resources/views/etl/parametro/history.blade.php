

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
        @foreach ($parametro->LOG as $log)
        <tr>
            <td>{{$log->COD_USUARIO}}</td>
            <td>{{$log->FECHA}}</td>
            <td>{{$log->OPERACION}}</td>
            <td><a href="{{url("parametro/{$log->IDLOG}/log")}}">{{ $log->IDLOG }}</a></td> 
        </tr>
        @endforeach
    </tbody>
</table>
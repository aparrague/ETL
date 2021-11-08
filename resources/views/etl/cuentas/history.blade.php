<ul>
    <li>Cuenta: {{$cuenta->CUENTA}}</li>
    <li>Nombre: {{$cuenta->DESCRIPCION}}</li>
</ul>

<h4>Historial</h4>
<table border="1">
    <thead>
        <tr>
            <th>USUARIO</th>
            <th>FECHA</th>
            <th>OPERACION</th>
            <th>COD</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cuenta->LOG as $log)
        <tr>
            <td>{{$log->COD_USUARIO}}</td>
            <td>{{$log->FECHA}}</td>
            <td>{{$log->OPERACION}}</td>
            <td><a href="{{url("cuentas/{$log->IDLOG}/log")}}">{{ $log->IDLOG }}</a></td> 
  
        </tr>
        @endforeach
    </tbody>
</table>

<ul>
    COD LOG: {{$log->IDLOG}}
    <h4>Historial</h4>
    
    @php
                $registro_antiguo = json_decode($log->REGISTRO_ANTIGUO);
                $registro_nuevo = json_decode($log->REGISTRO_NUEVO);


            if($registro_antiguo != '')
           {
                $tipodocumento_antiguo=$tipodocumento->where("IDTIPODOCUMENTO", $registro_antiguo->IDTIPODOCUMENTO)->first();
                $cuenta_antiguo=$cuenta->where("IDCUENTA", $registro_antiguo->IDCUENTA)->first();

            }
            $tipodocumento_nuevo=$tipodocumento->where("IDTIPODOCUMENTO", $registro_nuevo->IDTIPODOCUMENTO)->first();
            $cuenta_nuevo=$cuenta->where("IDCUENTA", $registro_nuevo->IDCUENTA)->first();

        

    if($registro_antiguo != '')
           {            
    @endphp

    <h4>REGISTRO ANTIGUO</h4>
        <ul>
            <li>SERVICIO: {{$tipodocumento_antiguo->DESCRIPCION}}</li>
            <li>NUEVO: {{$registro_antiguo->NUEVO== 1?'SI':'NO'}}</li>
            <li>ANTIGUO: {{$registro_antiguo->ANTIGUO== 1?'SI':'NO'}}</li>
            <li>GRATUIDAD: {{$registro_antiguo->GRATUIDAD== 1?'SI':'NO'}}</li>
            <li>GRADO: {{$registro_antiguo->GRADO== 1?'PREGRADO':'POSTGRADO'}}</li>
            <li>CUENTA: {{ $cuenta_antiguo->DESCRIPCION}}</li>
        </ul>
    @php
    }
    @endphp
    
    <h4>REGISTRO NUEVO</h4>
        <ul>
            <li>SERVICIO: {{$tipodocumento_nuevo->DESCRIPCION}}</li>
            <li>NUEVO: {{$registro_nuevo->NUEVO== 1?'SI':'NO'}}</li>
            <li>ANTIGUO: {{$registro_nuevo->ANTIGUO== 1?'SI':'NO'}}</li>
            <li>GRATUIDAD: {{$registro_nuevo->GRATUIDAD== 1?'SI':'NO'}}</li>
            <li>GRADO: {{$registro_nuevo->GRADO== 1?'PREGRADO':'POSTGRADO'}}</li>
            <li>CUENTA: {{$cuenta_nuevo->DESCRIPCION}}</li>
        </ul>

   
</ul>
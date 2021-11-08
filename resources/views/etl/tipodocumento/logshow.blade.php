<ul>
    COD LOG: {{$log->IDLOG}}
    <h4>Historial</h4>
    
    @php
                $registro_antiguo = json_decode($log->REGISTRO_ANTIGUO);
                $registro_nuevo = json_decode($log->REGISTRO_NUEVO);

                if($registro_antiguo->TTD_SOFTLAND != '')
                $documentossoftland_antiguo = $documentossoftland->where("CODDOC", $registro_antiguo->TTD_SOFTLAND)->first();

                if($registro_nuevo->TTD_SOFTLAND != '')
                $documentossoftland_nuevo = $documentossoftland->where("CODDOC", $registro_nuevo->TTD_SOFTLAND)->first();

                
                
    @endphp

    <h4>REGISTRO ANTIGUO</h4>
        <ul>
            <li>TTD_SOFTLAND: {{$registro_antiguo->TTD_SOFTLAND!= ''? $documentossoftland_antiguo->DESDOC: ''}}</li>
            <li>TIPO_ASIENTO: {{$registro_antiguo->TIPO_ASIENTO== 'H'?'HABER':'DEBE'}}</li>
        </ul>

    <h4>REGISTRO NUEVO</h4>
        <ul>
            <li>TTD_SOFTLAND: {{$registro_nuevo->TTD_SOFTLAND!= ''? $documentossoftland_nuevo->DESDOC: ''}}</li>
            <li>TIPO_ASIENTO: {{$registro_nuevo->TIPO_ASIENTO== 'H'?'HABER':'DEBE'}}</li>
        </ul>
</ul>
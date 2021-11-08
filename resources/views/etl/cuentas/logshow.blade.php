<ul>
    COD LOG: {{$log->IDLOG}}
    <h4>Historial</h4>

            @php
                $registro_antiguo = json_decode($log->REGISTRO_ANTIGUO);
                $registro_nuevo = json_decode($log->REGISTRO_NUEVO);
                $auxiliar_antiguo = $auxiliares->where("IDAUXILIAR", $registro_antiguo->IDAUXILIAR)->first();
                $auxiliar_nuevo = $auxiliares->where("IDAUXILIAR", $registro_nuevo->IDAUXILIAR)->first();
            @endphp
            
            <h4>REGISTRO ANTIGUO</h4>
                <ul>
                    <li>Tipo Auxiliar: {{$auxiliar_antiguo->NOMBRE}}</li>
                    <li>Detalle Gasto: {{$registro_antiguo->DETALLEGASTO}}</li>
                    <li>Centro de Costo: {{$registro_antiguo->CCOSTOS}}</li>
                    <li>Documento: {{$registro_antiguo->DOCUMENTO}}</li>
                    <li>Vigente: {{$registro_antiguo->VIGENTE}}</li>
                </ul>
            
            <h4>REGISTRO NUEVO</h4>
                <ul>
                    <li>Tipo Auxiliar: {{$auxiliar_nuevo->NOMBRE}}</li>
                    <li>Detalle Gasto: {{$registro_nuevo->DETALLEGASTO}}</li>
                    <li>Centro de Costo: {{$registro_nuevo->CCOSTOS}}</li>
                    <li>Documento: {{$registro_nuevo->DOCUMENTO}}</li>
                    <li>Vigente: {{$registro_nuevo->VIGENTE}}</li>
                </ul>



</ul>
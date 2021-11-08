<h1>Tipo Documento</h1>
<button type="button" onclick="javascript:editar()">Guardar</button>
<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>TTD_SPV</th>
            <th>TTD_SOFTLAND</th>
            <th>DESCRIPCIÓN</th>
            <th>LIBRO</th>
            <th>TIPO_ASIENTO</th>
            <th>HISTORIAL</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($tipodocumentos as $key => $tipodocumento)
            <tr name="rowval" data-id="{{$tipodocumento->IDTIPODOCUMENTO}}">
                <td>{{ $tipodocumento->IDTIPODOCUMENTO }}</td>
                <td>{{ $tipodocumento->TTD_SPV }}</td>
                <td>
                    <select name="ttd_softland[]" id="ttd_softland{{$tipodocumento->IDTIPODOCUMENTO}}" 
                    data-id="{{$tipodocumento->IDTIPODOCUMENTO}}" data-value="{{$tipodocumento->TTD_SOFTLAND}}">
                        <option value="">seleccione uno...</option>
                        <option value="00">No Aplica</option>
                        @foreach ($documentossoftland as $documentosoftland)
                        <option value="{{$documentosoftland->CODDOC}}" {{$tipodocumento->TTD_SOFTLAND == $documentosoftland->CODDOC? 'selected': ''}}>{{$documentosoftland->DESDOC}}</option>
                        @endforeach
                    </select>
                </td>
                <td>{{ $tipodocumento->DESCRIPCION}}</td>
                <td>{{ $tipodocumento->LIBRO == 1 ? 'SI' : 'NO' }}</td>
                <td>
                    <select name="tipo_asiento[]" id="tipo_asiento{{$tipodocumento->IDTIPODOCUMENTO}}" 
                    data-id="{{$tipodocumento->IDTIPODOCUMENTO}}" data-value="{{$tipodocumento->TIPO_ASIENTO}}">
                        <option value="">Seleccione uno...</option>
                        <option value="H" {{$tipodocumento->TIPO_ASIENTO == 'H'?'selected':''}}>Haber</option>
                        <option value="D" {{$tipodocumento->TIPO_ASIENTO == 'D'?'selected':''}}>Debe</option>
                    </select>
                </td>
                    
                <td><a href="{{url("tipodocumento/{$tipodocumento->IDTIPODOCUMENTO}/history")}}">{{ count($tipodocumento->LOG) }}</a></td> 
                
                
            
            </tr>
        @endforeach

        
        
        

    </tbody>
</table>
<form action="{{url('tipodocumento')}}" method="POST" name="frmsubmit">
    @csrf
    <input type="hidden" name="data" id="data">
    
</form>

<script>
    function editar() {
        updates = [];
        
        document.querySelectorAll("[name='ttd_softland[]']").forEach(function(elm) {

            document.querySelectorAll("[name='tipo_asiento[]']").forEach(function(elm2) {
                if(elm.dataset.id == elm2.dataset.id)
                {
            if ((elm.dataset.value != elm.value) || (elm2.dataset.value != elm2.value))
                updates.push({
                    
                    id: elm.dataset.id,
                    value: elm.value,
                    asiento: elm2.value
                    
                });
                }    
        });

        });
          
            
        if(updates.length == 0){
            console.log("nada que guardar");
        }
        else {
            
            console.log(`Actualizando ${updates.length} registros`);
            document.getElementById("data").value = JSON.stringify(updates);
            document.frmsubmit.submit();
        }
    }
</script>

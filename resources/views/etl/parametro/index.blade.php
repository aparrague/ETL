<h1>Parametros</h1>

<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>SERVICIO</th>
            <th>NUEVO</th>
            <th>ANTIGUO</th>
            <th>GRATUIDAD</th>
            <th>GRADO</th>
            <th>CUENTA</th>
            <th>+</th>
            
        </tr>
    </thead>
    <tbody>
    <form action="{{url('parametro')}}" method="POST" name="frmsubmit">   
     @csrf
 
    <tr>
            <td></td>
            <td>
            <select name="idtipodocumento" id="idtipodocumento">
             @foreach ($tipodocumentos as $tipodocumento)
                <option value="{{$tipodocumento->IDTIPODOCUMENTO}}">
                {{$tipodocumento->TTD_SPV}}</option>
             @endforeach
            </select>
            </td>
            <td>
            <select name="nuevo" id="nuevo">
                <option value="1">SI</option>
                <option value="0">NO</option>
            </select>
            </td>
            <td>
            <select name="antiguo" id="antiguo">
                <option value="1">SI</option>
                <option value="0">NO</option>
            </select>
            </td>
            <td>
            <select name="gratuidad" id="gratuidad">
                <option value="1">SI</option>
                <option value="0">NO</option>
            </select>
            </td>
            <td>
            <select name="grado" id="grado">
                <option value="1">PREGRADO</option>
                <option value="2">POSTGRADO</option>
            </select>
            </td>
            <td>
            <select name="idcuenta" id="idcuenta">
             @foreach ($cuentas as $cuenta)
                <option value="{{$cuenta->IDCUENTA}}">{{$cuenta->DESCRIPCION}}</option>
             @endforeach
            </select>
            </td>
            <td><button type="submit" >Guardar</button></td>
           
        </tr>
    </form> 

    </tbody>
</table>
<br>
<button type="button" onclick="javascript:editar()">Editar</button>
<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>SERVICIO</th>
            <th>NUEVO</th>
            <th>ANTIGUO</th>
            <th>GRATUIDAD</th>
            <th>GRADO</th>
            <th>CUENTA</th>
            <th>VIGENTE</th>
            <th>HISTORIAL</th>
            
            
            
        </tr>
    </thead>
    <tbody>
       <tbody>
         @foreach ($parametros as $parametro)
 
        <tr>
            <td>{{$parametro->IDPARAMETRO}}</td>
            <td>
            <select name="idtipodocumento[]"  id="idtipodocumento{{$parametro->IDPARAMETRO}}" 
            data-id="{{$parametro->IDPARAMETRO}}" data-value="{{$parametro->IDTIPODOCUMENTO}}">
             @foreach ($tipodocumentos as $tipodocumento)
                <option value="{{$tipodocumento->IDTIPODOCUMENTO}}" {{ $parametro->IDTIPODOCUMENTO == $tipodocumento->IDTIPODOCUMENTO ? 'selected' : ''}}>{{$tipodocumento->TTD_SPV}}</option>
             @endforeach
            </select>
            </td>
            <td>
            <select name="nuevo[]" id="idtipodocumento{{$parametro->IDPARAMETRO}}" 
            data-id="{{$parametro->IDPARAMETRO}}" data-value="{{$parametro->NUEVO}}">
                <option value="1" {{ $parametro->NUEVO == 1 ? 'selected' : ''}}>SI</option>
                <option value="0" {{ $parametro->NUEVO == 0 ? 'selected' : ''}}>NO</option>
            </select>
            </td>
            <td>
            <select name="antiguo[]" id="idtipodocumento{{$parametro->IDPARAMETRO}}" 
            data-id="{{$parametro->IDPARAMETRO}}" data-value="{{$parametro->ANTIGUO}}">
                <option value="1" {{ $parametro->ANTIGUO == 1 ? 'selected' : ''}}>SI</option>
                <option value="0" {{ $parametro->ANTIGUO == 0 ? 'selected' : ''}}>NO</option>
            </select>
            </td>
            <td>
            <select name="gratuidad[]" id="idtipodocumento{{$parametro->IDPARAMETRO}}" 
            data-id="{{$parametro->IDPARAMETRO}}" data-value="{{$parametro->GRATUIDAD}}">
                <option value="1" {{ $parametro->GRATUIDAD == 1 ? 'selected' : ''}}>SI</option>
                <option value="0" {{ $parametro->GRATUIDAD == 0 ? 'selected' : ''}}>NO</option>
            </select>
            </td>
            <td>
            <select name="grado[]" id="idtipodocumento{{$parametro->IDPARAMETRO}}" 
            data-id="{{$parametro->IDPARAMETRO}}" data-value="{{$parametro->GRADO}}">
                <option value="1" {{ $parametro->GRADO == 1 ? 'selected' : ''}}>PREGRADO</option>
                <option value="2" {{ $parametro->GRADO == 2 ? 'selected' : ''}}>POSTGRADO</option>
            </select>
            </td>
            <td>
            <select name="idcuenta[]" id="idcuenta{{$parametro->IDPARAMETRO}}" 
            data-id="{{$parametro->IDPARAMETRO}}" data-value="{{$parametro->IDCUENTA}}">
             @foreach ($cuentas as $cuenta)
                <option value="{{$cuenta->IDCUENTA}}" {{ $parametro->IDCUENTA == $cuenta->IDCUENTA ? 'selected' : ''}}>{{$cuenta->DESCRIPCION}}</option>
             @endforeach
            </select>
            </td>
            <td>{{$parametro->VIGENTE}}</td>
            <td><a href="{{url("parametro/{$parametro->IDPARAMETRO}/history")}}">{{ count($parametro->LOG) }}</a></td>
           
        </tr>
        @endforeach
    </tbody>
</table>

<form action="{{url('parametros')}}" method="POST" name="frmsubmit2">
    @csrf
    <input type="hidden" name="data" id="data">
</form>   
   
<script>
    function editar() {
        updates = [];
        
        document.querySelectorAll("[name='idtipodocumento[]']").forEach(function(elm) {

            document.querySelectorAll("[name='idcuenta[]']").forEach(function(elm6) {
                if(elm.dataset.id == elm6.dataset.id)
                {
                    document.querySelectorAll("[name='nuevo[]']").forEach(function(elm2) {
                        if(elm.dataset.id == elm2.dataset.id)
                        {
                    document.querySelectorAll("[name='antiguo[]']").forEach(function(elm3) {
                        if(elm.dataset.id == elm3.dataset.id)
                        { 
                    document.querySelectorAll("[name='gratuidad[]']").forEach(function(elm4) {
                        if(elm.dataset.id == elm4.dataset.id)
                        {
                    document.querySelectorAll("[name='grado[]']").forEach(function(elm5) {
                        if(elm.dataset.id == elm5.dataset.id)
                        {                        

                    if ((elm.dataset.value != elm.value) || (elm2.dataset.value != elm2.value)
                        || (elm6.dataset.value != elm6.value) || (elm3.dataset.value != elm3.value)
                        || (elm4.dataset.value != elm4.value) || (elm4.dataset.value != elm4.value))
                
                        updates.push({
                            id: elm.dataset.id,
                            idtipodocumento: elm.value,
                            nuevo: elm2.value,
                            antiguo: elm3.value,
                            gratuidad: elm4.value,
                            grado: elm5.value,
                            idcuenta: elm6.value
                        });
                        } });
                        } });  
                        } });  
                        } }); 
                }    
            });

        });
          
            
        if(updates.length == 0){
            console.log("nada que guardar");
        }
        else {
            
            console.log(`Actualizando ${updates.length} registros`);
            document.getElementById("data").value = JSON.stringify(updates);
            document.frmsubmit2.submit();
        }
    }
</script>    



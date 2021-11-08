<h1>Cuentas</h1>
<button type="button" onclick="javascript:editar()">Guardar</button>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Cuenta Contable</th>
            <th>Nombre</th>
            <th>Tipo Auxiliar</th>
            <th>Detalle Gasto</th>
            <th>Centro de Costo</th>
            <th>Documento</th>
            <th>Estado</th>
            <th>Historial</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cuentas as $key => $cuenta)
            <tr>
                <td>{{ $cuenta->IDCUENTA }}</td>
                <td>{{ $cuenta->CUENTA }}</td>
                <td>{{ $cuenta->DESCRIPCION }}</td>
                {{-- <td>{{$cuenta->TipoAuxiliar->NOMBRE}}</td> --}}
                <td>
                    <select data-id="{{ $cuenta->IDCUENTA }}" data-value="{{ $cuenta->TipoAuxiliar->IDAUXILIAR }}"
                        name="auxiliar[]" id="idauxiliar{{ $cuenta->TipoAuxiliar->IDAUXILIAR }}">
                        @foreach ($auxiliares as $auxiliar)

                            <option value="{{ $auxiliar->IDAUXILIAR }}"
                                {{ $auxiliar->IDAUXILIAR == $cuenta->TipoAuxiliar->IDAUXILIAR ? 'selected' : '' }}>
                                {{ $auxiliar->NOMBRE }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td>{{ $cuenta->DETALLEGASTO == 1 ? 'SI' : 'NO' }}</td>
                <td>{{ $cuenta->CCOSTOS == 1 ? 'SI' : 'NO' }}</td>
                <td>{{ $cuenta->DOCUMENTO == 1 ? 'SI' : 'NO' }}</td>
                <td>{{ $cuenta->VIGENTE == 1 ? 'SI' : 'NO' }}</td>
                <td><a href="{{url("cuentas/{$cuenta->IDCUENTA}/history")}}">{{ count($cuenta->LOG) }}</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<form action="{{url('cuentas')}}" method="POST" name="frmsubmit">
    @csrf
    <input type="hidden" name="data" id="data">
</form>
<script>
    function editar() {
        updates = [];
        document.querySelectorAll("[name='auxiliar[]']").forEach(function(elm) {
            if (elm.dataset.value != elm.value)
                updates.push({
                    id: elm.dataset.id,
                    value: elm.value
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

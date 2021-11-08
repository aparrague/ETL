<form action="{{url('detalle')}}" method="POST" name="frmsubmit">
    @csrf
    venta<input type="text" name="idvoucher" id="idvoucher">
    <button type="submit" >Guardar</button>
</form>
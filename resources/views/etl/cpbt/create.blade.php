<form action="{{url('cpbt')}}" method="POST" name="frmsubmit">
    @csrf
    Voucher<input type="text" name="idvoucher" id="idvoucher">
    <button type="submit" >Guardar</button>
</form>
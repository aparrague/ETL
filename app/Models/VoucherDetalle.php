<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model\ETL;


class VoucherDetalle extends Model
{
    use HasFactory;
    protected $table = "dba.FIN_PV_VOUCHER_DETALLE";
    protected $primaryKey = "IDVOUCHERDETALLE";
    public $timestamps = false;

    public function Voucher(){
        return $this->belongsTo(Voucher::class, "IDVOUCHER", "IDVOUCHER");
    }

    public function Venta(){
        return $this->belongsTo(Venta::class, "IDVENTA", "IDVENTA");
    }

    public function TipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'TTD', 'TTD_SPV');
    }
    
}

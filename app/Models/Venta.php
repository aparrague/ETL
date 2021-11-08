<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table = "dba.FIN_PV_VENTA";
    protected $primaryKey = "IDVENTA";
    public $timestamps = false;

    public function Voucher(){
        return $this->belongsTo(Voucher::class,"IDVOUCHER","IDVOUCHER");
    }
}

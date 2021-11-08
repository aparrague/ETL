<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = "dba.FIN_PV_VOUCHER";
    protected $primaryKey = "IDVOUCHER";
    public $timestamps = false;
    // protected $id = "ID";

    public function Venta(){
        return $this->hasMany(Venta::class, "IDVOUCHER", "IDVOUCHER");
    }
}

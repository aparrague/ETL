<?php

namespace App\Models\ETL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpbt extends Model
{
    use HasFactory;
    protected $table = "dba.ETL_CPBTE";
    protected $primaryKey = "IDCOMPROBANTE";
    public $timestamps = false;
    protected $guarded = [];

    public function Voucher(){
        return $this->hasOne(Voucher::class, "IDVOUCHER", "IDVOUCHER");
    }

}
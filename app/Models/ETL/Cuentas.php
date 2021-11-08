<?php

namespace App\Models\ETL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuentas extends Model
{
    use HasFactory;
    protected $table = "dba.ETL_CUENTAS";
    protected $primaryKey = "IDCUENTA";
    public $timestamps = false;
    protected $guarded = [];

    public function TipoAuxiliar(){
        return $this->hasOne(TipoAuxiliar::class, "IDAUXILIAR", "IDAUXILIAR");
    }

    public function LOG(){
        return $this->hasMany(LOG::class,'IDREGISTRO', 'IDCUENTA')->where("TABLA", $this->table);
    }

}

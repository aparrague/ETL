<?php

namespace App\Models\ETL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAuxiliar extends Model
{
    use HasFactory;
    protected $table = "dba.ETL_TIPOAUXILIAR";
    protected $primaryKey = "IDAUXILIAR";
    public $timestamps = false;

    public function Cuenta(){
        return $this->belongsToMany(Cuentas::class);
    }
}

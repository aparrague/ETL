<?php

namespace App\Models\ETL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use HasFactory;
    protected $table = "dba.ETL_PARAMETRO";
    protected $primaryKey = "IDPARAMETRO";
    public $timestamps = false;
    protected $guarded = [];

    
    public function LOG(){
        return $this->hasMany(LOG::class,'IDREGISTRO', 'IDPARAMETRO')->where("TABLA", $this->table);
    }

}
<?php

namespace App\Models\ETL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;
    protected $table = "dba.ETL_TIPODOCUMENTO";
    protected $primaryKey = "IDTIPODOCUMENTO";
    public $timestamps = false;
    protected $guarded = [];
    


   public function LOG(){
        return $this->hasMany(LOG::class,'IDREGISTRO', 'IDTIPODOCUMENTO')->where("TABLA", $this->table);
    }
   

}

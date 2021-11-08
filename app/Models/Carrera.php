<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $table = "dba.CARRERA_INSTANCIA";
    protected $primaryKey = "IDCARINSTANCIA";
    public $timestamps = false;
    // protected $id = "ID";


}

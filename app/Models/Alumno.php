<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $table = "dba.ALUMNO";
    protected $primaryKey = "N_ALUMNO";
    public $timestamps = false;
    // protected $id = "ID";


}

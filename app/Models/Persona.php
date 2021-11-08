<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = "dba.PERSONA";
    protected $primaryKey = "IDPERSONA";
    public $timestamps = false;

}

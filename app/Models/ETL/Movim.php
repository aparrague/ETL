<?php

namespace App\Models\ETL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movim extends Model
{
    use HasFactory;
    protected $table = "dba.ETL_MOVIM";
    protected $primaryKey = "IDMOVIM";
    public $timestamps = false;
    protected $guarded = [];

  

}
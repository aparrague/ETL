<?php

namespace App\Models\Softland;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftTipoDocumento extends Model
{
    use HasFactory;
    protected $table = "softland.cwttdoc";
    protected $primaryKey = "CodDoc";
    protected $connection = 'sqlsrv';
    public $incremental = false;
    public $timestamps = false;

}

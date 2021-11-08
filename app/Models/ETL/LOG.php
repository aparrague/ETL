<?php

namespace App\Models\ETL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LOG extends Model
{
    use HasFactory;
    protected $table = "dba.ETL_LOG";
    protected $primaryKey = "IDLOG";
    public $timestamps = false;
    protected $guarded = [];


}
<?php

use App\Http\Controllers\Mantenedores\CuentasController;
use App\Http\Controllers\Mantenedores\TipoDocumentoController;
use App\Http\Controllers\Mantenedores\ParametroController;
use App\Http\Controllers\Mantenedores\MovimController;
use App\Http\Controllers\Mantenedores\CpbtController;
use App\Http\Controllers\Mantenedores\TranspasoDetalleController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // $persona = DB::table('dba.persona')
    // ->where("rut","18.732.766-0")
    // ->first();
    // dd($persona);
    return view('welcome');
});
Route::get('/test/sqlsrv', function(){
    $mov = DB::connection('sqlsrv')->table('softland.cwmovim')->first();
    dd($mov);
});
Route::get('/cuentas', [CuentasController::class,'index']);
Route::get('/cuentas/{id}/history', [CuentasController::class,'history']);
Route::post('/cuentas', [CuentasController::class,'update']);
Route::get('/cuentas/{id}/log', [CuentasController::class,'show']);

Route::get('/tipodocumento', [TipoDocumentoController::class,'index']);
Route::post('/tipodocumento', [TipoDocumentoController::class,'update']);
Route::get('/tipodocumento/{id}/history', [TipoDocumentoController::class,'history']);
Route::get('/tipodocumento/{id}/log', [TipoDocumentoController::class,'show']);

Route::get('/parametro', [ParametroController::class,'index']);
Route::post('/parametro', [ParametroController::class,'store']);
Route::post('/parametros', [ParametroController::class,'update']);
Route::get('/parametro/{id}/history', [ParametroController::class,'history']);
Route::get('/parametro/{id}/log', [ParametroController::class,'show']);


Route::get('/cpbt', [CpbtController::class,'create']);
Route::post('/cpbt', [CpbtController::class,'store']);

Route::get('/movim', [MovimController::class,'create']);
Route::post('/movim', [MovimController::class,'store']);

Route::get('/detalle', [TranspasoDetalleController::class,'create']);
Route::post('/detalle', [TranspasoDetalleController::class,'store']);
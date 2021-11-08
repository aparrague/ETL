<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Models\ETL\Cuentas;
use App\Models\ETL\LOG;
use App\Models\ETL\TipoAuxiliar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CuentasController extends Controller
{
    public function index(){
        $cuentas = Cuentas::with("TipoAuxiliar","LOG")->get();
        $auxiliares = TipoAuxiliar::get();
        return view("etl.cuentas.index", compact('cuentas', 'auxiliares'));
    }

    public function update(Request $request){
        $data = json_decode($request->data);
        foreach ($data as $key => $value) {
            DB::transaction(function () use ($value){
                // se inicializa el log
                $log = new LOG();
                $log->TABLA = "dba.ETL_CUENTAS";
                $log->COD_USUARIO = 'antonio.parrague';


                $cuenta = Cuentas::firstWhere("IDCUENTA", $value->id);
                $log->REGISTRO_ANTIGUO = json_encode($cuenta);

                $cuenta->IDAUXILIAR = $value->value;
                $cuenta->save();
                $log->REGISTRO_NUEVO = json_encode($cuenta);
                $log->FECHA = Carbon::now();
                $log->OPERACION = 'update';
                $log->IDREGISTRO = $cuenta->IDCUENTA;
                $log->save();

            });
        }
        return back();
    }

    public function history($id){
        $cuenta = Cuentas::with("LOG")->firstWhere("IDCUENTA", $id);
        //$auxiliares = TipoAuxiliar::get();
        return view("etl.cuentas.history", compact('cuenta'));
    }
    
    public function show($id){
        $log = LOG::findOrFail($id);
        $auxiliares = TipoAuxiliar::get();
        return view("etl.cuentas.logshow", compact('log', 'auxiliares'));
        
    }
}

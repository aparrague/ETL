<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Models\ETL\Cuentas;
use App\Models\ETL\TipoDocumento;
use App\Models\ETL\Parametro;
use Illuminate\Http\Request;
use App\Models\ETL\LOG;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ParametroController extends Controller
{
    function index(){
        $parametros=Parametro::with("LOG")->get();
        $cuentas=Cuentas::all();
        $tipodocumentos=TipoDocumento::where("VIGENTE", 1)->get();
        return view("etl.parametro.index", compact('parametros','cuentas','tipodocumentos'));
    }

    public function store(Request $request){
        //return $request->all();
        
        $parametro = new Parametro();
        $parametro->IDTIPODOCUMENTO = $request->idtipodocumento;
        $parametro->IDCUENTA = $request->idcuenta;
        $parametro->NUEVO = $request->nuevo;
        $parametro->ANTIGUO = $request->antiguo;
        $parametro->GRATUIDAD = $request->gratuidad;
        $parametro->GRADO = $request->grado;
        $parametro->VIGENTE = 1;
        $parametro->save();
        

        $log = new LOG();
        $log->TABLA = "dba.ETL_PARAMETRO";
        $log->COD_USUARIO = 'antonio.parrague';
        $parametro2 = Parametro::all()->last();;
        $log->REGISTRO_ANTIGUO = '';
        $log->REGISTRO_NUEVO = json_encode($parametro2);
        $log->FECHA = Carbon::now();
        $log->OPERACION = 'create';
        $log->IDREGISTRO = $parametro2->IDPARAMETRO;
        $log->save();
        return back();
    }

    public function update(Request $request){

        $data = json_decode($request->data);
        //$data2 = $request->data;
        //echo $data2;

        foreach ($data as $key => $value) {
            DB::transaction(function () use ($value){
                // se inicializa el log
                $log = new LOG();
                $log->TABLA = "dba.ETL_PARAMETRO";
                $log->COD_USUARIO = 'antonio.parrague';

                $parametro = Parametro::where('IDPARAMETRO',$value->id)->first();
                //dd($tipodocumento);
                //echo $value->id;
                //echo json_encode($tipodocumento,JSON_UNESCAPED_UNICODE);
                $log->REGISTRO_ANTIGUO = json_encode($parametro);

                $parametro->IDTIPODOCUMENTO = $value->idtipodocumento;
                $parametro->IDCUENTA = $value->idcuenta;
                $parametro->NUEVO = $value->nuevo;
                $parametro->ANTIGUO = $value->antiguo;
                $parametro->GRATUIDAD = $value->gratuidad;
                $parametro->GRADO = $value->grado;
                $parametro->save();

                $log->REGISTRO_NUEVO = json_encode($parametro);
                $log->FECHA = Carbon::now();
                $log->OPERACION = 'update';
                $log->IDREGISTRO = $parametro->IDPARAMETRO;
                $log->save();

            });
        }
        return back();
      
    }

    public function show($id){
        $log = LOG::findOrFail($id);
        $tipodocumento= TipoDocumento::select('IDTIPODOCUMENTO', 'DESCRIPCION')->get();
        $cuenta= Cuentas::select('IDCUENTA', 'DESCRIPCION')->get();
        return view("etl.parametro.logshow", compact('log', 'tipodocumento', 'cuenta'));
        
    }
    
    public function history($id){
        $parametro = Parametro::with("LOG")->firstWhere("IDPARAMETRO", $id);
        return view("etl.parametro.history", compact('parametro'));
    }
}

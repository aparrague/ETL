<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Models\Softland\SoftTipoDocumento;
use App\Models\ETL\TipoDocumento;
use Illuminate\Http\Request;
use App\Models\ETL\LOG;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TipoDocumentoController extends Controller
{
    function index(){
        
        $tipodocumentos = TipoDocumento::with("LOG")->where("VIGENTE", 1)->get();
        $documentossoftland = SoftTipoDocumento::select('CODDOC', 'DESDOC')->orderBy('DESDOC', 'asc')->get();
        return view('etl.tipodocumento.index', compact('tipodocumentos', 'documentossoftland'));
    }

    public function update(Request $request){
        $data = json_decode($request->data);
        //$data2 = $request->data;
        //echo $data2;

        foreach ($data as $key => $value) {
            DB::transaction(function () use ($value){
                // se inicializa el log
                $log = new LOG();
                $log->TABLA = "dba.ETL_TIPODOCUMENTO";
                $log->COD_USUARIO = 'antonio.parrague';

                $tipodocumento = TipoDocumento::where('IDTIPODOCUMENTO',$value->id)->first();
                //dd($tipodocumento);
                //echo $value->id;
                //echo json_encode($tipodocumento,JSON_UNESCAPED_UNICODE);
                $log->REGISTRO_ANTIGUO = json_encode($tipodocumento);

                $tipodocumento->TTD_SOFTLAND = $value->value;
                $tipodocumento->TIPO_ASIENTO = $value->asiento;
                $tipodocumento->save();

                $log->REGISTRO_NUEVO = json_encode($tipodocumento);
                $log->FECHA = Carbon::now();
                $log->OPERACION = 'update';
                $log->IDREGISTRO = $tipodocumento->IDTIPODOCUMENTO;
                $log->save();

            });
        }
        return back();
    }

    public function history($id){
        $tipodocumento = TipoDocumento::with("LOG")->firstWhere("IDTIPODOCUMENTO", $id);
        return view("etl.tipodocumento.history", compact('tipodocumento'));
    }

    public function show($id){
        $log = LOG::findOrFail($id);
        $documentossoftland= SoftTipoDocumento::select('CODDOC', 'DESDOC')->get();
        return view("etl.tipodocumento.logshow", compact('log', 'documentossoftland'));
        
    }

    
}

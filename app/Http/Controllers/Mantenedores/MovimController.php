<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Models\Softland\SoftTipoDocumento;
use App\Models\ETL\TipoDocumento;
use App\Models\ETL\Movim;
use App\Models\ETL\Parametro;
use App\Models\ETL\Cuentas;
use App\Models\Venta;
use App\Models\Persona;
use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MovimController extends Controller
{

  public function create()
  {

    return view("etl.movim.create");
  }



  public function store(Request $request)
  {
    
    $movim = new Movim();
    $voucher = Voucher::findOrFail($request->idvoucher);
    //echo $voucher->Venta;
    $venta = Venta::where('IDVOUCHER',$voucher->IDVOUCHER)->first();
    $tipodocumento = TipoDocumento::where('TTD_SPV', $venta->COD_VALOR)->first();
    $parametros = Parametro::where('IDTIPODOCUMENTO',$tipodocumento->IDTIPODOCUMENTO)->get();
        
    foreach ($parametros as $key => $parametro) {
      
      $querys=DB::table("dba.fin_pv_voucher as vou")
      ->join("dba.fin_pv_venta as ven","ven.idvoucher","=","vou.idvoucher")
      ->join("dba.persona as per","per.idpersona","=","ven.idpersona")
      ->join("dba.alumno as alu","alu.rut","=","per.rut")
      ->join("DBA.CARRERA as car","car.cod_carrera","=","alu.cod_carrera")
      ->leftjoin("dba.colegiatura as col", function($join)
      {
          $join->on('col.n_alumno', '=','alu.n_alumno')
          ->where('col.ano', '=', DB::raw("DBA.SYS_ParamNumeric('SYSPMAT01')"))
          ->where('col.vigente','=','1');
      })
      ->select(
        DB::raw("first year(alu.fecha_i) as ano_ingreso_alumno,DBA.SYS_ParamNumeric('SYSPMAT01') ano_contable,(SELECT gratuidad from dba.GRT_ValorAlumnoPeriodo(alu.n_alumno,ven.ano)) as gratuidad"),
        'car.grado')
      ->where("vou.idvoucher","=",$request->idvoucher)
      ->get();
      

        foreach ($querys as $key => $query) 
            {    

              if($query->ano_ingreso_alumno < $query->ano_contable)
                  {$nuevo=1; $antiguo=0; $text='nuevo';}
                  else {$nuevo= 0; $antiguo=1; $text='antiguo';} 

                 
              
              if($parametro->NUEVO == $nuevo && $parametro->ANTIGUEDAD == $antiguo) 
                {
                  //echo $parametro->IDPARAMETRO;

                  if($query->grado == $parametro->GRADO && $query->gratuidad == $parametro->GRATUIDAD)
                     {
                       $cuenta=Cuentas::findOrFail($parametro->IDCUENTA);
                       $persona=Persona::FindOrFail($voucher->IDPERSONA);
                     
                       switch ($cuenta->IDAUXILIAR) {
                        case "1":
                            $caso=1;
                            $rut = $voucher->RUT_APODERADO;
                            break;
                        case "2":
                            $caso=2;
                            $rut = $persona->RUT;
                            break;
                        case "3":
                            $caso=3;
                            $rut = '00000000';
                            break;
                        }
                        
                        if($cuenta->CCOSTOS==1)
                        {
                        $alumno=Alumno:: where('RUT',$persona->RUT)->first();
                        $carrera=Carrera:: where('COD_CARRERA',$alumno->COD_CARRERA)
                                          ->where('JORNADA',$alumno->REGIMEN)
                                          ->where('vigente',1)->first();
                        
                        if($caso!=3)
                        {$caracteres = array(".","-");
                        $rut_formato= str_replace($caracteres,"",$rut);
                        $rut= substr($rut_formato,0,-1); } 
                        
                        $movim->CCCOD= $carrera->IDEXTERNO2;
                        $movim->IDVOUCHER =$voucher->IDVOUCHER;
                        $movim->CPBANO=$venta->ANO;
                        $movim->PCTCOD=$cuenta->CUENTA;
                        $movim->CPBFEC=$voucher->FECHA;
                        $fecha = explode('-', $voucher->FECHA);
                        $movim->CPBMES= $fecha[1];
                        $movim->CODAUX=$rut;
                        $movim->TTDCOD=$tipodocumento->TTD_SOFTLAND;
                        $movim->MOVFE=$movim->MOVFV=$movim->FECPAG=$movim->FECEMISIONCH=$voucher->FECHA;
                        if($tipodocumento->TIPO_ASIENTO=='D')
                          {$movim->MOVDEBE=$movim->MOVDEBEMA=$venta->VALOR; $movim->MOVHABER=$movim->MOVHABERMA=0;}   
                          else {$movim->MOVHABER=$movim->MOVHABERMA=$venta->VALOR; $movim->MOVDEBE=$movim->MOVDEBEMA=0;}
                        $movim->MOVGLOSA=$tipodocumento->DESCRIPCION;

                        echo $movim;
                        //$movim->save();
                        
                        }




                     }

                }

              
            
            }
   
    }
    
    
    /**/

    


  } 

}
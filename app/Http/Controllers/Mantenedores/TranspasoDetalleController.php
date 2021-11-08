<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Models\ETL\Movim;
use App\Models\ETL\Cuentas;
use App\Models\ETL\TipoDocumento;
use App\Models\ETL\Parametro;
use App\Models\Persona;
use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\Voucher;
use App\Models\Venta;
use App\Models\VoucherDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TranspasoDetalleController extends Controller
{

  public function create()
  {

    return view("etl.detalle.create");
  }



  public function store(Request $request)
  {
    $movim = new Movim();
    $voucherdetalle = VoucherDetalle::where('IDVOUCHER',$request->idvoucher)->first();
    //$venta = Venta::where('IDVENTA',$voucherdetalle->IDVENTA)->first();
    //echo $voucherdetalle->TipoDocumento;
    $tipodocumento = TipoDocumento::where('TTD_SPV', $voucherdetalle->TTD)->first();
    $parametros = Parametro::where('IDTIPODOCUMENTO',$tipodocumento->IDTIPODOCUMENTO)->get();
  
  

    foreach ($parametros as $key => $parametro) {
      
      $querys=DB::table("dba.fin_pv_voucher_detalle as vou")
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
              
              
              if($query->grado == $parametro->GRADO && $query->gratuidad == $parametro->GRATUIDAD)
                     {
                       $cuenta=Cuentas::findOrFail($parametro->IDCUENTA);
                       $persona=Persona::FindOrFail($voucherdetalle->Venta->IDPERSONA);
                       //
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
                        $movim->IDVOUCHER =$voucherdetalle->IDVOUCHER;
                        $movim->CPBANO=$voucherdetalle->Venta->ANO;
                        $movim->PCTCOD=$cuenta->CUENTA;
                        if(is_null($voucherdetalle->FEMISION))
                            $fecha=$voucherdetalle->Voucher->FECHA;
                            else $fecha=$voucherdetalle->FEMISION;
                        $movim->CPBFEC=$fecha;
                        $fecha_s = explode('-', $fecha);
                        $movim->CPBMES= $fecha_s[1];
                        $movim->CODAUX=$rut;
                        $movim->TTDCOD=$tipodocumento->TTD_SOFTLAND;
                        $movim->MOVFE=$movim->MOVFV=$movim->FECPAG=$movim->FECEMISIONCH=$voucherdetalle->FEMISION;
                        if($tipodocumento->TIPO_ASIENTO=='D')
                          {$movim->MOVDEBE=$movim->MOVDEBEMA=$voucherdetalle->VALOR; $movim->MOVHABER=$movim->MOVHABERMA=0;}   
                          else {$movim->MOVHABER=$movim->MOVHABERMA=$voucherdetalle->VALOR; $movim->MOVDEBE=$movim->MOVDEBEMA=0;}
                        $movim->MOVGLOSA=$tipodocumento->DESCRIPCION;
                        echo $cuenta->DETALLEGASTO;

                        echo $movim;
                        //$movim->save();
                        
                        }
                    } 

            }
        }  


  } 

}
}
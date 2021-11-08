<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Models\Softland\SoftTipoDocumento;
use App\Models\ETL\TipoDocumento;
use App\Models\ETL\Cpbt;
use App\Models\Voucher;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CpbtController extends Controller
{

  public function create()
  {

    return view("etl.cpbt.create");
  }



  public function store(Request $request)
  {
    $cpbt= new Cpbt();
    $num= Cpbt::where ('IDVOUCHER', $request->idvoucher)->count();
    //echo $cpbt2;
    if($num==0)
    {

    $voucher= Voucher::findOrfail($request->idvoucher);
 
    if($voucher->ESTADO == 'V' && $voucher->PROCESADO == 0)
    {
      $cpbt->CPBEST=$voucher->ESTADO;
      $cpbt->IDVOUCHER=$voucher->IDVOUCHER;
      $cpbt->CPBNUM=$voucher->NCOMPROBANTE;
      //$cpbt->CPBNUM=1;
      $cpbt->CPBFEC=$voucher->FECHA;

      if(!empty($voucher->FECHA))
      {
      $fecha = explode('-', $voucher->FECHA);
      
      $cpbt->CPBANO=$fecha[0];
      $cpbt->CPBMES=$fecha[1];
      }else{
        $cpbt->CPBANO='';
        $cpbt->CPBMES='';
      }
        

      if(!empty($voucher->IDPERSONA))
      {
        $persona= Persona::findOrfail($voucher->IDPERSONA);
        $glo=strtoupper($persona->NOMBRE).' '.strtoupper($persona->APPATERNSO).' '.strtoupper($persona->APMATERNO).' N° Voucher(SPV) '.$voucher->IDVOUCHER;
        $cpbt->CPBGLO=$glo;
      }
      else{
        $cpbt->CPBGLO='';
      }
      //echo $cpbt;
    
      $cpbt->save();
    }
  } else{
    //echo "existe el comprobante del ese voucher";
  }
  return back();
  } 

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cita;

use App\Exports\VentasExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;


class ReporteController extends Controller
{
    
    public function index()
    {

        return view('pages.reporte');
       
    }
    public function records($IdCategoria){     

       try {

            $data =DB::table('cita')
            ->join("horario", "cita.IdHorario", "=", "horario.IdHorario")       
            ->join("empleado", "horario.IdEmpleado", "=", "empleado.IdEmpleado")       
            ->join("cliente", "cita.IdCliente", "=", "cliente.IdCliente")      
            ->select('cita.IdCita','horario.fec_atencion','cliente.Nombres','empleado.Nombres as empleado','cita.estado')      
            ->where("cita.IdCategoria",$IdCategoria)->get();  
      
        return response()->json(['status' => 200,'result'=>$data]);
        
    } catch (\Exception $e){               
  
        return response()->json(['status' => 404,'message'=>$e->getMessage()]);
    }  
   
              
   
    }
    public function exportExcel($IdCategoria){    

        $data =DB::table('cita')
        ->join("horario", "cita.IdHorario", "=", "horario.IdHorario")       
        ->join("empleado", "horario.IdEmpleado", "=", "empleado.IdEmpleado")       
        ->join("cliente", "cita.IdCliente", "=", "cliente.IdCliente")      
        ->select('horario.fec_atencion','cliente.Nombres','empleado.Nombres as empleado','cita.estado')      
        ->where("cita.IdCategoria",$IdCategoria)->get();  
    
        return (new  VentasExport)->records($data)->download('Ventas.xlsx', Excel::XLSX);  
   
    }


    public function exportPdf($IdCategoria){

        $data =DB::table('cita')
        ->join("horario", "cita.IdHorario", "=", "horario.IdHorario")       
        ->join("empleado", "horario.IdEmpleado", "=", "empleado.IdEmpleado")       
        ->join("cliente", "cita.IdCliente", "=", "cliente.IdCliente")      
        ->select('horario.fec_atencion','cliente.Nombres','empleado.Nombres as empleado','cita.estado')      
        ->where("cita.IdCategoria",$IdCategoria)->get();  
     
        return (new VentasExport)->records($data)->download('Ventas.pdf', Excel::DOMPDF);     
    }

}

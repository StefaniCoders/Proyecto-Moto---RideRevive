<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\DetalleCita;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Moto;
use App\Models\Categoria;
use App\Models\Horario;
use App\Models\Motor;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\CitasCollection;

use App\Exports\CitasExport;

use Maatwebsite\Excel\Excel;


class CitaController extends Controller
{
    public function index()
    {
        $cita = Cita::get();
        


       // $cita   = new CitasCollection($data);  
      //  dd($cita);
        // $horarios = Horarios::get();
        $cliente = Cliente::get();
        $moto = Moto::get();
        $categoria = Categoria::get();
        return view('pages.cita.cita',array("cita"=>$cita,"cliente"=>$cliente, "moto"=>$moto,"categoria" => $categoria));
    }

    public function buscarCita(Request $request)
    {
       // dd($request);
        $dispatch = Cita::orderBy('IdCita');
        if ($request->value) {
            $dispatch->where('fec_registro',$request->value)
            ->orWhereHas('cliente',function($q) use($request){
                $q->where('Nombres', 'like', "%{$request->value}%");
             })
             ->orWhereHas('categoria',function($q) use($request){
                 $q->where('descripcion', 'like', "%{$request->value}%");
            });
        }
        $cita =$dispatch->get();   
        return view('pages.cita.cita',compact("cita"));
    }

    public function create($id=null)
    {
        $data = null;
        if ($id) {
            $data = Cita::find($id);
        }

        $moto = Moto::get();
        $cliente = Cliente::get();
        $categoria = Categoria::get();
        $horario = Horario::get();
      


        return view('pages.cita.createCitas',['cita'=>$data,'cliente'=>$cliente,'moto'=>$moto,'categoria'=>$categoria,'horario'=>$horario]);
    }
    public function creates($id=null)
    {


        $data = null;
        if ($id) {
            $data = Cita::find($id);
            $detalleCita = DetalleCita::where('Idcita', $id)->first();
        }

        $moto = Moto::get();
        $cliente = Cliente::get();
        $categoria = Categoria::get();
        $horario = Horario::get();
      


        return view('pages.cita.editCitas',[ 'detalleCita'=>$detalleCita,'cita'=>$data,'cliente'=>$cliente,'moto'=>$moto,'categoria'=>$categoria,'horario'=>$horario]);
    }


    public function editstore(Request $request)
    {
      
        
            $request->IdHorario = 1;
            $idCita = $request->IdCita2;
            $iddetallecita = $request->iddetallecita;
             
                        $cita = Cita::find($idCita);    
                        $cita->fec_registro = $request->fec_registro;
                        $cita->estado = $request->estado;
                        $cita->IdHorario = $request->IdHorario;
                        $cita->IdCliente = $request->IdCliente;
                        $cita->IdCategoria = $request->IdCategoria;
                        $cita->IdUsuario = 1;
                        $cita->update();
                
                     
                 
                        $det_cita = DetalleCita::find($iddetallecita);  
                        $det_cita->IdMoto= $request->IdMoto; 
                        $det_cita->IdMotor = $request->IdMoto;
                        $det_cita->detalle_moto = $request->detalle_moto;
                        $det_cita->detalle_motor = $request->detalle_moto;                       
                    
                        $det_cita->update();
                            
                       
                         return redirect()->action([CitaController::class, 'index']);
                   
    
      
      
        
    }

    public function edit()
    {
      
      
        $moto = Moto::get();
        $cliente = Cliente::get();
        $categoria = Categoria::get();
        $horario = Horario::get();
      


        return view('pages.cita.editCitas',['cliente'=>$cliente,'moto'=>$moto,'categoria'=>$categoria,'horario'=>$horario]);
    }


    public function store(Request $request)
    {
   

     try {
        $request->IdHorario = 1;
            $idCita = $request->IdCita;
            $citas_fecha = Cita::select('fec_registro')
                ->where('fec_registro','<', $request->fec_registro)
                ->get();
                if (count($citas_fecha) < 21) {
                    $cita = Cita::firstOrNew(['IdCita' => $idCita]);    
                //    $cita = new Cita();
                    $cita->fec_registro = $request->fec_registro;
                    $cita->estado = $request->estado;
                    $cita->IdHorario = $request->IdHorario;
                    $cita->IdCliente = $request->IdCliente;
                    $cita->IdCategoria = $request->IdCategoria;
                    $cita->IdUsuario = 1;
                    $cita->save();


                   
            
                    $id_cita = $cita->IdCita;


                    $horario = new Horario();
                    $horario->fec_atencion =  $request->fec_registro;
                    $horario->idEmpleado =  1;
                    $horario->IdCategoria = $request->IdCategoria;
                    $horario->costo = $request->IdCategoria;
                    $horario->IdCita = $id_cita;
                    $horario->save();


                    if ($request->idCita) {
                        $det_cita = DetalleCita::find($request->detalle->IdDetalleCita);  
                        $det_cita->IdMoto= $request->Idmoto; 
                        $det_cita->IdMoto = $request->Idmoto;
                        $det_cita->detalle_moto = $request->detalle_moto;
                        $det_cita->detalle_motor = $request->detalle_moto;                       
                
                        $det_cita->update();
                        
                    }else{

                        $det_cita = new DetalleCita();
            
                        $det_cita->IdCita = $id_cita;
                        $det_cita->IdMoto = $request->Idmoto;
                        $det_cita->detalle_moto = $request->detalle_moto;
                        $det_cita->detalle_motor = $request->detalle_moto;
                        $det_cita->save();
                    }                   
            
                     $mensaje = ($request->IdCita)?'Cita editado con éxito':'Cita registrado con éxito';
                     return redirect()->action([CitaController::class, 'index']);
                   // return response()->json(['status' => 200,'message'=>$mensaje]);
                }else{
                    //return response()->json(['status' => 400,'message'=>'se lleno los cupos']);
                    return redirect()->action([CitaController::class, 'index']);
                }


        } catch (\Exception $e){               
  
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        }  

    }
    public function grafico(){

        try {
            $data = DB::table('cita')
            ->select(DB::raw("COUNT(cita.IdCategoria) AS cantidad "), 'categoria.descripcion')
            ->join('categoria','cita.IdCategoria','=','categoria.IdCategoria')
            ->groupBy('cita.IdCategoria')
            ->get();
            
            //$data=array();
    
            return response()->json(['status' => 200,'result'=>$data]);

        } catch (\Exception $e){               
  
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        }         

    }

    public function delete($id){
      
        $detalle =  DetalleCita::where('IdCita',$id);
        $detalle->delete();
        $moto = Cita::findOrFail($id);
        $moto->delete();

        return redirect()->route('citas');       
    }


    public function finish(Request $request){
      
        $cita = Cita::find($request->IdCita);
        $cita->estado="t";
        $cita->IdCategoria=4;
 
        $cita->update();


      //  $horario = Horario::find($request->IdCita);
        $horario = Horario::where('IdCita', $request->IdCita)->first();
        $horario->IdCategoria=4;
 
        $horario->update();

        return redirect()->route('citas');       
    }

    public function downloadExcel(){
    
        $data =DB::table('cita')
        ->join("horario", "cita.IdHorario", "=", "horario.IdHorario")       
        ->join("empleado", "horario.IdEmpleado", "=", "empleado.IdEmpleado")       
        ->join("cliente", "cita.IdCliente", "=", "cliente.IdCliente")      
        ->select('horario.fec_atencion','cliente.Nombres','empleado.Nombres as empleado','cita.estado')      
        ->get();  
    
        return (new  CitasExport)->records($data)->download('CitasExport.xlsx', Excel::XLSX);  

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Horario;
use App\Models\Categoria;
use App\Models\Empleado;
use App\Models\Cita;

use Illuminate\Support\Facades\DB;


class HorarioController extends Controller
{
    //

    public function index()
    {
        $categoria = Categoria::get();
        $empleados = Empleado::get();
        $horario = Horario::get();
        return view('pages.horario',compact("categoria","empleados","horario"));

        //return view('pages.horario');
        
    }

    public function store(Request $request)
    {
        $IdHorario = $request->IdHorario;
        $horario = Horario::firstOrNew(['IdHorario' => $IdHorario]);
        $horario->fill($request->all());
        $horario->save();     



         
    }

    public function show(Horario $horario)
    {
        //$horario = Horario::select('IdCategoria as title','fec_atencion as start','fec_atencion as end')->get();
        $horario = DB::table('horario')
                    ->join('categoria', 'categoria.IdCategoria', '=', 'horario.IdCategoria')
                    ->select('horario.costo as costo','horario.IdHorario as id','categoria.descripcion AS title','horario.fec_atencion as start','horario.fec_atencion as end','categoria.color as color','categoria.IdCategoria')
                    ->get();
        //dd($horario);
        return response()->json($horario);
    }

    public function edit($IdHorario,$IdCategoria)
    {
        //
        $horario = Horario::find($IdHorario);
        $rowsCita = Cita::where('IdHorario',$IdHorario)->where('IdCategoria',$IdCategoria)->get();
        $cantidad =count($rowsCita);
        
      //  return response()->json($horario);
        return response()->json(['status' => 200,'horario'=>$horario,'cantidad'=> $cantidad]);
    }



    //juanchos 
    public function horariocategoria($idcategoria){

        //$currend_date=Carbon\Carbon::now();
        $currend_date = date('Y-m-d');


        $horario = DB::table('horario')      
        ->join("empleado", "horario.IdEmpleado", "=", "empleado.IdEmpleado")   
        ->select('horario.IdHorario','horario.fec_atencion','empleado.IdEmpleado','empleado.Nombres','empleado.Apellidos')   
        ->where('horario.IdCategoria',$idcategoria)->whereDate('horario.fec_atencion','>=',$currend_date)        
        ->get();    
        if ($horario) {
            return response()->json(['status' => 200,'result'=>$horario]);
        }
        return response()->json(['status' => 400]);
    }

    public function getHorario (){
        
    }
}
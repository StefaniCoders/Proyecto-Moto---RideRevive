<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Empleado;
use App\Models\Usuario;

class EmpleadoController extends Controller
{
    //

    public function index()
    {
        $empleados = Empleado::get();
        return view('pages.empleado',compact("empleados"));
    }

    public function create()
    {
        return view('pages.createEmpleado');
    }

    public function store(Request $request){


       // $exist = Empleado::find('')
        // $validated = $request->validate([
        //     'Nombres' => 'required',
        //     'Apellidos' => 'required',
        //     'DNI' => 'required',
        //     'correo' => 'required',
        // ]);

        $IdEmpleado = $request->IdEmpleado;
        $empleado = Empleado::firstOrNew(['IdEmpleado' => $IdEmpleado]);
        $empleado->fill($request->all());
        $empleado->save();

        return response()->json(['status' => 200,'result'=>$empleado,'message'=>($IdEmpleado)?'Empleado Edtiado':'Empleado Registrado']);
        //return redirect()->action([EmpleadoController::class, 'index']);
        //$IdEmpleado=$empleado->id;

        // $obj  =new Usuario();
        // $obj->username=$request->username;
        // $obj->clave=$request->clave;
        // $obj->IdEmpleado=$request->IdEmpleado;
        // $obj->save();


        //return redirect()->action([EmpleadoController::class, 'index']);

    }

      public function getEmpleado($id)
    {
        $empleado = Empleado::where('IdEmpleado', "=" , $id)->first();
        // dd($empleado);
        return response()->json(['status' => 200,'result'=>$empleado]);
       // return view('pages.createCliente', compact("cliente"));
    }

    public function records(Request $request)
    {   
        $nombre =$request->name;
        if ($nombre) {
            $clientes = Empleado::where('Nombres','like',"%{$nombre}%")
            ->orWhere('Apellidos','like',"%{$nombre}%")
            ->orWhere('DNI','like',"%{$nombre}%")
            ->orWhere('telefono','like',"%{$nombre}%")
            ->get();
            return response()->json(['status' => 200,'result'=>$clientes,'name'=>$nombre]);
        }else{
            $clientes = Empleado::get();
            return response()->json(['status' => 200,'result'=>$clientes]);
        }
    }

    public function update(Request $request){

        $categoria = Empleado::where('IdEmpleado',$request->IdEmpleado)
            ->update([
                "Nombres" =>$request->Nombres,
                "Apellidos" => $request->Apellidos,
                "correo" => $request->correo,
                "telefono" => $request->telefono,
            ]);
        $return = Empleado::where('DNI',$request->DNI)->get();
        
     return redirect()->action([EmpleadoController::class, 'index']);
        // http://proyectomimoto.test/get-cat?IdCategoria=2
    }

    public function delete($id){

        $cita = Usuario::where('IdEmpleado',$id)->get();
        if (count($cita)>0) {
            return [
                'status'  => 400,
                'message' => 'Este Empleado esta asociadocon un usuario',          
            ];
        }

        $cliente = Empleado::findOrFail($id);
        $cliente->delete();

        return [
            'status'  => 200,
            'message' => 'Elinado con éxito',          
        ];
    }
}

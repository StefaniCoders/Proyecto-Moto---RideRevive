<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Cita;
use App\Models\Empleado;


use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    //
    public function index()
    {
       // $usuarios = Usuario::get();
       // return view('pages.usuario');
       // return $usuarios;
       $usuario = Usuario::get();
       return view('pages.usuario', array('usuario'=>$usuario));
    }

    public function records(Request $request){

        $nombre =$request->name;
        if ($nombre) {
            $usuarios = Usuario::where('IdUsuario','=',$nombre)
            ->orWhere('nom_usuario','like',"%{$nombre}%")     
            ->get();
            
            $empleados = DB::table('empleado')
            ->select('empleado.IdEmpleado','empleado.Nombres','empleado.Nombres')
            ->whereNotExists(function ($query) {
                $query->from('usuario')               
                    ->where('usuario.IdEmpleado','=',DB::raw('empleado.IdEmpleado'));
            })
            ->get();     
      //  dd($usuarios);
            return response()->json(['status' => 200,'result'=>$usuarios,'name'=>$nombre]);
        }else{
            $usuarios = Usuario::get();
            $empleados = DB::table('empleado')
            ->select('empleado.IdEmpleado','empleado.Nombres','empleado.Nombres')
            ->whereNotExists(function ($query) {
                $query->from('usuario')               
                    ->where('usuario.IdEmpleado','=',DB::raw('empleado.IdEmpleado'));
            })
            ->get();
            return response()->json(['status' => 200,'result'=>$usuarios,'empleados'=>$empleados]);
        }

        // $usuarios = Usuario::get();

        // $empleados = DB::table('empleado')

        // ->select('empleado.IdEmpleado','empleado.Nombres','empleado.Nombres')
        // ->whereNotExists(function ($query) {
        //     $query->from('usuario')               
        //         ->where('usuario.IdEmpleado','=',DB::raw('empleado.IdEmpleado'));
        // })
        // ->get();
        // return response()->json(['status' => 200,'result'=>$usuarios,'empleados'=>$empleados]);
        
    }

    public function buscarUsuario(Request $request)
    {
       // dd($request);
        $dispatch = Usuario::orderBy('IdUsuario');
        if ($request->value) {
            $dispatch->where('nom_usuario', 'LIKE', '%' . $request->value . '%')
            ->orWhere('estado', 'LIKE', '%' . $request->value . '%')
            ->orWhere('nivel', 'LIKE', '%' . $request->value . '%');
        }
        $usuario =$dispatch->get();   
        return view('pages.usuario', array('usuario'=>$usuario));
    }

    public function store(Request $request)
    {
        try {
            $usuario =Usuario::find($request->IdUsuario);
            if ($usuario) {
                
             //   $usuario = new Usuario();
              //  $usuario->IdUsuario = 14;
                $usuario->nom_usuario = $request->usuario;
                $usuario->clave = $request->password;
                $usuario->estado = 'A';
                $usuario->IdEmpleado = $request->IdEmpleado;
                $usuario->nivel = $request->nivel;
                $usuario->update();
                //echo "aqui";
                //exit;

                return redirect()->action([UsuarioController::class, 'index']);
                exit;

            }else{
                $nivel ="A";
                if ($request->nivel=="Empleado") {
                    $nivel ="E";
                }
              
                $usuario = new Usuario();
                $usuario->nom_usuario = $request->usuario;
                $usuario->clave = $request->password;
                $usuario->estado = 'A';
                $usuario->IdEmpleado = $request->IdEmpleado;
                $usuario->nivel = $nivel;
                $usuario->save();
    
                return redirect()->action([UsuarioController::class, 'index']);
                exit;
            }
      
        } catch (\Exception $e){               
  
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        }        
    }

    public function getMoto(Request $request)
    {
        $usuario = usuario::where('IdUsuario', "=" , $request->IdUsuario)->first();
        $empleado = Empleado::get();
        // dd($moto);
        return view('pages.createUsuario',array('usuario'=>$usuario,'empleado'=>$empleado));
    }



    public function create()
    {
        $empleado = Empleado::get();
        return view('pages.createUsuario',array('empleado'=>$empleado));
    }


    public function delete($id){

        $cita = Cita::where('IdUsuario',$id)->get();
        if (count($cita)>0) {
            return [
                'status'  => 400,
                'message' => 'Este Usuario tiene citas registradas',          
            ];
        }

        if ($id==1) {
            return [
                'status'  => 400,
                'message' => 'No puede eliminar al primer usuario',          
            ];
        }
        $cliente = Usuario::findOrFail($id);
        $cliente->delete();

        return redirect()->action([UsuarioController::class, 'index']);

        /*return [
            'status'  => 200,
            'message' => 'Elinado con éxito',          
        ];*/
    }
}

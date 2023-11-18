<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Cita;


class ClienteController extends Controller
{
    //

    public function index()
    {
        $clientes = Cliente::get();
        return view('pages.cliente',compact("clientes"));
    }

    public function create()
    {
        return view('pages.createCliente');
    }

    public function store(Request $request){

        // $validated = $request->validate([
        //     'Nombres' => 'required',
        //     'Apellidos' => 'required',
        //     'DNI' => 'required',
        //     'correo' => 'required',
        // ]);

        $IdCliente = $request->IdCliente;
        $cliente = Cliente::firstOrNew(['IdCliente' => $IdCliente]);
        $cliente->fill($request->all());
        $cliente->save();

        return response()->json(['status' => 200,'result'=>$cliente,'message'=>($IdCliente)?'Cliente Edtiado':'Cliente Registrado']);
       // return redirect()->action([ClienteController::class, 'index']);

    }

    public function getCliente($id)
    {
        $cliente = Cliente::where('IdCliente', "=" , $id)->first();
        // dd($empleado);
        return response()->json(['status' => 200,'result'=>$cliente]);
       // return view('pages.createCliente', compact("cliente"));
    }

    public function records(Request $request)
    {   
        $nombre =$request->name;
        if ($nombre) {
            $clientes = Cliente::where('Nombres','like',"%{$nombre}%")
            ->orWhere('Apellidos','like',"%{$nombre}%")
            ->orWhere('DNI','like',"%{$nombre}%")
            ->orWhere('telefono','like',"%{$nombre}%")
            ->get();
            return response()->json(['status' => 200,'result'=>$clientes,'name'=>$nombre]);
        }else{
            $clientes = Cliente::get();
            return response()->json(['status' => 200,'result'=>$clientes]);
        }
    }

    public function delete($id){

        $cita = Cita::where('IdCliente',$id)->get();
        if (count($cita)>0) {
            return [
                'status'  => 400,
                'message' => 'Este cliente tiene citas registradas',          
            ];
        }

        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return [
            'status'  => 200,
            'message' => 'Elinado con éxito',          
        ];
    }

}

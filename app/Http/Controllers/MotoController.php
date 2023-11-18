<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Moto;
use App\Models\Cita;
use App\Models\DetalleCita;

class MotoController extends Controller
{
    //
    public function index()
    {
      //  $clientes = Cliente::get();
        $motos = Moto::get();
        return view('pages.moto', compact('motos'));
    }


    public function create()
    {
        return view('pages.createMoto');
    }

    public function store(Request $request){

      
        $IdMoto = $request->IdMoto;
        $moto = Moto::firstOrNew(['IdMoto' => $IdMoto]);
        $moto->estado="Activo";
        $moto->fill($request->all());

        if($request->file()) {
//echo "hola";
            $fileName = time().'_'.$request->file->getClientOriginalName();
        echo $fileName;
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
    //        echo $filePath;
            $moto->photo=$fileName;
        }else{

            
            $editphoto = $request->editphoto;
            if($editphoto==null){
                $moto->photo=null;
            }
        }
//exit;
        $moto->save();

        return redirect()->action([MotoController::class, 'index']);
    }

    public function getMoto(Request $request)
    {
        $moto = Moto::where('IdMoto', "=" , $request->IdMoto)->first();
        // dd($moto);
        return view('pages.createMoto', compact("moto"));
    }


    public function records()
    {
      //  $clientes = Cliente::get();
        $motos = Moto::get();
        return response()->json(['status' => 200,'result'=>$motos]);
    }


    public function buscarMoto(Request $request)
    {
       // dd($request);
        $dispatch = Moto::orderBy('IdMoto');
        if ($request->value) {
            $dispatch->where('marca', 'LIKE', '%' . $request->value . '%')
            ->orWhere('modelo', 'LIKE', '%' . $request->value . '%')
            ->orWhere('placa', 'LIKE', '%' . $request->value . '%')
            ->orWhere('color', 'LIKE', '%' . $request->value . '%');
        }
        $motos =$dispatch->get();   
        return view('pages.moto', compact('motos'));
    }


    public function delete($id){

        $cita = DetalleCita::where('IdMoto',$id)->get();
        if (count($cita)>0) {
    
         return back()->with('error', 'Esta moto esta usada en una cita');
           
        }

        $moto = Moto::findOrFail($id);
        $moto->delete();

        $motos = Moto::orderBy('IdMoto')->get();  
  
        return view('pages.moto', compact('motos'));
    }


    // public function update(Request $request)
    // {
    //     $moto = Moto::where("IdMoto", $request->IdMoto)
    //         ->update([
    //             "marca" => $request->marca,
    //             "modelo" => $request->modelo,
    //             "color" => $request->color,
    //             "estado" => $request->estado
    //         ]);
    //     // $get_moto = Moto::where("IdMoto", $request->IdMoto)->get();
    //     // return $get_moto;
    //     return "correcto";
    // }


}

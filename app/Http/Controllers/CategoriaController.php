<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Categoria;
use App\Models\Cita;

class CategoriaController extends Controller
{
    //

    public function index(Request $request)
    {
        $dispatch = Categoria::orderBy('IdCategoria');
        if ($request->value) {
            $dispatch->where('descripcion',$request->value);
        }
        $categorias =$dispatch->get();
        ///compact("empleados")
        return view('pages.categoria',compact("categorias"));
    }

    public function buscarCategoria(Request $request)
    {
       // dd($request);
        $dispatch = Categoria::orderBy('IdCategoria');
        if ($request->value) {
            $dispatch->where('descripcion',$request->value);
        }
        $categorias =$dispatch->get();   
        return view('pages.categoria',compact("categorias"));
    }


    public function records()
    {
        $categorias = Categoria::get();
        ///compact("empleados")
        return response()->json(['status' => 200,'result'=>$categorias]);
    }


    public function create()
    {
        return view('pages.createCategoria');
    }

    public function store(Request $request){
        // $exist = Empleado::find('')

        $validated = $request->validate([
            'descripcion' => 'required'
        ]);

        $IdCategoria = $request->IdCategoria;
        $categoria = Categoria::firstOrNew(['IdCategoria' => $IdCategoria]);
        $categoria->estado="Activo";
        $categoria->color="red";
        $categoria->fill($request->all());
        $categoria->save();

        return redirect()->action([CategoriaController::class, 'index']);

    }
    public function getCategoria(Request $request)
    {
        $categoria = Categoria::where('IdCategoria', "=" , $request->IdCategoria)->first();
        // dd($empleado);
        return view('pages.createCategoria', compact("categoria"));
    }

    // public function update(Request $request){

    //     $categoria = Categoria::where('IdCategoria',$request->IdCategoria)
    //         ->update([
    //             "descripcion" => $request->descripcion,
    //             "estado" => $request->estado??'A'
    //         ]);
    //     $return = Categoria::where('IdCategoria',$request->IdCategoria)->get();
    //     return $return;
    //     // http://proyectomimoto.test/get-cat?IdCategoria=2
    // }


    public function delete($id){

        $cita = Cita::where('IdCategoria',$id)->get();
        if (count($cita)>0) {
       //     return Redirect::back()->withErrors("");
         return back()->with('error', 'Esta categoria esta usada en una cita');
            // return [
            //     'status'  => 400,
            //     'message' => 'Esta categoria esta usada en una cita',          
            // ];
        }

        $cliente = Categoria::findOrFail($id);
        $cliente->delete();

        $categorias = Categoria::orderBy('IdCategoria')->get();  
  
        return view('pages.categoria',compact("categorias"));
    }
}

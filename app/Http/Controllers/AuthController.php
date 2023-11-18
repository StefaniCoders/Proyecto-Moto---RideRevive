<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;
use App\Http\Controllers\DashboardController;


class AuthController extends Controller
{

    public function index()
    {
        return view('login');
    }


    public function authenticate(Request $request){

        $result = Usuario::login($request->username,$request->clave);   
        if ($result->status==200) {
            
      
          $request->session()->put('id_usuario',$result->user->IdUsuario);
          $request->session()->put('nivel',$result->user->nivel);
          $request->session()->put('nom_empleado',$result->info->Nombres);
          //$request->session()->put('sucursal',$request->cbx_sucursal);
          return redirect()->route('home');
             
        }else{                  
           return redirect()->back()->withErrors(['errors' => trans('auth.failed')]);
        }        
           
    }

    public function logout(){
        if (session()->has('id_usuario')) {
            session()->pull('id_usuario');
            session()->pull('nom_empleado');
            return redirect()->action([AuthController::class, 'index']);

           // return view('/');
        }
    }

}

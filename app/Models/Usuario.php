<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


use \stdClass;

class Usuario extends Model
{
    use HasFactory;


    protected $primaryKey = 'IdUsuario';

    protected $table = 'usuario';
    protected $fillable = [
        "nom_usuario",
        "clave",
        "estado",
        "IdEmpleado"
    ];

    static  function login($username,$clave){
        $result = new stdClass();

         $exis=DB::table('usuario')->select('usuario.nom_usuario')->where('usuario.nom_usuario', $username)->first();

         if ($exis) {
           $user = DB::table('usuario')
           ->select('usuario.IdEmpleado','usuario.IdUsuario','usuario.nom_usuario','usuario.nivel')
           ->where('usuario.nom_usuario', $username)
           ->where('usuario.clave', $clave)
           ->first();

           if ($user) {

             $result->status = 200;
             $result->message = 'Ingreso con Exito';
             $result->user = $user;
             $result->info = self::infoEmpleado($user->IdEmpleado);

             return $result;

           }else{

             $result->status = 400;
             $result->message = 'error clave';
             return $result;
           }
         }else{

           $result->status = 400;
           $result->message='Usuario no Existe';
           return $result;
         }
          return null;
   }



    static function infoEmpleado($IdEmpleado)
    {
        return DB::table('empleado')
        ->join("usuario", "empleado.IdEmpleado", "=", "usuario.IdEmpleado")
        ->select('empleado.Nombres')
        ->where("usuario.IdEmpleado",$IdEmpleado)
        ->first();
     }

}

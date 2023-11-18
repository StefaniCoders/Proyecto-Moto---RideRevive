<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = "cita";

    protected $with = ['detalle'];

     protected $primaryKey = 'IdCita';
    // "IdCategoria",
    protected $fillable = [
        "fec_registro",
        "estado",
        "IdHorario",
        "IdCliente",
        "IdUsuario",
       
    ];

    public function cliente()
    {       
        return $this->belongsTo(cliente::class,"IdCliente");     
    }

    public function horario()
    {       
        return $this->belongsTo(Horario::class,"IdHorario");     
    }

    public function usuario() {       

        return $this->belongsTo(Usuario::class, 'IdUsuario');     
    }

    public function categoria() {       

        return $this->belongsTo(Categoria::class, 'IdCategoria');     
    }

    public function detalle() {       

        return $this->hasOne(DetalleCita::class, 'IdCita');     
    }


}

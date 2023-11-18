<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = "horario";
    protected $primaryKey = 'IdHorario';

    protected $fillable = [        
        'IdEmpleado',
        'IdCategoria',
        'fec_atencion',
        'costo',
    ];


    public function cita() {      

        return $this->hasMany(cita::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    protected $table = "moto";
    protected $primaryKey = 'IdMoto';

    protected $fillable = [
        'marca',
        'modelo',
        'color',
        'estado',
        'photo',
        'placa',
        'descripcion',
        
        // 'IdMotor'
    ];
    use HasFactory;
}

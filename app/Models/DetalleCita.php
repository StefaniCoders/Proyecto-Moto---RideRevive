<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCita extends Model
{
    use HasFactory;
    protected $table = "detallecita";
    protected $primaryKey = 'IdDetalleCita';
    protected $fillable = [
        "IdCita",
        "IdMoto",
        "IdMotor",
        "detalle_moto",
        "detalle_motor"
    ];
}

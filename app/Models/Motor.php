<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;
    protected $table = "motor";
    protected $primaryKey = 'IdMotor';
    protected $fillable = [
        "modelo",
        "potencia",
        "cilindrada",
        "estado",
        "observaciones"
    ];
}

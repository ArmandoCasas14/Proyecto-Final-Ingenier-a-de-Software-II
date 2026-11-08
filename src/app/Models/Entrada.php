<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $table = 'entradas';

    protected $fillable = [
        'funcion_id',
        'asiento_id',
        'codigo',
        'nombre_cliente',
        'estado'
    ];

    // Una entrada pertenece a una función
    public function funcion()
    {
        return $this->belongsTo(Funcion::class, 'funcion_id');
    }

    // Una entrada tiene asignado un asiento
    public function asiento()
    {
        return $this->belongsTo(Asiento::class, 'asiento_id');
    }
}

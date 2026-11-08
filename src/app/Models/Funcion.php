<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcion extends Model
{
    protected $table = 'funcions';

    protected $fillable = [
        'pelicula_id',
        'sala_id',
        'fecha',
        'hora',
        'precio'
    ];

    // Una función pertenece a una película
    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class);
    }

    // Una función pertenece a una sala
    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
    public function entradas()
    {
        return $this->hasMany(Entrada::class, 'funcion_id');
    }
}

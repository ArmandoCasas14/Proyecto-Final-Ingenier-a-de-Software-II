<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    //
    protected $table = 'peliculas';

    protected $fillable = [
        'nombre'
    ];
}

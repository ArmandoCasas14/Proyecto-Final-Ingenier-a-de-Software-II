<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'salas';

    protected $fillable = [
        'nombre',
        'filas',
        'asientos_for_fila',
        'capacidad'
    ];
    public function asientos()
    {
        return $this->hasMany(Asiento::class);
    }
}

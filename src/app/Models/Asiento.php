<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asiento extends Model
{
    protected $table = 'asientos';

    protected $fillable = [
        'sala_id',
        'fila',
        'numero'
    ];

    // Un asiento pertenece a una sala
    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
    public function entradas()
    {
        return $this->hasMany(Entrada::class, 'asiento_id');
    }
}

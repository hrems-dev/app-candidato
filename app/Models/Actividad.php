<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';
    protected $fillable = ['titulo', 'descripcion', 'fecha', 'ubicacion'];
    protected $casts = [
        'fecha' => 'datetime',
    ];
}

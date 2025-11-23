<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trayectoria extends Model
{
    protected $table = 'trayectorias';
    protected $fillable = ['titulo', 'descripcion', 'cargo', 'institucion', 'fecha_inicio', 'fecha_fin'];
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];
}

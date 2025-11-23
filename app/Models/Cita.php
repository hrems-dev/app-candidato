<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas';

    protected $fillable = [
        'user_id',
        'nombre',
        'email',
        'telefono',
        'asunto',
        'fecha_cita',
        'estado',
    ];

    protected $casts = [
        'fecha_cita' => 'datetime',
    ];

    /**
     * Relación: Una cita pertenece a un usuario
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Obtener el nombre de estado con color
     */
    public function getEstadoClase()
    {
        return match ($this->estado) {
            'pendiente' => 'bg-yellow-100 text-yellow-800',
            'confirmada' => 'bg-green-100 text-green-800',
            'cancelada' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
}

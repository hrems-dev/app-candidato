<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensajeContacto extends Model
{
    protected $table = 'mensajes_contacto';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'mensaje',
        'leido',
    ];

    protected $casts = [
        'leido' => 'boolean',
    ];

    /**
     * Marca el mensaje como leído
     */
    public function marcarComoLeido()
    {
        $this->update(['leido' => true]);
        return $this;
    }
}

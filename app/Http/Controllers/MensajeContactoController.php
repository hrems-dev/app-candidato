<?php

namespace App\Http\Controllers;

use App\Models\MensajeContacto;
use Illuminate\Http\Request;

class MensajeContactoController extends Controller
{
    /**
     * Mostrar formulario de contacto
     */
    public function create()
    {
        return view('contacto.create');
    }

    /**
     * Guardar mensaje de contacto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'mensaje' => 'required|string|max:1000',
        ]);

        MensajeContacto::create($validated);

        return redirect()->route('contacto.create')
            ->with('success', 'Mensaje enviado correctamente. Te contactaremos pronto.');
    }

    /**
     * Listar mensajes (admin)
     */
    public function indexAdmin()
    {
        $this->authorize('admin');
        $mensajes = MensajeContacto::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.mensajes.index', compact('mensajes'));
    }

    /**
     * Ver detalle del mensaje
     */
    public function show(MensajeContacto $mensaje)
    {
        $this->authorize('admin');
        $mensaje->marcarComoLeido();
        return view('admin.mensajes.show', compact('mensaje'));
    }

    /**
     * Eliminar mensaje
     */
    public function destroy(MensajeContacto $mensaje)
    {
        $this->authorize('admin');
        $mensaje->delete();

        return redirect()->route('admin.mensajes.index')
            ->with('success', 'Mensaje eliminado correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Trayectoria;
use Illuminate\Http\Request;

class TrayectoriaController extends Controller
{
    /**
     * Mostrar lista pública de trayectoria
     */
    public function index()
    {
        $trayectorias = Trayectoria::orderBy('anio_inicio', 'desc')->get();
        return view('trayectoria.index', compact('trayectorias'));
    }

    /**
     * Mostrar lista para admin
     */
    public function indexAdmin()
    {
        $trayectorias = Trayectoria::orderBy('fecha_inicio', 'desc')->paginate(10);
        return view('admin.trayectorias.index', compact('trayectorias'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('admin.trayectorias.create');
    }

    /**
     * Guardar nueva trayectoria
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'cargo' => 'required|string|max:255',
            'institucion' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        Trayectoria::create($validated);

        return redirect()->route('admin.trayectorias.index')
            ->with('success', 'Trayectoria creada correctamente');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Trayectoria $trayectoria)
    {
        return view('admin.trayectorias.edit', compact('trayectoria'));
    }

    /**
     * Actualizar trayectoria
     */
    public function update(Request $request, Trayectoria $trayectoria)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'cargo' => 'required|string|max:255',
            'institucion' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $trayectoria->update($validated);

        return redirect()->route('admin.trayectorias.index')
            ->with('success', 'Trayectoria actualizada correctamente');
    }

    /**
     * Eliminar trayectoria
     */
    public function destroy(Trayectoria $trayectoria)
    {
        $trayectoria->delete();

        return redirect()->route('admin.trayectorias.index')
            ->with('success', 'Trayectoria eliminada correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    /**
     * Mostrar lista pública de actividades
     */
    public function index()
    {
        $actividades = Actividad::orderBy('fecha', 'desc')->paginate(6);
        return view('actividades.index', compact('actividades'));
    }

    /**
     * Mostrar lista para admin
     */
    public function indexAdmin()
    {
        $actividades = Actividad::orderBy('fecha', 'desc')->paginate(10);
        return view('admin.actividades.index', compact('actividades'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('admin.actividades.create');
    }

    /**
     * Guardar nueva actividad
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'ubicacion' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('actividades', 'public');
        }

        Actividad::create($validated);

        return redirect()->route('admin.actividades.index')
            ->with('success', 'Actividad creada correctamente');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Actividad $actividad)
    {
        return view('admin.actividades.edit', compact('actividad'));
    }

    /**
     * Actualizar actividad
     */
    public function update(Request $request, Actividad $actividad)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'ubicacion' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($actividad->imagen && file_exists(public_path('storage/' . $actividad->imagen))) {
                unlink(public_path('storage/' . $actividad->imagen));
            }
            $validated['imagen'] = $request->file('imagen')->store('actividades', 'public');
        }

        $actividad->update($validated);

        return redirect()->route('admin.actividades.index')
            ->with('success', 'Actividad actualizada correctamente');
    }

    /**
     * Eliminar actividad
     */
    public function destroy(Actividad $actividad)
    {
        if ($actividad->imagen && file_exists(public_path('storage/' . $actividad->imagen))) {
            unlink(public_path('storage/' . $actividad->imagen));
        }

        $actividad->delete();

        return redirect()->route('admin.actividades.index')
            ->with('success', 'Actividad eliminada correctamente');
    }
}

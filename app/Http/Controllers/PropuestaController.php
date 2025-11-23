<?php

namespace App\Http\Controllers;

use App\Models\Propuesta;
use Illuminate\Http\Request;

class PropuestaController extends Controller
{
    /**
     * Mostrar lista pública de propuestas
     */
    public function index()
    {
        $propuestas = Propuesta::paginate(6);
        return view('propuestas.index', compact('propuestas'));
    }

    /**
     * Mostrar detalle de propuesta
     */
    public function show(Propuesta $propuesta)
    {
        return view('propuestas.show', compact('propuesta'));
    }

    /**
     * Mostrar lista para admin
     */
    public function indexAdmin()
    {
        $propuestas = Propuesta::paginate(10);
        return view('admin.propuestas.index', compact('propuestas'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('admin.propuestas.create');
    }

    /**
     * Guardar nueva propuesta
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('propuestas', 'public');
        }

        Propuesta::create($validated);

        return redirect()->route('admin.propuestas.index')
            ->with('success', 'Propuesta creada correctamente');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Propuesta $propuesta)
    {
        return view('admin.propuestas.edit', compact('propuesta'));
    }

    /**
     * Actualizar propuesta
     */
    public function update(Request $request, Propuesta $propuesta)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($propuesta->imagen && file_exists(public_path('storage/' . $propuesta->imagen))) {
                unlink(public_path('storage/' . $propuesta->imagen));
            }
            $validated['imagen'] = $request->file('imagen')->store('propuestas', 'public');
        }

        $propuesta->update($validated);

        return redirect()->route('admin.propuestas.index')
            ->with('success', 'Propuesta actualizada correctamente');
    }

    /**
     * Eliminar propuesta
     */
    public function destroy(Propuesta $propuesta)
    {
        if ($propuesta->imagen && file_exists(public_path('storage/' . $propuesta->imagen))) {
            unlink(public_path('storage/' . $propuesta->imagen));
        }

        $propuesta->delete();

        return redirect()->route('admin.propuestas.index')
            ->with('success', 'Propuesta eliminada correctamente');
    }
}

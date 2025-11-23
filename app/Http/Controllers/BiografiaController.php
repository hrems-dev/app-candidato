<?php

namespace App\Http\Controllers;

use App\Models\Biografia;
use Illuminate\Http\Request;

class BiografiaController extends Controller
{
    /**
     * Mostrar la biografía en la web pública
     */
    public function show()
    {
        $biografia = Biografia::obtener();
        return view('biografia.show', compact('biografia'));
    }

    /**
     * Mostrar formulario de edición para admin
     */
    public function edit()
    {
        $biografia = Biografia::obtener();
        return view('admin.biografias.edit', compact('biografia'));
    }

    /**
     * Actualizar la biografía
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'contenido' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $biografia = Biografia::obtener();

        if ($request->hasFile('imagen')) {
            if ($biografia->imagen && file_exists(public_path('storage/' . $biografia->imagen))) {
                unlink(public_path('storage/' . $biografia->imagen));
            }
            $validated['imagen'] = $request->file('imagen')->store('biografias', 'public');
        }

        $biografia->fill($validated)->save();

        return redirect()->route('admin.biografias.edit')
            ->with('success', 'Biografía actualizada correctamente');
    }
}

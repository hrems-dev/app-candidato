<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    /**
     * Mostrar lista pública de noticias
     */
    public function index()
    {
        $noticias = Noticia::where('publicado', true)
            ->orderBy('fecha_publicacion', 'desc')
            ->paginate(6);
        return view('noticias.index', compact('noticias'));
    }

    /**
     * Mostrar detalle de noticia
     */
    public function show(Noticia $noticia)
    {
        if (!$noticia->publicado) {
            abort(404);
        }
        return view('noticias.show', compact('noticia'));
    }

    /**
     * Mostrar lista para admin
     */
    public function indexAdmin()
    {
        $noticias = Noticia::orderBy('fecha_publicacion', 'desc')->paginate(10);
        return view('admin.noticias.index', compact('noticias'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('admin.noticias.create');
    }

    /**
     * Guardar nueva noticia
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'fecha_publicacion' => 'required|date',
            'publicado' => 'boolean',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('noticias', 'public');
        }

        Noticia::create($validated);

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia creada correctamente');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Noticia $noticia)
    {
        return view('admin.noticias.edit', compact('noticia'));
    }

    /**
     * Actualizar noticia
     */
    public function update(Request $request, Noticia $noticia)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'fecha_publicacion' => 'required|date',
            'publicado' => 'boolean',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($noticia->imagen && file_exists(public_path('storage/' . $noticia->imagen))) {
                unlink(public_path('storage/' . $noticia->imagen));
            }
            $validated['imagen'] = $request->file('imagen')->store('noticias', 'public');
        }

        $noticia->update($validated);

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia actualizada correctamente');
    }

    /**
     * Eliminar noticia
     */
    public function destroy(Noticia $noticia)
    {
        if ($noticia->imagen && file_exists(public_path('storage/' . $noticia->imagen))) {
            unlink(public_path('storage/' . $noticia->imagen));
        }

        $noticia->delete();

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia eliminada correctamente');
    }
}

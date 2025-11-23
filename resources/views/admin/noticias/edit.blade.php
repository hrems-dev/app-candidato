@extends('layouts.admin')

@section('title', 'Editar Noticia')
@section('page-title', '📰 Editar Noticia')
@section('page-description', 'Actualiza la información de esta noticia')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 max-w-3xl">
    <form action="{{ route('admin.noticias.update', $noticia) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="titulo" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Título *</label>
            <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $noticia->titulo) }}" required 
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">
            @error('titulo')
                <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="contenido" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Contenido *</label>
            <textarea id="contenido" name="contenido" rows="10" required 
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">{{ old('contenido', $noticia->contenido) }}</textarea>
            @error('contenido')
                <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="fecha_publicacion" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Fecha de Publicación *</label>
                <input type="datetime-local" id="fecha_publicacion" name="fecha_publicacion" value="{{ old('fecha_publicacion', $noticia->fecha_publicacion->format('Y-m-d\TH:i')) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">
                @error('fecha_publicacion')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="publicado" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Estado</label>
                <select id="publicado" name="publicado" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">
                    <option value="1" {{ old('publicado', $noticia->publicado) == 1 ? 'selected' : '' }}>✓ Publicado</option>
                    <option value="0" {{ old('publicado', $noticia->publicado) == 0 ? 'selected' : '' }}>⏸ Borrador</option>
                </select>
            </div>
        </div>

        <div>
            <label for="imagen" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">📷 Imagen (Portada)</label>
            @if($noticia->imagen)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="Noticia actual" class="max-w-xs h-auto rounded-lg shadow-md">
                <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">Imagen actual</p>
            </div>
            @endif
            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 transition"
                ondrop="handleDrop(event)" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)">
                <input type="file" id="imagen" name="imagen" accept="image/*" class="hidden"
                    onchange="previewImage(event)">
                <label for="imagen" class="cursor-pointer">
                    <p class="text-gray-600 dark:text-gray-400">Arrastra una imagen o haz clic para seleccionar</p>
                    <p class="text-gray-500 dark:text-gray-500 text-sm">PNG, JPG, GIF (máx. 2MB)</p>
                </label>
            </div>
            <img id="preview" class="mt-4 max-w-xs rounded-lg hidden" alt="Vista previa">
            @error('imagen')
                <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold transition">
                ✓ Actualizar
            </button>
            <a href="{{ route('admin.noticias.index') }}" class="bg-gray-400 hover:bg-gray-500 text-gray-900 dark:text-white px-8 py-3 rounded-lg font-bold transition">
                ✗ Cancelar
            </a>
        </div>
    </form>
</div>

<script>
    function handleDragOver(e) {
        e.preventDefault();
        e.currentTarget.style.borderColor = '#3b82f6';
        e.currentTarget.style.backgroundColor = '#eff6ff';
    }
    function handleDragLeave(e) {
        e.currentTarget.style.borderColor = '#d1d5db';
        e.currentTarget.style.backgroundColor = 'transparent';
    }
    function handleDrop(e) {
        e.preventDefault();
        const input = document.getElementById('imagen');
        input.files = e.dataTransfer.files;
        previewImage({ target: input });
    }
    function previewImage(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview');
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                preview.src = event.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection

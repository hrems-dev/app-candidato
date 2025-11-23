@extends('layouts.admin')

@section('title', 'Editar Trayectoria')
@section('page-title', '✏️ Editar Trayectoria')
@section('page-description', 'Actualiza la información de esta experiencia profesional')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 max-w-3xl">
    <form action="{{ route('admin.trayectorias.update', $trayectoria) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="titulo" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Título *</label>
            <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $trayectoria->titulo) }}" required 
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">
            @error('titulo')
                <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="descripcion" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Descripción *</label>
            <textarea id="descripcion" name="descripcion" rows="6" required 
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">{{ old('descripcion', $trayectoria->descripcion) }}</textarea>
            @error('descripcion')
                <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="cargo" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Cargo Desempeñado *</label>
            <input type="text" id="cargo" name="cargo" value="{{ old('cargo', $trayectoria->cargo) }}" required 
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">
            @error('cargo')
                <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="institucion" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Institución *</label>
            <input type="text" id="institucion" name="institucion" value="{{ old('institucion', $trayectoria->institucion) }}" required 
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">
            @error('institucion')
                <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="fecha_inicio" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Fecha Inicio *</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', $trayectoria->fecha_inicio->format('Y-m-d')) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">
                @error('fecha_inicio')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="fecha_fin" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Fecha Fin (Opcional)</label>
                <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin', $trayectoria->fecha_fin?->format('Y-m-d')) }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Deja vacío si continúas en este puesto</p>
                @error('fecha_fin')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold transition">
                ✓ Actualizar
            </button>
            <a href="{{ route('admin.trayectorias.index') }}" class="bg-gray-400 hover:bg-gray-500 text-gray-900 dark:text-white px-8 py-3 rounded-lg font-bold transition">
                ✗ Cancelar
            </a>
        </div>
    </form>
</div>

@endsection

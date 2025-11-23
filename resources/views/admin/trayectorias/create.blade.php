@extends('layouts.admin')

@section('title', 'Nueva Trayectoria')
@section('page-title', '📝 Nueva Trayectoria')
@section('page-description', 'Agrega una nueva experiencia profesional o especialidad legal')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 max-w-3xl">
    <form action="{{ route('admin.trayectorias.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="titulo" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Título *</label>
            <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" required 
                placeholder="Ej: Especialista en Derecho Civil"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">
            @error('titulo')
                <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="descripcion" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Descripción *</label>
            <textarea id="descripcion" name="descripcion" rows="6" required 
                placeholder="Describe en detalle la experiencia, logros y responsabilidades..."
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="cargo" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Cargo Desempeñado *</label>
            <input type="text" id="cargo" name="cargo" value="{{ old('cargo') }}" required 
                placeholder="Ej: Abogado Litigante"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">
            @error('cargo')
                <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="institucion" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Institución *</label>
            <input type="text" id="institucion" name="institucion" value="{{ old('institucion') }}" required 
                placeholder="Ej: Colegio de Abogados del Perú"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">
            @error('institucion')
                <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="fecha_inicio" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Fecha Inicio *</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">
                @error('fecha_inicio')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="fecha_fin" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Fecha Fin (Opcional)</label>
                <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 dark:focus:border-blue-400">
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Deja vacío si continúas en este puesto</p>
                @error('fecha_fin')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-bold transition">
                ✓ Crear
            </button>
            <a href="{{ route('admin.trayectorias.index') }}" class="bg-gray-400 hover:bg-gray-500 text-gray-900 dark:text-white px-8 py-3 rounded-lg font-bold transition">
                ✗ Cancelar
            </a>
        </div>
    </form>
</div>

@endsection

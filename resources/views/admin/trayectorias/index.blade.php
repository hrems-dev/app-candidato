@extends('layouts.admin')

@section('title', 'Trayectorias')
@section('page-title', '📚 Trayectorias y Experiencia')
@section('page-description', 'Gestiona la experiencia profesional y especialidades legales')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Listado de Trayectorias</h2>
    <a href="{{ route('admin.trayectorias.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-bold transition flex items-center gap-2">
        + Nueva Trayectoria
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 dark:bg-green-900/40 border border-green-400 dark:border-green-600 text-green-800 dark:text-green-300 px-4 py-3 rounded-lg mb-6">
    {{ session('success') }}
</div>
@endif

@if($trayectorias->isEmpty())
<div class="bg-gray-100 dark:bg-gray-700 border-l-4 border-blue-600 p-6 rounded-lg text-center">
    <p class="text-gray-700 dark:text-gray-300 mb-4">No hay trayectorias registradas aún</p>
    <a href="{{ route('admin.trayectorias.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold transition">
        Crear primera trayectoria
    </a>
</div>
@else
<div class="space-y-4">
    @foreach($trayectorias as $trayectoria)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-blue-600">
        <div class="flex justify-between items-start">
            <div class="flex-1">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $trayectoria->titulo }}</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-3">{{ Str::limit($trayectoria->descripcion, 150) }}</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500 dark:text-gray-400">Cargo:</span>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $trayectoria->cargo }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500 dark:text-gray-400">Institución:</span>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $trayectoria->institucion }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500 dark:text-gray-400">Desde:</span>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $trayectoria->fecha_inicio->format('M Y') }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500 dark:text-gray-400">Hasta:</span>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $trayectoria->fecha_fin?->format('M Y') ?? 'Presente' }}</p>
                    </div>
                </div>
            </div>
            <div class="flex gap-2 ml-4">
                <a href="{{ route('admin.trayectorias.edit', $trayectoria) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold transition">
                    ✏️ Editar
                </a>
                <form action="{{ route('admin.trayectorias.destroy', $trayectoria) }}" method="POST" onsubmit="return confirm('¿Eliminar esta trayectoria?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-bold transition">
                        🗑️ Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection

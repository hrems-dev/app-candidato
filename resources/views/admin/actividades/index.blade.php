@extends('layouts.admin')

@section('title', 'Gestión de Atenciones y Talleres')
@section('page-title', '📅 Atenciones y Talleres Legales')
@section('page-description', 'Programa y administra talleres, citas y actividades legales')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div></div>
    <a href="{{ route('admin.actividades.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition">
        + Nueva Atención
    </a>
</div>

@if($actividades->count() > 0)
    <div class="space-y-4">
        @foreach($actividades as $actividad)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition border-l-4 border-blue-600">
            <div class="flex justify-between items-start gap-4">
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $actividad->titulo }}</h3>
                    <div class="flex flex-wrap gap-4 text-sm text-gray-600 dark:text-gray-400 mb-3">
                        <span>📅 {{ $actividad->fecha->format('d/m/Y H:i') }}</span>
                        <span>📍 {{ $actividad->ubicacion }}</span>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300">{{ Str::limit($actividad->descripcion, 200) }}</p>
                </div>
                <div class="flex gap-2 flex-shrink-0">
                    <a href="{{ route('admin.actividades.edit', $actividad) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold transition">
                        ✏️ Editar
                    </a>
                    <form action="{{ route('admin.actividades.destroy', $actividad) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm font-semibold transition" onclick="return confirm('¿Eliminar atención?')">
                            🗑️ Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="mt-8">
        {{ $actividades->links() }}
    </div>
@else
    <div class="bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-800 text-yellow-800 dark:text-yellow-200 px-6 py-8 rounded-lg text-center">
        <p class="text-lg mb-4">📭 No hay atenciones o talleres programados</p>
        <a href="{{ route('admin.actividades.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition">
            Crear primera atención
        </a>
    </div>
@endif

@endsection
    </div>

    @include('include.footer')
</body>
</html>

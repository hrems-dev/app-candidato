@extends('layouts.admin')

@section('title', 'Gestión de Noticias')
@section('page-title', '📰 Noticias y Artículos')
@section('page-description', 'Publica y administra noticias sobre servicios legales')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div></div>
    <a href="{{ route('admin.noticias.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition">
        + Nueva Noticia
    </a>
</div>

@if($noticias->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach($noticias as $noticia)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            @if($noticia->imagen)
                <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                    <span class="text-gray-600">📷 Sin imagen</span>
                </div>
            @endif
            <div class="p-5">
                <div class="flex items-start justify-between mb-2">
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white flex-1">{{ $noticia->titulo }}</h3>
                    <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $noticia->publicado ? 'bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-200' : 'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-800 dark:text-yellow-200' }}">
                        {{ $noticia->publicado ? '✓ Pub' : '⏸ Borrador' }}
                    </span>
                </div>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">{{ Str::limit($noticia->contenido, 100) }}</p>
                <p class="text-gray-500 dark:text-gray-400 text-xs mb-4">{{ $noticia->fecha_publicacion->format('d/m/Y') }}</p>
                <div class="flex gap-2">
                    <a href="{{ route('admin.noticias.edit', $noticia) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold text-center transition">
                        ✏️ Editar
                    </a>
                    <form action="{{ route('admin.noticias.destroy', $noticia) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm font-semibold transition" onclick="return confirm('¿Eliminar noticia?')">
                            🗑️ Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="flex justify-center">
        {{ $noticias->links() }}
    </div>
@else
    <div class="bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-800 text-yellow-800 dark:text-yellow-200 px-6 py-8 rounded-lg text-center">
        <p class="text-lg mb-4">📭 No hay noticias publicadas</p>
        <a href="{{ route('admin.noticias.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition">
            Crear primera noticia
        </a>
    </div>
@endif

@endsection

@extends('layouts.admin')

@section('title', 'Mensajes de Contacto')
@section('page-title', '💬 Mensajes de Contacto')
@section('page-description', 'Consultas y mensajes de usuarios sobre servicios legales')

@section('content')
<div class="space-y-4">
    @if($mensajes->count() > 0)
        @foreach($mensajes as $mensaje)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 {{ $mensaje->leido ? 'border-gray-300 dark:border-gray-600' : 'border-blue-600' }}">
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $mensaje->nombre }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $mensaje->email }}</p>
                    @if($mensaje->telefono)
                    <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $mensaje->telefono }}</p>
                    @endif
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Asunto: <strong>{{ $mensaje->asunto }}</strong></p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $mensaje->created_at->format('d/m/Y H:i') }}</p>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $mensaje->leido ? 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-300' : 'bg-blue-200 dark:bg-blue-900/40 text-blue-800 dark:text-blue-200' }} mt-2">
                        {{ $mensaje->leido ? '✓ Leído' : '● No leído' }}
                    </span>
                </div>
            </div>

            <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $mensaje->mensaje }}</p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('admin.mensajes.show', $mensaje) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold transition">
                    Ver Detalles
                </a>
                <form action="{{ route('admin.mensajes.destroy', $mensaje) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm font-semibold transition" onclick="return confirm('¿Eliminar este mensaje?')">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
        @endforeach

        <!-- Paginación -->
        <div class="mt-8">
            {{ $mensajes->links() }}
        </div>
    @else
        <div class="bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-800 text-yellow-800 dark:text-yellow-200 px-6 py-8 rounded-lg text-center">
            <p class="text-lg">📭 No hay mensajes de contacto</p>
        </div>
    @endif
</div>

@endsection

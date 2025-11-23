@extends('layouts.admin')

@section('title', 'Dashboard Administrativo')
@section('page-title', '📊 Dashboard')
@section('page-description', 'Panel de control y estadísticas del sistema')

@section('content')
<!-- ESTADÍSTICAS PRINCIPALES -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total de Citas -->
    <div class="bg-white dark:bg-gray-800 border-l-4 border-green-600 rounded-lg p-6 shadow-lg hover-lift">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Total de Citas</p>
                <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $totalCitas ?? 0 }}</p>
                <p class="text-gray-500 dark:text-gray-500 text-xs mt-2">Consultas legales registradas</p>
            </div>
            <div class="text-5xl opacity-20">📋</div>
        </div>
    </div>

    <!-- Citas Pendientes -->
    <div class="bg-white dark:bg-gray-800 border-l-4 border-yellow-600 rounded-lg p-6 shadow-lg hover-lift">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Citas Pendientes</p>
                <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $citasPendientes ?? 0 }}</p>
                <p class="text-gray-500 dark:text-gray-500 text-xs mt-2">Por confirmar o rechazar</p>
            </div>
            <div class="text-5xl opacity-20">⏳</div>
        </div>
    </div>

    <!-- Total Mensajes -->
    <div class="bg-white dark:bg-gray-800 border-l-4 border-blue-600 rounded-lg p-6 shadow-lg hover-lift">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Total Mensajes</p>
                <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $totalMensajes ?? 0 }}</p>
                <p class="text-gray-500 dark:text-gray-500 text-xs mt-2">Desde formulario de contacto</p>
            </div>
            <div class="text-5xl opacity-20">💬</div>
        </div>
    </div>

    <!-- Mensajes No Leídos -->
    <div class="bg-white dark:bg-gray-800 border-l-4 border-red-600 rounded-lg p-6 shadow-lg hover-lift">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Mensajes No Leídos</p>
                <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $mensajesNoLeidos ?? 0 }}</p>
                <p class="text-gray-500 dark:text-gray-500 text-xs mt-2">Requieren atención</p>
            </div>
            <div class="text-5xl opacity-20">📨</div>
        </div>
    </div>
</div>

<!-- SECCIONES SECUNDARIAS -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Noticias Publicadas -->
    <div class="bg-white dark:bg-gray-800 border-2 border-green-200 dark:border-green-800 rounded-lg p-6 shadow-lg hover-lift">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">📰 Noticias</h3>
            <span class="text-3xl font-extrabold text-green-600">{{ $totalNoticias ?? 0 }}</span>
        </div>
        <p class="text-gray-600 dark:text-gray-400 text-sm">Artículos publicados</p>
        <a href="{{ route('admin.noticias.index') }}" class="inline-block mt-4 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition">
            Gestionar →
        </a>
    </div>

    <!-- Atenciones/Talleres -->
    <div class="bg-white dark:bg-gray-800 border-2 border-blue-200 dark:border-blue-800 rounded-lg p-6 shadow-lg hover-lift">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">📅 Atenciones</h3>
            <span class="text-3xl font-extrabold text-blue-600">{{ $totalActividades ?? 0 }}</span>
        </div>
        <p class="text-gray-600 dark:text-gray-400 text-sm">Talleres y consultas programadas</p>
        <a href="{{ route('admin.actividades.index') }}" class="inline-block mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition">
            Gestionar →
        </a>
    </div>

    <!-- Especialidades -->
    <div class="bg-white dark:bg-gray-800 border-2 border-purple-200 dark:border-purple-800 rounded-lg p-6 shadow-lg hover-lift">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">📚 Trayectorias</h3>
            <span class="text-3xl font-extrabold text-purple-600">{{ $totalTrayectorias ?? 0 }}</span>
        </div>
        <p class="text-gray-600 dark:text-gray-400 text-sm">Experiencias profesionales</p>
        <a href="{{ route('admin.trayectorias.index') }}" class="inline-block mt-4 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-semibold transition">
            Gestionar →
        </a>
    </div>
</div>

<!-- TABLA: ÚLTIMAS CITAS -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">📋 Últimas Citas Agendadas</h3>
        <a href="{{ route('admin.citas.index') }}" class="text-green-600 hover:text-green-700 font-semibold">Ver todas →</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 dark:text-white">Nombre</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 dark:text-white">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 dark:text-white">Teléfono</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 dark:text-white">Fecha</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 dark:text-white">Estado</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-900 dark:text-white">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ultimasCitas ?? [] as $cita)
                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                    <td class="px-6 py-4 text-gray-900 dark:text-white font-semibold">{{ $cita->nombre }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $cita->email }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $cita->telefono }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $cita->fecha_cita?->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4">
                        @if($cita->estado === 'pendiente')
                            <span class="inline-block px-3 py-1 bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-300 rounded-full text-xs font-bold">⏳ Pendiente</span>
                        @elseif($cita->estado === 'confirmada')
                            <span class="inline-block px-3 py-1 bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 rounded-full text-xs font-bold">✓ Confirmada</span>
                        @else
                            <span class="inline-block px-3 py-1 bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300 rounded-full text-xs font-bold">✗ Cancelada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.citas.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">Gestionar</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-600 dark:text-gray-400">
                        No hay citas registradas aún
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- TABLA: ÚLTIMOS MENSAJES -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">💬 Últimos Mensajes de Contacto</h3>
        <a href="{{ route('admin.mensajes.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Ver todos →</a>
    </div>

    <div class="space-y-4">
        @forelse($ultimosMensajes ?? [] as $mensaje)
        <div class="bg-gray-50 dark:bg-gray-700/50 border-l-4 {{ $mensaje->leido ? 'border-gray-400' : 'border-blue-600' }} rounded-lg p-4 hover:shadow-md transition">
            <div class="flex items-start justify-between mb-2">
                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white">{{ $mensaje->nombre }}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $mensaje->email }}</p>
                </div>
                @if(!$mensaje->leido)
                    <span class="inline-block px-2 py-1 bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 rounded text-xs font-bold">Nuevo</span>
                @endif
            </div>
            <p class="text-gray-700 dark:text-gray-300 text-sm mb-2"><strong>Asunto:</strong> {{ $mensaje->asunto }}</p>
            <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">{{ Str::limit($mensaje->mensaje, 100) }}</p>
            <div class="flex gap-2 justify-between items-center">
                <span class="text-xs text-gray-500 dark:text-gray-500">{{ $mensaje->created_at?->diffForHumans() }}</span>
                <a href="{{ route('admin.mensajes.index') }}" class="text-red-600 hover:text-red-700 font-semibold text-sm">Ver detalles</a>
            </div>
        </div>
        @empty
        <div class="text-center py-8 text-gray-600 dark:text-gray-400">
            No hay mensajes registrados aún
        </div>
        @endforelse
    </div>
</div>

<style>
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-lift:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}
</style>

@endsection

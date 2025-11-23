@extends('layouts.admin')

@section('title', 'Dashboard - Panel Admin')
@section('page-title', '📊 Dashboard')
@section('page-description', 'Resumen de la plataforma de asesoría legal')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Total de Citas -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-t-4 border-blue-600">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Citas Totales</p>
                <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalCitas }}</p>
            </div>
            <div class="text-4xl">📋</div>
        </div>
    </div>

    <!-- Citas Pendientes -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-t-4 border-yellow-600">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Citas Pendientes</p>
                <p class="text-4xl font-bold text-yellow-600 mt-2">{{ $citasPendientes }}</p>
            </div>
            <div class="text-4xl">⏳</div>
        </div>
    </div>

    <!-- Total de Mensajes -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-t-4 border-green-600">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Mensajes Totales</p>
                <p class="text-4xl font-bold text-green-600 mt-2">{{ $totalMensajes }}</p>
            </div>
            <div class="text-4xl">💬</div>
        </div>
    </div>

    <!-- Mensajes No Leídos -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-t-4 border-purple-600">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">No Leídos</p>
                <p class="text-4xl font-bold text-purple-600 mt-2">{{ $mensajesNoLeidos }}</p>
            </div>
            <div class="text-4xl">🔔</div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Noticias -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">📰 Noticias</h3>
            <span class="text-3xl font-bold text-blue-600">{{ $totalNoticias }}</span>
        </div>
        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Noticias publicadas en la web</p>
        <a href="{{ route('admin.noticias.index') }}" class="inline-block text-blue-600 hover:text-blue-700 font-semibold">Ver todas →</a>
    </div>

    <!-- Actividades -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">📅 Atenciones</h3>
            <span class="text-3xl font-bold text-green-600">{{ $totalActividades }}</span>
        </div>
        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Talleres y citas programadas</p>
        <a href="{{ route('admin.actividades.index') }}" class="inline-block text-blue-600 hover:text-blue-700 font-semibold">Ver todas →</a>
    </div>

    <!-- Especialidades -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">⚖️ Especialidades</h3>
            <span class="text-3xl font-bold text-orange-600">3</span>
        </div>
        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Derecho Civil, Penal, Laboral</p>
        <a href="{{ route('admin.trayectorias.index') }}" class="inline-block text-blue-600 hover:text-blue-700 font-semibold">Editar →</a>
    </div>
</div>

<!-- Últimas Citas -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold">Últimas Solicitudes de Citas</h3>
        <a href="{{ route('admin.citas.index') }}" class="text-blue-600 hover:text-blue-700">Ver todas →</a>
    </div>

    @if($ultimasCitas->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 dark:bg-gray-700 border-b dark:border-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Nombre</th>
                        <th class="px-4 py-3 text-left font-semibold">Email</th>
                        <th class="px-4 py-3 text-left font-semibold">Teléfono</th>
                        <th class="px-4 py-3 text-left font-semibold">Fecha Cita</th>
                        <th class="px-4 py-3 text-left font-semibold">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ultimasCitas as $cita)
                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-3">{{ $cita->nombre }}</td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $cita->email }}</td>
                        <td class="px-4 py-3">{{ $cita->telefono }}</td>
                        <td class="px-4 py-3">{{ $cita->fecha_cita->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $cita->getEstadoClase() }}">
                                {{ ucfirst($cita->estado) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-600 dark:text-gray-400 text-center py-8">No hay solicitudes de citas aún</p>
    @endif
</div>

<!-- Últimos Mensajes -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold">Últimos Mensajes de Contacto</h3>
        <a href="{{ route('admin.mensajes.index') }}" class="text-blue-600 hover:text-blue-700">Ver todos →</a>
    </div>

    @if($ultimosMensajes->count() > 0)
        <div class="space-y-3">
            @foreach($ultimosMensajes as $mensaje)
            <div class="border-l-4 {{ $mensaje->leido ? 'border-gray-300' : 'border-blue-600' }} pl-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <p class="font-bold text-gray-900 dark:text-white">{{ $mensaje->nombre }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $mensaje->email }}</p>
                        <p class="text-gray-700 dark:text-gray-300 text-sm mt-1">{{ Str::limit($mensaje->mensaje, 100) }}</p>
                    </div>
                    <span class="text-gray-500 text-xs whitespace-nowrap ml-4">{{ $mensaje->created_at->diffForHumans() }}</span>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600 dark:text-gray-400 text-center py-8">No hay mensajes aún</p>
    @endif
</div>

@endsection

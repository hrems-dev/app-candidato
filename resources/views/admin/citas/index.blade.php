@extends('layouts.admin')

@section('title', 'Gestión de Citas Legales')
@section('page-title', '📋 Citas Legales')
@section('page-description', 'Administra todas las solicitudes de citas de los usuarios')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    @if($citas->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 dark:bg-gray-700 border-b dark:border-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">Nombre</th>
                        <th class="px-6 py-3 text-left font-semibold">Email</th>
                        <th class="px-6 py-3 text-left font-semibold">Teléfono</th>
                        <th class="px-6 py-3 text-left font-semibold">Fecha Cita</th>
                        <th class="px-6 py-3 text-left font-semibold">Asunto</th>
                        <th class="px-6 py-3 text-left font-semibold">Estado</th>
                        <th class="px-6 py-3 text-left font-semibold">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-4">{{ $cita->nombre }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $cita->email }}</td>
                        <td class="px-6 py-4">{{ $cita->telefono }}</td>
                        <td class="px-6 py-4">{{ $cita->fecha_cita->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4">{{ Str::limit($cita->asunto, 30) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $cita->getEstadoClase() }}">
                                {{ ucfirst($cita->estado) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2 flex-wrap">
                                @if($cita->estado === 'pendiente')
                                    <form action="{{ route('admin.citas.aprobar', $cita) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-semibold transition" title="Enviar email de confirmación">
                                            ✓ Confirmar
                                        </button>
                                    </form>
                                    <button type="button" onclick="mostrarModalRechazo({{ $cita->id }}, '{{ $cita->nombre }}')" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-semibold transition" title="Rechazar con motivo">
                                        ✗ Cancelar
                                    </button>
                                @endif
                                <form action="{{ route('admin.citas.destroy', $cita) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-xs font-semibold transition" onclick="return confirm('¿Eliminar definitivamente?')">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $citas->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-600 dark:text-gray-400 text-lg">No hay solicitudes de citas aún</p>
        </div>
    @endif
</div>

<!-- Modal para rechazar cita -->
<div id="modalRechazo" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50" onclick="cerrarModalRechazo(event)">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full mx-4" onclick="event.stopPropagation()">
        <div class="bg-red-600 text-white px-6 py-4 border-b dark:border-gray-700">
            <h2 class="text-lg font-bold">❌ Cancelar Cita</h2>
        </div>
        <form id="formRechazo" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <p class="text-gray-700 dark:text-gray-300 mb-4">
                    ¿Deseas cancelar la cita de <strong id="nombreCita"></strong>?
                </p>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                    Se enviará un email al usuario con el motivo del rechazo.
                </p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Motivo del rechazo (opcional)
                </label>
                <textarea 
                    name="razon_rechazo" 
                    placeholder="Ej: Conflicto de horario, tema no disponible, etc."
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                    rows="3"></textarea>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="cerrarModalRechazo()" class="flex-1 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 px-4 py-2 rounded-lg font-semibold hover:bg-gray-400 dark:hover:bg-gray-500 transition">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                    Rechazar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function mostrarModalRechazo(citaId, nombre) {
    document.getElementById('nombreCita').textContent = nombre;
    const form = document.getElementById('formRechazo');
    form.action = `/admin/citas/${citaId}/rechazar`;
    document.getElementById('modalRechazo').classList.remove('hidden');
    document.getElementById('modalRechazo').classList.add('flex');
}

function cerrarModalRechazo(event) {
    if (event && event.target.id !== 'modalRechazo') return;
    document.getElementById('modalRechazo').classList.add('hidden');
    document.getElementById('modalRechazo').classList.remove('flex');
    document.getElementById('formRechazo').reset();
}

// Cerrar modal al presionar ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        cerrarModalRechazo();
    }
});
</script>

@endsection

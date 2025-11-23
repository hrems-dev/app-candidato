<!DOCTYPE html>
<html lang="es">
<head>
    @include('include.head')
</head>
<body class="bg-gray-50">
    @include('include.header')

    <div class="container mx-auto py-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-12">Mis Citas Solicitadas</h1>

        @if($citas->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="w-full">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-gray-700 font-bold">Fecha</th>
                        <th class="px-6 py-3 text-left text-gray-700 font-bold">Hora</th>
                        <th class="px-6 py-3 text-left text-gray-700 font-bold">Motivo</th>
                        <th class="px-6 py-3 text-left text-gray-700 font-bold">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $cita->fecha->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">{{ $cita->hora }}</td>
                        <td class="px-6 py-4">{{ Str::limit($cita->motivo, 50) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-sm font-bold {{ $cita->getEstadoClase() }}">
                                {{ ucfirst($cita->estado) }}
                            </span>
                        </td>
                    </tr>
                    @if($cita->estado === 'rechazado' && $cita->razon_rechazo)
                    <tr class="bg-red-50 border-b">
                        <td colspan="4" class="px-6 py-4 text-red-800">
                            <strong>Razón del rechazo:</strong> {{ $cita->razon_rechazo }}
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-6 py-4 rounded-lg">
            <p class="mb-4">No has solicitado ninguna cita aún.</p>
            <a href="{{ route('citas.create') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Solicitar Nueva Cita
            </a>
        </div>
        @endif

        <div class="mt-8 border-t pt-8">
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">← Volver al dashboard</a>
        </div>
    </div>

    @include('include.footer')
</body>
</html>

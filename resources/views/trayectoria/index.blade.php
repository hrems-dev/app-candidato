<!DOCTYPE html>
<html lang="es">
<head>
    @include('include.head')
</head>
<body class="bg-gray-50">
    @include('include.header')

    <div class="container mx-auto py-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-12">Trayectoria</h1>

        <div class="space-y-8">
            @forelse($trayectorias as $trayectoria)
            <div class="bg-white rounded-lg shadow-md p-8 border-l-4 border-blue-600">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $trayectoria->titulo }}</h3>
                        <p class="text-blue-600 font-semibold">{{ $trayectoria->institucion }}</p>
                    </div>
                    <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-bold">
                        {{ $trayectoria->anio_inicio }}@if($trayectoria->anio_fin) - {{ $trayectoria->anio_fin }}@else - Actualidad@endif
                    </span>
                </div>
                <p class="text-gray-700 leading-relaxed">{{ $trayectoria->descripcion }}</p>
            </div>
            @empty
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-6 py-4 rounded-lg">
                No hay información de trayectoria disponible.
            </div>
            @endforelse
        </div>

        <div class="mt-12 border-t pt-8">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">← Volver al inicio</a>
        </div>
    </div>

    @include('include.footer')
</body>
</html>

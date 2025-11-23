<!DOCTYPE html>
<html lang="es">
<head>
    @include('include.head')
</head>
<body class="bg-gray-50">
    @include('include.header')

    <div class="container mx-auto py-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-12">Actividades</h1>

        <div class="grid md:grid-cols-2 gap-8 mb-12">
            @forelse($actividades as $actividad)
            <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                @if($actividad->imagen)
                    <img src="{{ asset('storage/' . $actividad->imagen) }}" alt="{{ $actividad->titulo }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                        <span class="text-gray-500">Sin imagen</span>
                    </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3 text-gray-600">
                        <span>📅 {{ $actividad->fecha->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex items-center gap-2 mb-4 text-gray-600">
                        <span>📍 {{ $actividad->lugar }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $actividad->titulo }}</h3>
                    <p class="text-gray-600">{{ Str::limit($actividad->descripcion, 150) }}</p>
                </div>
            </article>
            @empty
            <div class="col-span-2 bg-yellow-50 border border-yellow-200 text-yellow-800 px-6 py-4 rounded-lg">
                No hay actividades programadas.
            </div>
            @endforelse
        </div>

        <!-- Paginación -->
        @if(method_exists($actividades, 'links'))
        <div class="flex justify-center mb-12">
            {{ $actividades->links() }}
        </div>
        @endif

        <div class="border-t pt-8">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">← Volver al inicio</a>
        </div>
    </div>

    @include('include.footer')
</body>
</html>

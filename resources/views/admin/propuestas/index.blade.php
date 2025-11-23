<!DOCTYPE html>
<html lang="es">
<head>
    @include('include.head')
</head>
<body class="bg-gray-50">
    @include('include.header')

    <div class="container mx-auto py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900">💡 Propuestas</h1>
            <a href="{{ route('admin.propuestas.create') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                + Nueva
            </a>
        </div>

        @if($propuestas->count() > 0)
        <div class="grid md:grid-cols-2 gap-6 mb-12">
            @foreach($propuestas as $propuesta)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                @if($propuesta->imagen)
                    <img src="{{ asset('storage/' . $propuesta->imagen) }}" alt="{{ $propuesta->titulo }}" class="w-full h-40 object-cover">
                @else
                    <div class="w-full h-40 bg-gray-300 flex items-center justify-center">
                        <span class="text-gray-500">Sin imagen</span>
                    </div>
                @endif
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">{{ $propuesta->titulo }}</h3>
                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($propuesta->descripcion, 80) }}</p>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.propuestas.edit', $propuesta) }}" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm text-center">
                            Editar
                        </a>
                        <form action="{{ route('admin.propuestas.destroy', $propuesta) }}" method="POST" class="flex-1" onsubmit="return confirm('¿Seguro?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-sm">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="flex justify-center">
            {{ $propuestas->links() }}
        </div>
        @else
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-6 py-4 rounded-lg">
            No hay propuestas. <a href="{{ route('admin.propuestas.create') }}" class="font-bold">Crear nueva</a>
        </div>
        @endif
    </div>

    @include('include.footer')
</body>
</html>

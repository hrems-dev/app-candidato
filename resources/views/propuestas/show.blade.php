<!DOCTYPE html>
<html lang="es">
<head>
    @include('include.head')
</head>
<body class="bg-gray-50">
    @include('include.header')

    <div class="container mx-auto py-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">{{ $propuesta->titulo }}</h1>

        @if($propuesta->imagen)
            <img src="{{ asset('storage/' . $propuesta->imagen) }}" alt="{{ $propuesta->titulo }}" class="w-full h-96 object-cover rounded-lg mb-12">
        @endif

        <div class="bg-white rounded-lg shadow-md p-8 mb-12">
            <div class="prose max-w-none text-gray-700 leading-relaxed">
                {!! nl2br(e($propuesta->descripcion)) !!}
            </div>
        </div>

        <div class="border-t pt-8">
            <a href="{{ route('propuestas.index') }}" class="text-blue-600 hover:text-blue-800">← Volver a propuestas</a>
        </div>
    </div>

    @include('include.footer')
</body>
</html>

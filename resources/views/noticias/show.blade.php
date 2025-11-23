<!DOCTYPE html>
<html lang="es">
<head>
    @include('include.head')
</head>
<body class="bg-gray-50">
    @include('include.header')

    <div class="container mx-auto py-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">{{ $noticia->titulo }}</h1>

        @if($noticia->imagen)
            <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}" class="w-full h-96 object-cover rounded-lg mb-8">
        @endif

        <div class="bg-white rounded-lg shadow-md p-8 mb-12">
            <p class="text-gray-500 mb-6">Publicado: {{ $noticia->fecha_publicacion->format('d/m/Y H:i') }}</p>
            <div class="prose max-w-none text-gray-700 leading-relaxed">
                {!! nl2br(e($noticia->contenido)) !!}
            </div>
        </div>

        <div class="border-t pt-8">
            <a href="{{ route('noticias.index') }}" class="text-blue-600 hover:text-blue-800">← Volver a noticias</a>
        </div>
    </div>

    @include('include.footer')
</body>
</html>

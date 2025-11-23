<!DOCTYPE html>
<html lang="es">
<head>
    @include('include.head')
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    </style>
</head>
<body class="bg-gray-50">
    @include('include.header')

    <div class="container mx-auto py-12">
        @if($biografia->imagen)
            <img src="{{ asset('storage/' . $biografia->imagen) }}" alt="Biografía" class="w-full h-96 object-cover rounded-lg mb-12">
        @endif

        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-8">{{ $biografia->titulo }}</h1>
            
            <div class="prose max-w-none text-gray-700 leading-relaxed mb-12">
                {!! nl2br(e($biografia->contenido)) !!}
            </div>

            @if($biografia->vision)
            <div class="grid md:grid-cols-2 gap-8 mb-8">
                <div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-600">
                    <h3 class="text-xl font-bold text-blue-900 mb-4">👁️ Visión</h3>
                    <p class="text-gray-700">{{ $biografia->vision }}</p>
                </div>
                @if($biografia->mision)
                <div class="bg-green-50 p-6 rounded-lg border-l-4 border-green-600">
                    <h3 class="text-xl font-bold text-green-900 mb-4">🎯 Misión</h3>
                    <p class="text-gray-700">{{ $biografia->mision }}</p>
                </div>
                @endif
            </div>
            @endif

            <div class="border-t pt-8 mt-8">
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">← Volver al inicio</a>
            </div>
        </div>
    </div>

    @include('include.footer')
</body>
</html>

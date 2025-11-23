<!DOCTYPE html>
<html lang="es">
<head>
    @include('include.head')
</head>
<body class="bg-gray-50">
    @include('include.header')

    <div class="container mx-auto py-12 max-w-2xl">
        <h1 class="text-4xl font-bold text-gray-900 mb-12">Envíanos un Mensaje</h1>

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-lg mb-6">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('contacto.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
            @csrf

            <div class="mb-6">
                <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre *</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label for="correo" class="block text-gray-700 font-bold mb-2">Correo Electrónico *</label>
                <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label for="telefono" class="block text-gray-700 font-bold mb-2">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label for="mensaje" class="block text-gray-700 font-bold mb-2">Mensaje *</label>
                <textarea id="mensaje" name="mensaje" rows="6" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">{{ old('mensaje') }}</textarea>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 font-bold transition">
                    Enviar Mensaje
                </button>
                <a href="{{ route('home') }}" class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-400 font-bold transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    @include('include.footer')
</body>
</html>

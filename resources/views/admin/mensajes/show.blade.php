<!DOCTYPE html>
<html lang="es">
<head>
    @include('include.head')
</head>
<body class="bg-gray-50">
    @include('include.header')

    <div class="container mx-auto py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Mensaje de Contacto</h1>
            <a href="{{ route('admin.mensajes.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700">
                Volver
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-8 max-w-2xl">
            <div class="grid md:grid-cols-2 gap-8 mb-8">
                <div>
                    <p class="text-gray-600 font-semibold">Nombre</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $mensaje->nombre }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Recibido</p>
                    <p class="text-lg text-gray-900">{{ $mensaje->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Correo</p>
                    <p class="text-lg text-blue-600">{{ $mensaje->correo }}</p>
                </div>
                @if($mensaje->telefono)
                <div>
                    <p class="text-gray-600 font-semibold">Teléfono</p>
                    <p class="text-lg text-gray-900">{{ $mensaje->telefono }}</p>
                </div>
                @endif
            </div>

            <div class="border-t pt-8 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Mensaje</h3>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $mensaje->mensaje }}</p>
                </div>
            </div>

            <div class="flex gap-4">
                <form action="{{ route('admin.mensajes.destroy', $mensaje) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 font-bold">
                        Eliminar
                    </button>
                </form>
                <a href="{{ route('admin.mensajes.index') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 font-bold">
                    Volver
                </a>
            </div>
        </div>
    </div>

    @include('include.footer')
</body>
</html>

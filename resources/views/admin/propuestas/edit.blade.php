<!DOCTYPE html>
<html lang="es">
<head>
    @include('include.head')
</head>
<body class="bg-gray-50">
    @include('include.header')

    <div class="container mx-auto py-12 max-w-3xl">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Editar Propuesta</h1>

        <form action="{{ route('admin.propuestas.update', $propuesta) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
            @csrf
            @method('PUT')

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-lg mb-6">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="mb-6">
                <label for="titulo" class="block text-gray-700 font-bold mb-2">Título *</label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $propuesta->titulo) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción *</label>
                <textarea id="descripcion" name="descripcion" rows="8" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">{{ old('descripcion', $propuesta->descripcion) }}</textarea>
            </div>

            <div class="mb-6">
                <label for="imagen" class="block text-gray-700 font-bold mb-2">Imagen</label>
                @if($propuesta->imagen)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $propuesta->imagen) }}" alt="Propuesta" class="w-48 h-48 object-cover rounded-lg">
                </div>
                @endif
                <input type="file" id="imagen" name="imagen" accept="image/*" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 font-bold">
                    Actualizar
                </button>
                <a href="{{ route('admin.propuestas.index') }}" class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-400 font-bold">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    @include('include.footer')
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    @include('include.head')
</head>
<body class="bg-gray-50">
    @include('include.header')

    <div class="container mx-auto py-12 max-w-2xl">
        @if(auth()->check())
            <h1 class="text-4xl font-bold text-gray-900 mb-12">Solicitar Cita Legal Gratuita</h1>

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-lg mb-6">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('citas.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
                @csrf

                <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <p class="text-blue-800 text-sm">
                        <strong>✓ Datos completados automáticamente:</strong><br>
                        Nombre: {{ auth()->user()->name }}<br>
                        Correo: {{ auth()->user()->email }}<br>
                        Teléfono: {{ auth()->user()->phone ?? 'No registrado - actualiza tu perfil' }}
                    </p>
                </div>

                <!-- Campos ocultos con datos del usuario -->
                <input type="hidden" name="nombre" value="{{ auth()->user()->name }}">
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <input type="hidden" name="telefono" value="{{ auth()->user()->phone }}">

                <div class="mb-6">
                    <label for="asunto" class="block text-gray-700 font-bold mb-2">Asunto/Motivo de la Consulta *</label>
                    <input type="text" id="asunto" name="asunto" value="{{ old('asunto') }}" required 
                        placeholder="Ej: Consulta sobre derecho laboral"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 @error('asunto') border-red-500 @enderror">
                    @error('asunto')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="fecha" class="block text-gray-700 font-bold mb-2">Fecha de la Cita *</label>
                        <input type="date" id="fecha" name="fecha" value="{{ old('fecha') }}" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 @error('fecha') border-red-500 @enderror">
                        @error('fecha')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="hora" class="block text-gray-700 font-bold mb-2">Hora *</label>
                        <input type="time" id="hora" name="hora" value="{{ old('hora') }}" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 @error('hora') border-red-500 @enderror">
                        @error('hora')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <input type="hidden" id="fecha_cita" name="fecha_cita">

                <div class="mb-6">
                    <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción Adicional</label>
                    <textarea id="descripcion" name="descripcion" rows="4" 
                        placeholder="Proporciona más detalles sobre tu consulta (opcional)..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500">{{ old('descripcion') }}</textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 font-bold transition flex-1">
                        ✓ Solicitar Cita
                    </button>
                    <a href="{{ route('dashboard') }}" class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-400 font-bold transition flex-1 text-center">
                        Cancelar
                    </a>
                </div>
            </form>

            <script>
            // Combinar fecha y hora en fecha_cita
            document.querySelector('form').addEventListener('submit', function() {
                const fecha = document.getElementById('fecha').value;
                const hora = document.getElementById('hora').value;
                if (fecha && hora) {
                    document.getElementById('fecha_cita').value = fecha + ' ' + hora + ':00';
                }
            });
            </script>
        @else
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-6 py-4 rounded-lg">
            <p class="mb-4">Debes estar registrado para solicitar una cita.</p>
            <div class="flex gap-4">
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                    Registrarse
                </a>
            </div>
        </div>
        @endif
    </div>

    @include('include.footer')
</body>
</html>

<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Panel Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html { scroll-behavior: smooth; }
        .sr-only { position: absolute; left: -9999px; }
        .sidebar-menu { display: none; }
        @media (max-width: 768px) { .sidebar-menu.is-open { display: flex; } }
    </style>
    <script>
        (function () {
            const saved = localStorage.getItem("theme");
            if (saved === "dark") document.documentElement.classList.add("dark");
        })();
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-700 dark:bg-blue-900 text-white shadow-lg flex flex-col fixed md:relative h-full md:h-auto overflow-y-auto z-40" id="sidebar">
            <div class="p-6 border-b border-blue-600">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-lg bg-white flex items-center justify-center font-bold text-blue-700">PM</div>
                    <div>
                        <h1 class="font-bold text-lg">Percy Mamani</h1>
                        <p class="text-blue-100 text-xs">Admin Panel</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : '' }}">
                    📊 Dashboard
                </a>
                
                <div class="px-4 py-2 text-xs font-bold text-blue-200 uppercase">Contenido</div>
                <a href="{{ route('admin.biografias.edit') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition {{ request()->routeIs('admin.biografias.*') ? 'bg-blue-600' : '' }}">
                    📖 Biografía
                </a>
                <a href="{{ route('admin.trayectorias.index') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition {{ request()->routeIs('admin.trayectorias.*') ? 'bg-blue-600' : '' }}">
                    🏆 Trayectoria
                </a>

                <div class="px-4 py-2 text-xs font-bold text-blue-200 uppercase">Servicios Legales</div>
                <a href="{{ route('admin.actividades.index') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition {{ request()->routeIs('admin.actividades.*') ? 'bg-blue-600' : '' }}">
                    📅 Atenciones y Talleres
                </a>
                <a href="{{ route('admin.noticias.index') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition {{ request()->routeIs('admin.noticias.*') ? 'bg-blue-600' : '' }}">
                    📰 Noticias
                </a>

                <div class="px-4 py-2 text-xs font-bold text-blue-200 uppercase">Gestión de Usuarios</div>
                <a href="{{ route('admin.citas.index') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition {{ request()->routeIs('admin.citas.*') ? 'bg-blue-600' : '' }}">
                    📋 Citas Legales
                </a>
                <a href="{{ route('admin.mensajes.index') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition {{ request()->routeIs('admin.mensajes.*') ? 'bg-blue-600' : '' }}">
                    💬 Mensajes de Contacto
                </a>

                <div class="px-4 py-2 text-xs font-bold text-blue-200 uppercase">Propuestas (Legado)</div>
                <a href="{{ route('admin.propuestas.index') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition {{ request()->routeIs('admin.propuestas.*') ? 'bg-blue-600' : '' }}">
                    💡 Propuestas
                </a>
            </nav>

            <div class="p-4 border-t border-blue-600 space-y-2">
                <button id="themeToggle" class="w-full px-4 py-2 rounded-lg hover:bg-blue-600 transition text-left">
                    🌙 Cambiar Tema
                </button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 rounded-lg hover:bg-red-600 transition text-left">
                        🚪 Cerrar Sesión
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white dark:bg-gray-800 shadow-md p-4 md:p-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">@yield('page-title', 'Panel de Admin')</h2>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">@yield('page-description')</p>
                </div>
                <button id="sidebarToggle" class="md:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto">
                <div class="p-4 md:p-6">
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-200 rounded-lg">
                            <h3 class="font-bold mb-2">Errores:</h3>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <script>
        // Sidebar toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('is-open');
            });
        }

        // Theme toggle
        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const html = document.documentElement;
                const isDark = html.classList.contains('dark');
                if (isDark) {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            });
        }
    </script>
</body>
</html>

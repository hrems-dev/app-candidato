<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Percy Mamani — Asesoría Legal Gratuita</title>
    
    <meta name="description" content="Asesoría legal gratuita de Percy Mamani, abogado. Reserva tu cita legal sin costo. Servicios de consultoría jurídica para la población."/>
    <link rel="icon" href="favicon.png" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html { scroll-behavior: smooth; }
        .sr-only { position: absolute; left: -9999px; }
        .skip-link { position: absolute; left: 1rem; top: -100px; background: #16a34a; color: #fff; padding: 0.5rem 0.75rem; border-radius: 8px; transition: top 0.3s; }
        .skip-link:focus { top: 1rem; }
        .nav__menu { display: none; }
        @media (max-width: 880px) { .nav__menu.is-open { display: flex; } }
        .reveal { opacity: 0; transform: translateY(12px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.is-visible { opacity: 1; transform: none; }
        .list-tick li { margin: 0.35rem 0; color: #64748b; }
        .list-tick li::marker { content: "✔️  "; }
        .gradient-green-red { background: linear-gradient(135deg, #16a34a 0%, #dc2626 100%); }
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0 20px 40px rgba(22, 163, 74, 0.15); }
    </style>
    <script>
        (function () {
            const saved = localStorage.getItem("theme");
            if (saved === "dark") document.documentElement.classList.add("dark");
        })();
    </script>
</head>
<body class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white font-sans m-0">
    <a class="skip-link" href="#contenido">Saltar al contenido</a>

    <!-- HEADER -->
    <header class="sticky top-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-green-200 dark:border-green-800" id="top">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between py-3">
            <a class="flex items-center gap-3" href="#top" aria-label="Inicio">
                <div class="w-10 h-10 rounded-lg gradient-green-red flex items-center justify-center font-bold text-white text-lg">PM</div>
                <div>
                    <span class="font-bold tracking-tight text-green-700 dark:text-green-400 block leading-tight">Percy Mamani</span>
                    <span class="text-xs text-gray-600 dark:text-gray-400">Abogado Asesor Legal</span>
                </div>
            </a>

            <nav class="nav" aria-label="Principal">
                <button class="nav__toggle border border-gray-200 dark:border-gray-700 bg-transparent rounded-xl p-2 cursor-pointer inline-flex md:hidden" id="navToggle" aria-expanded="false" aria-controls="navMenu">
                    <span class="nav__bar block w-[22px] h-[2px] bg-gray-900 dark:bg-white my-1 rounded-sm"></span>
                    <span class="nav__bar block w-[22px] h-[2px] bg-gray-900 dark:bg-white my-1 rounded-sm"></span>
                    <span class="nav__bar block w-[22px] h-[2px] bg-gray-900 dark:bg-white my-1 rounded-sm"></span>
                    <span class="sr-only">Abrir menú</span>
                </button>
                <ul class="nav__menu flex md:flex flex-col md:flex-row gap-2 md:gap-4 items-center absolute md:static top-16 right-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-3 md:p-0 shadow-lg md:shadow-none min-w-[240px]" id="navMenu">
                    <li><a class="p-2 rounded-lg hover:bg-green-100/50 dark:hover:bg-green-900/40 block transition-colors font-medium" href="#biografia">Biografía</a></li>
                    <li><a class="p-2 rounded-lg hover:bg-green-100/50 dark:hover:bg-green-900/40 block transition-colors font-medium" href="#servicios">Servicios</a></li>
                    <li><a class="p-2 rounded-lg hover:bg-green-100/50 dark:hover:bg-green-900/40 block transition-colors font-medium" href="#atenciones">Atenciones</a></li>
                    <li><a class="p-2 rounded-lg hover:bg-green-100/50 dark:hover:bg-green-900/40 block transition-colors font-medium" href="#contacto">Contacto</a></li>
                    <li>
                        <button id="themeToggle" class="border border-gray-200 dark:border-gray-700 bg-transparent rounded-xl p-2 cursor-pointer hover:bg-green-100/50 dark:hover:bg-green-900/40 transition-colors" aria-label="Cambiar tema">
                            <svg viewBox="0 0 24 24" class="w-5 h-5 fill-current">
                                <path d="M21.64 13a9 9 0 01-11.31-11.31A1 1 0 008.9.05 11 11 0 1023.95 15.1 1 1 0 0021.64 13z" />
                            </svg>
                        </button>
                    </li>
                    <li class="border-t md:border-t-0 md:border-l border-gray-200 dark:border-gray-700 pt-2 md:pt-0 md:pl-4 mt-2 md:mt-0 w-full md:w-auto flex gap-2 md:flex-col lg:flex-row">
                        @auth
                            <a href="{{ route('dashboard') }}" class="flex-1 md:flex-none px-4 py-2 rounded-lg text-center gradient-green-red text-white font-semibold transition-colors hover:shadow-lg">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="flex-1 md:flex-none">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 font-semibold transition-colors">
                                    Salir
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="flex-1 md:flex-none px-4 py-2 rounded-lg text-center border-2 border-green-600 text-green-600 hover:bg-green-50 dark:hover:bg-green-900/20 font-semibold transition-colors">
                                Ingresar
                            </a>
                            <a href="{{ route('register') }}" class="flex-1 md:flex-none px-4 py-2 rounded-lg text-center bg-green-600 hover:bg-green-700 text-white font-semibold transition-colors">
                                Registrarse
                            </a>
                        @endauth
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="relative overflow-hidden py-20 lg:py-28" aria-labelledby="heroTitle">
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-green-500 rounded-full mix-blend-multiply filter blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-red-500 rounded-full mix-blend-multiply filter blur-3xl"></div>
        </div>
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-[1.2fr_0.8fr] gap-12 items-center" id="contenido">
            <div>
                <div class="inline-block mb-4 px-4 py-2 bg-green-100 dark:bg-green-900/40 rounded-full">
                    <span class="text-green-700 dark:text-green-300 font-semibold text-sm">✨ Justicia para todos</span>
                </div>
                <h1 id="heroTitle" class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mt-0 mb-6 text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-red-600">
                    Asesoría Legal Gratuita
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                    Soy <strong>Percy Mamani</strong>, abogado litigante con <strong>15+ años de experiencia</strong>. Brindo <strong>consultoría legal gratuita</strong> a la población que lo necesita. Mi compromiso es garantizar el acceso a la justicia para todos.
                </p>
                <div class="flex gap-4 flex-wrap mb-8">
                    <a href="#contacto" class="px-8 py-3 font-bold rounded-lg inline-flex items-center justify-center gradient-green-red text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                        📋 Reservar Cita Legal
                    </a>
                    <a href="#biografia" class="px-8 py-3 font-bold rounded-lg inline-flex items-center justify-center border-2 border-green-600 text-green-600 dark:text-green-400 dark:border-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 transition-all">
                        👤 Conocer Mi Perfil
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4">
                        <span class="text-3xl font-extrabold text-green-700 dark:text-green-400">15+</span>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium mt-1">Años de experiencia</p>
                    </div>
                    <div class="bg-red-50 dark:bg-red-900/20 rounded-lg p-4">
                        <span class="text-3xl font-extrabold text-red-700 dark:text-red-400">500+</span>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium mt-1">Casos resueltos</p>
                    </div>
                </div>
            </div>
            <div class="relative mt-8 lg:mt-0">
                <div class="absolute -inset-6 gradient-green-red rounded-2xl opacity-20 blur-2xl"></div>
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&h=600&fit=crop" alt="Percy Mamani - Abogado Asesor Legal" class="relative rounded-2xl border-4 border-green-200 dark:border-green-800 shadow-2xl w-full h-auto"/>
                <div class="absolute -right-4 -bottom-4 gradient-green-red text-white px-4 py-2 rounded-full font-extrabold shadow-lg">
                    ⚖️ 2025
                </div>
            </div>
        </div>
    </section>

    <!-- BIOGRAFÍA SECTION -->
    <section id="biografia" class="py-20 lg:py-28 bg-gradient-to-b from-gray-50 to-white dark:from-gray-800 dark:to-gray-900" aria-labelledby="bioTitle">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 id="bioTitle" class="text-4xl sm:text-5xl font-extrabold mb-4 mt-0 text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-red-600">Acerca de mí</h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-lg">Profesional del derecho con compromiso social hacia la población vulnerable</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 border-2 border-green-200 dark:border-green-800 rounded-2xl p-8 shadow-lg hover-lift">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-green-600 to-red-600 flex items-center justify-center text-2xl font-bold text-white">
                                PM
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Percy Mamani López</h3>
                                <p class="text-green-600 dark:text-green-400 font-semibold">Abogado Litigante | Asesor Legal Gratuito</p>
                            </div>
                        </div>
                        <div class="space-y-4 mb-6">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                Abogado litigante con <strong>especialización en derecho civil, penal y laboral</strong>. Más de 15 años de experiencia defendiendo los derechos de ciudadanos de todos los estratos sociales. Mi práctica profesional se ha enfocado en brindar soluciones legales accesibles a la población que enfrenta dificultades económicas.
                            </p>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                Entiendo que <strong>el acceso a la justicia es un derecho fundamental</strong>. Por ello, he dedicado gran parte de mi carrera a ofrecer asesoría legal gratuita a personas de escasos recursos, garantizando que la falta de dinero no sea un obstáculo para recibir defensa jurídica de calidad.
                            </p>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/20 border-l-4 border-green-600 p-4 rounded">
                            <h4 class="font-bold text-green-900 dark:text-green-100 mb-2">💚 Mi Compromiso:</h4>
                            <p class="text-green-800 dark:text-green-200 italic">"Garantizar que cada persona tenga acceso a asesoría legal profesional, sin importar su situación económica. La justicia no debe ser un privilegio, sino un derecho."</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-2xl font-bold mb-8 text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-red-600">Especialidades</h3>
                    <div class="space-y-6">
                        <div class="bg-white dark:bg-gray-800 border-2 border-green-200 dark:border-green-800 rounded-lg p-6 hover-lift">
                            <div class="inline-block mb-3 px-3 py-1 bg-green-100 dark:bg-green-900/40 rounded-full">
                                <span class="font-bold text-sm text-green-700 dark:text-green-300">Derecho Civil</span>
                            </div>
                            <p class="font-semibold text-gray-900 dark:text-white">Contratos y Disputas Civiles</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Asesoría en contratos, sucesiones y divorcios</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 border-2 border-red-200 dark:border-red-800 rounded-lg p-6 hover-lift">
                            <div class="inline-block mb-3 px-3 py-1 bg-red-100 dark:bg-red-900/40 rounded-full">
                                <span class="font-bold text-sm text-red-700 dark:text-red-300">Derecho Penal</span>
                            </div>
                            <p class="font-semibold text-gray-900 dark:text-white">Defensa en Procesos Penales</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Representación legal en casos penales</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 border-2 border-yellow-200 dark:border-yellow-800 rounded-lg p-6 hover-lift">
                            <div class="inline-block mb-3 px-3 py-1 bg-yellow-100 dark:bg-yellow-900/40 rounded-full">
                                <span class="font-bold text-sm text-yellow-700 dark:text-yellow-300">Derecho Laboral</span>
                            </div>
                            <p class="font-semibold text-gray-900 dark:text-white">Defensa de Derechos Laborales</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Asesoría en conflictos laborales y despidos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICIOS SECTION -->
    <section id="servicios" class="py-20 lg:py-28 bg-white dark:bg-gray-900" aria-labelledby="serviciosTitle">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 id="serviciosTitle" class="text-4xl sm:text-5xl font-extrabold mb-4 mt-0 text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-red-600">Servicios de Asesoría Legal</h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-lg">Consultoría legal gratuita sin compromiso. Respuestas profesionales a tus dudas jurídicas.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <article class="reveal bg-gradient-to-br from-green-50 to-white dark:from-green-900/20 dark:to-gray-800 border-2 border-green-200 dark:border-green-800 rounded-2xl p-8 shadow-lg hover-lift">
                    <div class="text-6xl mb-4">⚖️</div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900 dark:text-white">Consultas Legales</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-6 leading-relaxed">Asesoría profesional sin costo sobre tus dudas y problemas legales.</p>
                    <ul class="space-y-2 list-none">
                        <li class="flex items-start gap-3">
                            <span class="text-green-600 font-bold mt-1">✓</span>
                            <span class="text-gray-700 dark:text-gray-300">Consulta inicial sin cargo</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-green-600 font-bold mt-1">✓</span>
                            <span class="text-gray-700 dark:text-gray-300">Análisis detallado de tu caso</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-green-600 font-bold mt-1">✓</span>
                            <span class="text-gray-700 dark:text-gray-300">Opciones legales disponibles</span>
                        </li>
                    </ul>
                </article>

                <article class="reveal bg-gradient-to-br from-red-50 to-white dark:from-red-900/20 dark:to-gray-800 border-2 border-red-200 dark:border-red-800 rounded-2xl p-8 shadow-lg hover-lift">
                    <div class="text-6xl mb-4">📋</div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900 dark:text-white">Representación Legal</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-6 leading-relaxed">Defensa profesional en procesos civiles, penales y laborales.</p>
                    <ul class="space-y-2 list-none">
                        <li class="flex items-start gap-3">
                            <span class="text-red-600 font-bold mt-1">✓</span>
                            <span class="text-gray-700 dark:text-gray-300">Defensa en juzgados</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-red-600 font-bold mt-1">✓</span>
                            <span class="text-gray-700 dark:text-gray-300">Mediación y conciliación</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-red-600 font-bold mt-1">✓</span>
                            <span class="text-gray-700 dark:text-gray-300">Seguimiento del caso</span>
                        </li>
                    </ul>
                </article>

                <article class="reveal bg-gradient-to-br from-yellow-50 to-white dark:from-yellow-900/20 dark:to-gray-800 border-2 border-yellow-200 dark:border-yellow-800 rounded-2xl p-8 shadow-lg hover-lift">
                    <div class="text-6xl mb-4">📄</div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900 dark:text-white">Asesoría Documentaria</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-6 leading-relaxed">Elaboración y revisión de documentos legales sin costo.</p>
                    <ul class="space-y-2 list-none">
                        <li class="flex items-start gap-3">
                            <span class="text-yellow-600 font-bold mt-1">✓</span>
                            <span class="text-gray-700 dark:text-gray-300">Redacción de contratos</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-yellow-600 font-bold mt-1">✓</span>
                            <span class="text-gray-700 dark:text-gray-300">Documentos legales</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-yellow-600 font-bold mt-1">✓</span>
                            <span class="text-gray-700 dark:text-gray-300">Revisión de documentos</span>
                        </li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <!-- ATENCIONES SECTION -->
    <section id="atenciones" class="py-20 lg:py-28 bg-gradient-to-b from-gray-50 to-white dark:from-gray-800 dark:to-gray-900" aria-labelledby="atencionesTitle">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 id="atencionesTitle" class="text-4xl sm:text-5xl font-extrabold mb-4 mt-0 text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-red-600">Atenciones y Talleres</h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-lg">Participa en nuestras actividades de asesoría y talleres educativos gratuitos</p>
            </div>

            <div class="space-y-6">
                <div class="reveal bg-white dark:bg-gray-800 border-l-4 border-green-600 rounded-xl p-8 shadow-lg hover-lift">
                    <div class="flex items-start gap-6">
                        <div class="bg-green-100 dark:bg-green-900/40 rounded-lg px-4 py-3 text-center min-w-[100px]">
                            <p class="text-2xl font-extrabold text-green-700 dark:text-green-300">25</p>
                            <p class="text-sm font-semibold text-green-600 dark:text-green-400">Nov 2025</p>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">🎓 Taller: Derechos Laborales</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-2 font-medium">Centro Comunitario - 10:00 AM</p>
                            <p class="text-gray-700 dark:text-gray-300">Aprende sobre tus derechos como trabajador, despidos injustificados, beneficios sociales y cómo defenderte.</p>
                        </div>
                    </div>
                </div>

                <div class="reveal bg-white dark:bg-gray-800 border-l-4 border-red-600 rounded-xl p-8 shadow-lg hover-lift">
                    <div class="flex items-start gap-6">
                        <div class="bg-red-100 dark:bg-red-900/40 rounded-lg px-4 py-3 text-center min-w-[100px]">
                            <p class="text-2xl font-extrabold text-red-700 dark:text-red-300">02</p>
                            <p class="text-sm font-semibold text-red-600 dark:text-red-400">Dic 2025</p>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">👥 Jornada de Atención Gratuita</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-2 font-medium">Oficina Central - 9:00 AM a 5:00 PM</p>
                            <p class="text-gray-700 dark:text-gray-300">Día de atención intensiva. Lleva tu cédula y un resumen de tu caso. ¡No hay límite de consultas!</p>
                        </div>
                    </div>
                </div>

                <div class="reveal bg-white dark:bg-gray-800 border-l-4 border-yellow-600 rounded-xl p-8 shadow-lg hover-lift">
                    <div class="flex items-start gap-6">
                        <div class="bg-yellow-100 dark:bg-yellow-900/40 rounded-lg px-4 py-3 text-center min-w-[100px]">
                            <p class="text-2xl font-extrabold text-yellow-700 dark:text-yellow-300">09</p>
                            <p class="text-sm font-semibold text-yellow-600 dark:text-yellow-400">Dic 2025</p>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">👨‍👩‍👧 Taller: Derecho de Familia</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-2 font-medium">Salón Multiusos - 3:00 PM</p>
                            <p class="text-gray-700 dark:text-gray-300">Custodia de menores, pensión alimenticia, sucesiones y otros asuntos de familia.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIOS SECTION -->
    <section id="testimonios" class="py-20 lg:py-28 bg-white dark:bg-gray-900" aria-labelledby="testimonioTitle">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 id="testimonioTitle" class="text-4xl sm:text-5xl font-extrabold mb-4 mt-0 text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-red-600">Casos de Éxito</h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-lg">Lo que dicen nuestros clientes sobre nuestro servicio</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <figure class="reveal bg-white dark:bg-gray-800 border-2 border-green-200 dark:border-green-800 rounded-2xl p-8 shadow-lg hover-lift">
                    <div class="flex gap-1 mb-4">
                        <span class="text-yellow-400">⭐</span>
                        <span class="text-yellow-400">⭐</span>
                        <span class="text-yellow-400">⭐</span>
                        <span class="text-yellow-400">⭐</span>
                        <span class="text-yellow-400">⭐</span>
                    </div>
                    <blockquote class="m-0 mb-4 font-semibold leading-relaxed text-lg text-gray-900 dark:text-white">"Percy me ayudó a recuperar mi pensión alimenticia. Sin su asesoría gratuita no hubiera podido hacerlo. Es un verdadero abogado de pueblo."</blockquote>
                    <figcaption class="text-gray-600 dark:text-gray-400">
                        <strong>María González</strong><br>
                        <span class="text-sm">Madre de Familia</span>
                    </figcaption>
                </figure>

                <figure class="reveal bg-white dark:bg-gray-800 border-2 border-red-200 dark:border-red-800 rounded-2xl p-8 shadow-lg hover-lift">
                    <div class="flex gap-1 mb-4">
                        <span class="text-yellow-400">⭐</span>
                        <span class="text-yellow-400">⭐</span>
                        <span class="text-yellow-400">⭐</span>
                        <span class="text-yellow-400">⭐</span>
                        <span class="text-yellow-400">⭐</span>
                    </div>
                    <blockquote class="m-0 mb-4 font-semibold leading-relaxed text-lg text-gray-900 dark:text-white">"Fue despedido injustificadamente. Percy ganó mi caso sin cobrarme nada. Le debo mucho a su dedicación."</blockquote>
                    <figcaption class="text-gray-600 dark:text-gray-400">
                        <strong>Juan Pérez</strong><br>
                        <span class="text-sm">Trabajador Metalúrgico</span>
                    </figcaption>
                </figure>

                <figure class="reveal bg-white dark:bg-gray-800 border-2 border-yellow-200 dark:border-yellow-800 rounded-2xl p-8 shadow-lg hover-lift">
                    <div class="flex gap-1 mb-4">
                        <span class="text-yellow-400">⭐</span>
                        <span class="text-yellow-400">⭐</span>
                        <span class="text-yellow-400">⭐</span>
                        <span class="text-yellow-400">⭐</span>
                        <span class="text-yellow-400">⭐</span>
                    </div>
                    <blockquote class="m-0 mb-4 font-semibold leading-relaxed text-lg text-gray-900 dark:text-white">"Su asesoría me salvó de un contrato fraudulento. Recomiendo sus servicios a todos mis vecinos."</blockquote>
                    <figcaption class="text-gray-600 dark:text-gray-400">
                        <strong>Carlos López</strong><br>
                        <span class="text-sm">Vendedor Ambulante</span>
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="py-16 lg:py-20 bg-gradient-to-r from-green-600/5 to-red-600/5 dark:from-green-900/20 dark:to-red-900/20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl lg:text-4xl font-extrabold mb-4 mt-0 text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-red-600">Acceso a la Justicia es un Derecho</h2>
            <p class="text-gray-700 dark:text-gray-300 text-lg mb-8 leading-relaxed max-w-2xl mx-auto">
                No importa tu situación económica, tienes derecho a asesoría legal profesional. Reserva tu cita gratuita con Percy Mamani hoy mismo.
            </p>
            <div class="flex gap-4 justify-center flex-wrap">
                <a href="#contacto" class="px-8 py-4 font-bold rounded-lg inline-flex items-center justify-center gradient-green-red text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                    📋 Reservar Cita Legal
                </a>
                <a href="#biografia" class="px-8 py-4 font-bold rounded-lg inline-flex items-center justify-center border-2 border-green-600 text-green-600 dark:text-green-400 dark:border-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 transition-all">
                    Saber más
                </a>
            </div>
        </div>
    </section>

    <!-- CONTACTO SECTION -->
    <section id="contacto" class="py-20 lg:py-28 bg-white dark:bg-gray-900" aria-labelledby="contactoTitle">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 id="contactoTitle" class="text-4xl sm:text-5xl font-extrabold mb-4 mt-0 text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-red-600">Contacto y Propuestas</h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-lg">¿Tienes una propuesta o quieres organizar una reunión? Déjanos tu mensaje.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Formulario -->
                <div class="lg:col-span-2">
                    <form method="POST" action="{{ route('contacto.store') }}" class="bg-white dark:bg-gray-800 border-2 border-green-200 dark:border-green-800 rounded-2xl p-8 shadow-lg">
                        @csrf
                        
                        <div class="mb-6">
                            <label for="nombre" class="block font-bold text-gray-900 dark:text-white mb-2">Nombre Completo *</label>
                            <input type="text" id="nombre" name="nombre" required placeholder="Tu nombre y apellido" class="w-full bg-transparent text-gray-900 dark:text-white border-2 border-gray-300 dark:border-gray-600 rounded-xl p-4 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition" />
                            @error('nombre')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-6">
                            <label for="email" class="block font-bold text-gray-900 dark:text-white mb-2">Correo Electrónico *</label>
                            <input type="email" id="email" name="email" required placeholder="tucorreo@ejemplo.com" class="w-full bg-transparent text-gray-900 dark:text-white border-2 border-gray-300 dark:border-gray-600 rounded-xl p-4 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition" />
                            @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-6">
                            <label for="telefono" class="block font-bold text-gray-900 dark:text-white mb-2">Teléfono (Opcional)</label>
                            <input type="tel" id="telefono" name="telefono" placeholder="+51 999 999 999" class="w-full bg-transparent text-gray-900 dark:text-white border-2 border-gray-300 dark:border-gray-600 rounded-xl p-4 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition" />
                        </div>

                        <div class="mb-6">
                            <label for="asunto" class="block font-bold text-gray-900 dark:text-white mb-2">Asunto *</label>
                            <select id="asunto" name="asunto" required class="w-full bg-transparent text-gray-900 dark:text-white border-2 border-gray-300 dark:border-gray-600 rounded-xl p-4 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition">
                                <option value="">Selecciona un tema</option>
                                <option value="propuesta">Tengo una propuesta</option>
                                <option value="reunion">Quiero organizar una reunión</option>
                                <option value="voluntario">Quiero ser voluntario</option>
                                <option value="consulta">Tengo una consulta</option>
                                <option value="otro">Otro</option>
                            </select>
                            @error('asunto')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-6">
                            <label for="mensaje" class="block font-bold text-gray-900 dark:text-white mb-2">Mensaje *</label>
                            <textarea id="mensaje" name="mensaje" rows="6" required placeholder="Cuéntanos en detalle tu propuesta, ideas o consultas..." class="w-full bg-transparent text-gray-900 dark:text-white border-2 border-gray-300 dark:border-gray-600 rounded-xl p-4 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition resize-none"></textarea>
                            @error('mensaje')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" id="voluntario" name="voluntario" class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-green-600 focus:ring-green-500" />
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Me interesa participar como voluntario</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full px-6 py-4 font-bold rounded-lg inline-flex items-center justify-center gradient-green-red text-white shadow-lg hover:shadow-xl transition-all">
                            📤 Enviar Mensaje
                        </button>

                        @if (session('status'))
                            <div class="mt-4 p-4 bg-green-100 dark:bg-green-900 border-2 border-green-300 dark:border-green-700 rounded-xl text-green-800 dark:text-green-100 font-semibold">
                                ✓ {{ session('status') }}
                            </div>
                        @endif
                    </form>
                </div>

                <!-- Info Box -->
                <div class="bg-white dark:bg-gray-800 border-2 border-red-200 dark:border-red-800 rounded-2xl p-8 shadow-lg h-fit">
                    <h3 class="text-2xl font-bold mb-8 text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-red-600">Datos de Contacto</h3>
                    
                    <div class="space-y-6">
                        <div class="pb-6 border-b border-gray-200 dark:border-gray-700">
                            <h4 class="font-bold text-green-600 dark:text-green-400 mb-2 text-lg">📧 Email</h4>
                            <a href="mailto:percy@abogado.com" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 font-semibold break-all">percy@abogado.com</a>
                        </div>

                        <div class="pb-6 border-b border-gray-200 dark:border-gray-700">
                            <h4 class="font-bold text-red-600 dark:text-red-400 mb-2 text-lg">📱 Teléfono</h4>
                            <a href="tel:+51999123456" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 font-semibold">+51 999 123 456</a>
                        </div>

                        <div class="pb-6 border-b border-gray-200 dark:border-gray-700">
                            <h4 class="font-bold text-yellow-600 dark:text-yellow-400 mb-2 text-lg">📍 Ubicación</h4>
                            <p class="text-gray-700 dark:text-gray-300 font-medium">Lima, Perú<br/>Oficina Central</p>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-4 text-lg">🤝 Sígueme</h4>
                            <div class="flex gap-3">
                                <a href="#" class="inline-flex items-center justify-center w-12 h-12 border-2 border-gray-300 dark:border-gray-600 rounded-lg hover:border-green-600 dark:hover:border-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 transition">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M22 12a10 10 0 10-11.5 9.9v-7H7.9V12h2.6V9.7c0-2.6 1.6-4 3.9-4 1.1 0 2.3.2 2.3.2v2.5h-1.3c-1.3 0-1.7.8-1.7 1.6V12h3l-.5 2.9h-2.5v7A10 10 0 0022 12" /></svg>
                                </a>
                                <a href="#" class="inline-flex items-center justify-center w-12 h-12 border-2 border-gray-300 dark:border-gray-600 rounded-lg hover:border-red-600 dark:hover:border-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M18 2h3l-7.5 8.6L22 22h-6l-4.6-6L6 22H3l8.2-9.4L2 2h6l4.2 5.7L18 2z" /></svg>
                                </a>
                                <a href="#" class="inline-flex items-center justify-center w-12 h-12 border-2 border-gray-300 dark:border-gray-600 rounded-lg hover:border-green-600 dark:hover:border-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 transition">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z" /></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="border-t-2 border-green-200 dark:border-green-800 py-12 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg gradient-green-red flex items-center justify-center font-bold text-white">PM</div>
                        <div>
                            <strong class="font-bold text-lg text-green-700 dark:text-green-400">Percy Mamani</strong>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Abogado Asesor Legal</p>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Brindando asesoría legal gratuita a la población que lo necesita.</p>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4">Enlaces Rápidos</h3>
                    <ul class="space-y-2 list-none">
                        <li><a href="#biografia" class="text-gray-600 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400">Biografía</a></li>
                        <li><a href="#servicios" class="text-gray-600 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400">Servicios</a></li>
                        <li><a href="#atenciones" class="text-gray-600 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400">Atenciones</a></li>
                        <li><a href="#contacto" class="text-gray-600 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4">Contacto</h3>
                    <ul class="space-y-2 list-none text-sm">
                        <li><a href="mailto:percy@abogado.com" class="text-gray-600 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400">percy@abogado.com</a></li>
                        <li><a href="tel:+51999123456" class="text-gray-600 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400">+51 999 123 456</a></li>
                        <li><span class="text-gray-600 dark:text-gray-400">Lima, Perú</span></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-300 dark:border-gray-700 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-gray-600 dark:text-gray-400 text-sm">© 2025 Percy Mamani. Asesoría Legal Gratuita. Todos los derechos reservados.</p>
                <a href="#top" class="px-6 py-2 font-bold rounded-lg border-2 border-green-600 text-green-600 dark:text-green-400 dark:border-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 transition">
                    ↑ Volver arriba
                </a>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('navToggle').addEventListener('click', function() {
            const menu = document.getElementById('navMenu');
            this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'false' ? 'true' : 'false');
            menu.classList.toggle('is-open');
        });

        document.getElementById('themeToggle').addEventListener('click', function() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
</body>
</html>

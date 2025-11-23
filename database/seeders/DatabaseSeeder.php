<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Biografia;
use App\Models\Trayectoria;
use App\Models\Actividad;
use App\Models\Noticia;
use App\Models\Propuesta;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario administrador
        User::create([
            'name' => 'Hugo Raúl - Admin',
            'email' => 'admin@hugoraul.com',
            'phone' => '+51 999 123 456',
            'password' => bcrypt('admin123456'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Crear usuario ciudadano de prueba
        User::create([
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'phone' => '+51 987 654 321',
            'password' => bcrypt('user123456'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Crear biografía
        Biografia::create([
            'contenido' => 'Hugo Raúl es un abogado y político peruano con más de 20 años de experiencia en la defensa de los derechos ciudadanos. Fundador del movimiento político "Juntos por el Perú", ha dedicado su carrera a la promoción de políticas sociales inclusivas y desarrollo económico sostenible.',
            'imagen' => null,
        ]);

        // Crear trayectoria
        Trayectoria::create([
            'titulo' => 'Abogado Constitucionalista',
            'descripcion' => 'Especialista en derecho constitucional y derechos humanos. Ha defendido exitosamente casos de interés público ante la Corte Suprema.',
            'cargo' => 'Abogado Constitucionalista',
            'institucion' => 'Estudio Jurídico Raúl & Asociados',
            'fecha_inicio' => \Carbon\Carbon::createFromFormat('Y-m-d', '2000-01-01'),
            'fecha_fin' => \Carbon\Carbon::createFromFormat('Y-m-d', '2010-01-01'),
        ]);
        Trayectoria::create([
            'titulo' => 'Director de Derechos Humanos',
            'descripcion' => 'Fue director de la Defensoría Regional durante 8 años, implementando programas de protección de derechos ciudadanos.',
            'cargo' => 'Director de Derechos Humanos',
            'institucion' => 'Defensoría Regional',
            'fecha_inicio' => \Carbon\Carbon::createFromFormat('Y-m-d', '2010-01-01'),
            'fecha_fin' => \Carbon\Carbon::createFromFormat('Y-m-d', '2018-01-01'),
        ]);
        Trayectoria::create([
            'titulo' => 'Congresista de la República',
            'descripcion' => 'Representante del distrito durante dos periodos legislativos. Promovió leyes sobre transparencia y descentralización.',
            'cargo' => 'Congresista',
            'institucion' => 'Congreso del Perú',
            'fecha_inicio' => \Carbon\Carbon::createFromFormat('Y-m-d', '2018-01-01'),
            'fecha_fin' => null,
        ]);

        // Crear actividades
        Actividad::create([
            'titulo' => 'Reunión con empresarios del sector agrícola',
            'descripcion' => 'Discusión sobre políticas de apoyo al sector agrícola y cómo podemos mejorar la exportación de productos peruanos.',
            'fecha' => now()->addDays(5)->setHour(10)->setMinute(30),
            'ubicacion' => 'Lima - Centro de Convenciones',
        ]);
        Actividad::create([
            'titulo' => 'Caravana electoral por el sur peruano',
            'descripcion' => 'Visitaremos Arequipa, Tacna y Moquegua para dialogar directamente con los ciudadanos sobre nuestras propuestas.',
            'fecha' => now()->addDays(15)->setHour(8)->setMinute(0),
            'ubicacion' => 'Arequipa - Plaza de Armas',
        ]);
        Actividad::create([
            'titulo' => 'Foro: Educación y Tecnología',
            'descripcion' => 'Conversatorio con educadores sobre cómo integrar tecnología en las escuelas rurales del Perú.',
            'fecha' => now()->addDays(10)->setHour(14)->setMinute(30),
            'ubicacion' => 'Cusco - Universidad Nacional',
        ]);

        // Crear noticias
        Noticia::create([
            'titulo' => 'Hugo Raúl presenta plan de empleo para jóvenes',
            'contenido' => 'El candidato presentó hoy un programa integral de generación de empleo dirigido específicamente a jóvenes peruanos de 18 a 30 años, con énfasis en sectores tecnológicos y turismo sostenible. El programa busca crear 100,000 nuevos empleos en los próximos años.',
            'fecha_publicacion' => now()->subDays(2),
            'publicado' => true,
            'imagen' => null,
        ]);
        Noticia::create([
            'titulo' => 'Compromiso por la educación en zonas rurales',
            'contenido' => 'Durante su gira por el sur del país, Hugo Raúl reafirmó su compromiso de mejorar la educación en zonas rurales, con inversión en infraestructura y capacitación de docentes. "La educación es la base del desarrollo sostenible", expresó.',
            'fecha_publicacion' => now()->subDays(5),
            'publicado' => true,
            'imagen' => null,
        ]);
        Noticia::create([
            'titulo' => 'Propuesta de reforma tributaria progresiva',
            'contenido' => 'El equipo económico de Hugo Raúl presentó una propuesta de reforma tributaria que busca aumentar la recaudación mediante impuestos progresivos a grandes fortunas, manteniendo cargas bajas para pequeñas y medianas empresas.',
            'fecha_publicacion' => now()->subDays(8),
            'publicado' => true,
            'imagen' => null,
        ]);

        // Crear propuestas
        Propuesta::create([
            'titulo' => '100,000 Empleos para Jóvenes',
            'descripcion' => 'Programa de generación de empleo para jóvenes de 18 a 30 años. Enfoque en sectores tecnológicos, turismo y agricultura con capacitación integral y acceso a microcréditos.',
            'categoria' => 'Empleo',
            'publicado' => true,
        ]);
        Propuesta::create([
            'titulo' => 'Descentralización Efectiva',
            'descripcion' => 'Transferencia de recursos y competencias a gobiernos regionales y locales. Mayor autonomía en decisiones de inversión pública con transparencia y rendición de cuentas.',
            'categoria' => 'Política',
            'publicado' => true,
        ]);
        Propuesta::create([
            'titulo' => 'Salud Universal para Todos',
            'descripcion' => 'Sistema de salud integrado que garantice cobertura universal gratuita. Énfasis en medicina preventiva y atención en zonas rurales mediante telemedicina.',
            'categoria' => 'Salud',
            'publicado' => true,
        ]);
        Propuesta::create([
            'titulo' => 'Educación de Calidad Integral',
            'descripcion' => 'Inversión en educación con énfasis en STEM, artes y educación financiera. Capacitación docente continua y modernización de infraestructura educativa.',
            'categoria' => 'Educación',
            'publicado' => true,
        ]);
        Propuesta::create([
            'titulo' => 'Agricultura Sostenible y Exportación',
            'descripcion' => 'Apoyo a pequeños agricultores con tecnología moderna, acceso a mercados internacionales y precios justos. Protección del medio ambiente y biodiversidad.',
            'categoria' => 'Agricultura',
            'publicado' => true,
        ]);
    }
}


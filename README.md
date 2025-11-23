# 🇵🇪 PÁGINA WEB DE HUGO RAÚL - JUNTOS POR EL PERÚ

**Aplicación Web Completa en Laravel 11 | Sistema de Gestión Política y Citas Legales**

---

## 📋 DESCRIPCIÓN DEL PROYECTO

Sistema web completo para una página política que incluye:

-   🏠 **Página Pública:** Biografía, trayectoria, propuestas, actividades, noticias
-   👤 **Sistema de Usuarios:** Registro, autenticación, solicitud de citas legales
-   🔐 **Panel Administrativo:** Gestión de contenido, citas, mensajes
-   📧 **Formulario de Contacto:** Ciudadanos pueden escribir consultas
-   ⚖️ **Sistema de Citas Legales:** Solicitud, aprobación/rechazo por admin
-   📊 **Dashboard:** Estadísticas y panel de control

**Tecnología:** Laravel 11 | MySQL | Blade | Tailwind CSS | Vite

---

## 🎯 CARACTERÍSTICAS PRINCIPALES

### Para Ciudadanos

✅ Ver biografía, trayectoria y propuestas del candidato  
✅ Registrarse y crear cuenta  
✅ Solicitar citas legales (requiere verificación de email)  
✅ Consultar estado de sus solicitudes  
✅ Enviar mensajes de contacto  
✅ Ver actividades y noticias publicadas

### Para Administrador

✅ Editar biografía del candidato  
✅ Gestionar trayectoria (CRUD)  
✅ Publicar noticias (con control de publicación)  
✅ Crear actividades y eventos  
✅ Crear propuestas políticas  
✅ Aprobar/rechazar solicitudes de citas  
✅ Ver y responder mensajes de contacto  
✅ Dashboard con estadísticas en tiempo real

---

## 📊 ESTRUCTURA DE BASE DE DATOS

| Tabla               | Registros | Propósito                                 |
| ------------------- | --------- | ----------------------------------------- |
| `users`             | N         | Cuentas de usuarios (admins + ciudadanos) |
| `biografias`        | 1         | Información del candidato                 |
| `trayectorias`      | N         | Experiencia profesional                   |
| `actividades`       | N         | Eventos públicos                          |
| `noticias`          | N         | Artículos y comunicados                   |
| `propuestas`        | N         | Propuestas políticas                      |
| `citas`             | N         | Solicitudes de citas legales              |
| `mensajes_contacto` | N         | Mensajes de ciudadanos                    |

**Relaciones:** Users 1:N Citas  
**Total:** 8 tablas con 50+ campos

Ver: [`DIAGRAMA_ER.md`](DIAGRAMA_ER.md) para detalles completos

---

## 🛠️ INSTALACIÓN RÁPIDA

### Requisitos

-   PHP 8.2+
-   MySQL 8.0+
-   Composer 2.0+
-   Node.js 18+

### Pasos

```powershell
# 1. Clonar repositorio
git clone https://github.com/tuusuario/app-candidato.git
cd app-candidato

# 2. Instalar dependencias PHP
composer install

# 3. Configurar archivo .env
copy .env.example .env
# Editar: DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 4. Generar clave
php artisan key:generate

# 5. Crear base de datos
# CREATE DATABASE app_candidato; (en MySQL)

# 6. Ejecutar migraciones y seeders
php artisan migrate:seed

# 7. Crear enlace simbólico para almacenamiento
php artisan storage:link

# 8. Instalar assets frontend
npm install
npm run build

# 9. Iniciar servidor
php artisan serve
```

**URL Local:** http://localhost:8000

Ver [`INSTALACION.md`](INSTALACION.md) para guía paso-a-paso completa

---

## 👤 CUENTAS DE PRUEBA

Creadas automáticamente por seeders:

### Administrador

```
Email:    admin@hugoraul.com
Password: admin123456
Rol:      Admin
```

### Usuario Regular

```
Email:    juan@example.com
Password: user123456
Rol:      Usuario
```

---

## 🗂️ ESTRUCTURA DE CARPETAS

```
app-candidato/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # 8 controladores
│   │   ├── Middleware/           # AdminMiddleware
│   │   └── Requests/             # Validaciones
│   └── Models/                   # 7 modelos Eloquent
├── database/
│   ├── migrations/               # 8 migraciones
│   └── seeders/                  # DatabaseSeeder
├── resources/
│   ├── views/                    # 26+ vistas Blade
│   ├── css/                      # Tailwind CSS
│   └── js/                       # JavaScript
├── routes/
│   └── web.php                   # 31 rutas definidas
├── storage/
│   └── app/public/               # Imágenes subidas
└── public/
    └── storage/                  # Symlink a imágenes
```

---

## 🛣️ RUTAS PRINCIPALES

### Públicas (Sin autenticación)

```
GET  /                      Página de inicio
GET  /biografia             Biografía del candidato
GET  /trayectoria           Experiencia profesional
GET  /propuestas            Propuestas políticas
GET  /actividades           Eventos públicos
GET  /noticias              Noticias publicadas
GET  /contacto              Formulario de contacto
GET  /citas                 Solicitar cita (requiere login)
```

### Autenticadas (Con login)

```
GET  /dashboard             Panel del usuario
GET  /mis-citas             Mis solicitudes de cita
GET  /settings/*            Configuración de perfil
```

### Administrativas (`/admin/*`)

```
GET  /admin/dashboard              Panel administrativo
GET  /admin/biografias/edit        Editar biografía
GET  /admin/trayectorias           CRUD de trayectorias
GET  /admin/actividades            CRUD de actividades
GET  /admin/noticias               CRUD de noticias
GET  /admin/propuestas             CRUD de propuestas
GET  /admin/citas                  Gestión de citas
GET  /admin/mensajes               Mensajes de contacto
```

Ver [`RUTAS_Y_FLUJOS.md`](RUTAS_Y_FLUJOS.md) para lista completa y ejemplos

---

## 🔐 AUTENTICACIÓN Y AUTORIZACIÓN

### Roles

-   **admin:** Acceso a panel administrativo completo
-   **user:** Acceso solo a sus datos y funciones básicas

### Middleware

-   `auth`: Usuario debe estar autenticado
-   `verified`: Email debe estar verificado (Fortify)
-   `admin`: Usuario debe tener rol = 'admin'

### Flujo de Autorización

```
Usuario → Solicita ruta protegida
       → Middleware verifica auth
       → Middleware verifica email_verified_at
       → Middleware verifica role = 'admin' (si aplica)
       → ✅ Acceso concedido O ❌ Error 403
```

---

## 📁 MÓDULOS PRINCIPALES

### 1. **Biografía**

-   ✏️ Solo 1 registro permitido
-   📸 Imagen de perfil
-   🎯 Visión y misión

### 2. **Trayectoria Laboral**

-   💼 Múltiples empleos/cargos
-   📅 Años de inicio/fin
-   📝 Descripción de funciones

### 3. **Actividades**

-   🗓️ Eventos públicos con fecha/hora
-   📍 Ubicación del evento
-   🖼️ Imagen ilustrativa

### 4. **Noticias**

-   📰 Artículos y comunicados
-   ✅ Control de publicación (borrador/publicado)
-   🖼️ Imagen de portada

### 5. **Propuestas**

-   💡 Propuestas políticas/electorales
-   📝 Descripción detallada
-   🖼️ Imagen ilustrativa

### 6. **Citas Legales**

-   ⚖️ Solicitud de citas para asesoría legal
-   ⏳ Estados: Pendiente → Aprobado/Rechazado
-   💬 Motivo de rechazo (si aplica)

### 7. **Mensajes de Contacto**

-   📧 Formulario público de contacto
-   🔔 Notificaciones para admin
-   ✅ Marca como leído

---

## 🎨 INTERFAZ Y DISEÑO

### Frontend (Público)

-   Responsive design (Mobile-first)
-   Tailwind CSS para estilos
-   Vite para bundling de assets
-   Blade templates para renderizado

### Admin Panel

-   Dashboard con estadísticas
-   Tablas paginadas para listados
-   Formularios con validación
-   Modales para confirmaciones
-   Iconos y badges para estados

### Colores y Estados

-   🟡 **Amarillo (Pendiente):** Requiere acción
-   🟢 **Verde (Aprobado):** Confirmado
-   🔴 **Rojo (Rechazado):** Denegado
-   ⚪ **Blanco (Nuevo):** No leído

---

## 📚 DOCUMENTACIÓN

| Archivo                                                | Contenido                                          |
| ------------------------------------------------------ | -------------------------------------------------- |
| [`DOCUMENTACION_TECNICA.md`](DOCUMENTACION_TECNICA.md) | Arquitectura, modelos, controladores, validaciones |
| [`INSTALACION.md`](INSTALACION.md)                     | Guía paso-a-paso de instalación                    |
| [`ADMIN_GUIDE.md`](ADMIN_GUIDE.md)                     | Manual de uso del panel administrativo             |
| [`DIAGRAMA_ER.md`](DIAGRAMA_ER.md)                     | Diagrama entidad-relación y esquema BD             |
| [`RUTAS_Y_FLUJOS.md`](RUTAS_Y_FLUJOS.md)               | Referencia completa de rutas y flujos de datos     |
| `README.md`                                            | Este archivo (resumen)                             |

---

## 🚀 INICIO RÁPIDO

### Para Desarrolladores

```powershell
# Desarrollo local con watch
npm run dev

# Ejecutar en otra terminal
php artisan serve

# Acceso: http://localhost:8000
# Admin: admin@hugoraul.com / admin123456
```

### Para Producción

```powershell
# Compilar assets
npm run build

# Optimizar autoload
composer install --optimize-autoloader --no-dev

# Desactivar debug mode en .env
APP_DEBUG=false

# Ejecutar en servidor (Nginx/Apache)
# Ver INSTALACION.md para configuración
```

---

## 🐛 SOLUCIÓN DE PROBLEMAS

### "Base de datos no conecta"

→ Verificar credenciales en `.env`  
→ Asegurar que MySQL está en ejecución  
→ Confirmar que la BD existe

### "Imágenes no se muestran"

→ Ejecutar: `php artisan storage:link`  
→ Verificar permisos en `storage/app/public/`

### "Error 419 CSRF"

→ Limpiar cache: `php artisan cache:clear`  
→ Regenerar app key: `php artisan key:generate`

### "Correo de verificación no llega"

→ Configurar MAIL\_\* en `.env`  
→ O usar vista: `Auth::route('email.verification.send')`

Ver [`INSTALACION.md`](INSTALACION.md) sección "Solución de Problemas"

---

## 📧 CONFIGURACIÓN DE CORREOS (Opcional)

Para que funcionen notificaciones de email:

```ini
# .env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_email@gmail.com
MAIL_PASSWORD=app_password
MAIL_FROM_ADDRESS=noreply@hugoraul.com
MAIL_FROM_NAME="Hugo Raúl"
```

Luego: `php artisan queue:work` para procesar emails

---

## 📊 ESTADÍSTICAS DEL PROYECTO

| Métrica           | Cantidad                                 |
| ----------------- | ---------------------------------------- |
| **Archivos PHP**  | 15+ (Modelos, Controladores, Middleware) |
| **Migraciones**   | 8                                        |
| **Modelos**       | 7                                        |
| **Controladores** | 8                                        |
| **Vistas Blade**  | 26+                                      |
| **Rutas**         | 31                                       |
| **Tablas BD**     | 8                                        |
| **Campos BD**     | 50+                                      |
| **Validaciones**  | 30+ reglas                               |

---

## 🔄 LIFECYCLE DE UNA SOLICITUD

```
Navegador (Cliente)
    ↓
Servidor Web (Apache/Nginx/PHP)
    ↓
Router (routes/web.php)
    ↓
Middleware (auth, verified, admin)
    ↓
Controlador (ActividadController, etc.)
    ↓
Modelo (Actividad, User, etc.)
    ↓
Base de Datos (MySQL)
    ↓
Respuesta (View o Redirect)
    ↓
Navegador (Renderiza HTML)
```

---

## 🤝 CONTRIBUCIONES

Para modificaciones o mejoras:

1. Crear rama: `git checkout -b feature/tu-feature`
2. Hacer cambios
3. Commit: `git commit -m "Describe cambio"`
4. Push: `git push origin feature/tu-feature`
5. Pull Request

---

## 📄 LICENCIA

Este proyecto es software privado. Todos los derechos reservados.

**Propietario:** Hugo Raúl López Vargas  
**Partido:** Juntos por el Perú  
**Año:** 2025

---

## 👨‍💻 SOPORTE TÉCNICO

### Problemas de Desarrollo

-   Ver [`DOCUMENTACION_TECNICA.md`](DOCUMENTACION_TECNICA.md)
-   Consultar [`RUTAS_Y_FLUJOS.md`](RUTAS_Y_FLUJOS.md)

### Problemas de Instalación

-   Ver [`INSTALACION.md`](INSTALACION.md)
-   Sección "Solución de Problemas"

### Cómo Usar Admin Panel

-   Ver [`ADMIN_GUIDE.md`](ADMIN_GUIDE.md)
-   Guía visual de cada módulo

### Entender Base de Datos

-   Ver [`DIAGRAMA_ER.md`](DIAGRAMA_ER.md)
-   Esquema SQL completo

---

## 📱 TECNOLOGÍAS UTILIZADAS

**Backend:**

-   Laravel 11 (Framework PHP)
-   MySQL 8.0+ (Base de Datos)
-   Eloquent ORM (Mapeo relacional)

**Frontend:**

-   Blade (Motor de plantillas)
-   Tailwind CSS (Framework CSS)
-   Vite (Build tool)
-   JavaScript (Interactividad)

**Autenticación:**

-   Laravel Fortify (Sistema auth)
-   Two-Factor Authentication (opcional)
-   Email verification (Verificación de email)

**Herramientas:**

-   Composer (Gestor dependencias PHP)
-   NPM (Gestor dependencias JS)
-   Git (Control de versiones)
-   XAMPP/WAMP (Servidor local)

---

## ✅ CHECKLIST DE INSTALACIÓN

```markdown
Requisitos:

-   [ ] PHP 8.2+ instalado
-   [ ] MySQL/MariaDB en ejecución
-   [ ] Composer instalado
-   [ ] Node.js y npm instalados

Instalación:

-   [ ] Repositorio clonado
-   [ ] composer install ejecutado
-   [ ] .env configurado
-   [ ] php artisan key:generate ejecutado
-   [ ] Base de datos creada
-   [ ] php artisan migrate:seed ejecutado
-   [ ] php artisan storage:link ejecutado
-   [ ] npm install ejecutado
-   [ ] npm run build ejecutado

Verificación:

-   [ ] php artisan serve funciona
-   [ ] http://localhost:8000 accesible
-   [ ] Login admin funciona
-   [ ] Panel admin accesible
-   [ ] Imágenes se cargan correctamente
```

---

## 🎓 PRÓXIMOS PASOS

1. **Personalizar:**

    - Cambiar nombre/logo de candidato
    - Actualizar colores (en Tailwind)
    - Agregar tu contenido

2. **Extender:**

    - Agregar más funcionalidades
    - Integrar con redes sociales
    - Sistema de donaciones

3. **Desplegar:**
    - Comprar dominio
    - Contratar hosting
    - Configurar SSL/HTTPS
    - Deployment a servidor

Ver **INSTALACION.md** → "Próximos Pasos" para detalles

---

## 📞 INFORMACIÓN DE CONTACTO

**Candidato:** Hugo Raúl López Vargas  
**Partido:** Juntos por el Perú  
**Teléfono:** +51 999 000 000  
**Email:** contacto@hugoraul.com  
**Sitio Web:** https://hugoraul.com

---

## 📅 VERSIÓN Y CHANGELOG

**Versión:** 1.0.0  
**Fecha de Lanzamiento:** Enero 2025  
**Estado:** Producción ✅

### Versión 1.0.0 Incluye:

-   Sistema completo de autenticación
-   CRUD para 7 módulos de contenido
-   Sistema de citas legales con flujo de aprobación
-   Formulario de contacto
-   Dashboard administrativo
-   Documentación completa

### Versiones Futuras Planeadas:

-   v1.1: Sistema de comentarios en noticias
-   v1.2: Donaciones en línea
-   v1.3: Integración redes sociales
-   v2.0: App móvil (React Native)

---

## 🙏 AGRADECIMIENTOS

Construido con ❤️ usando:

-   [Laravel Framework](https://laravel.com)
-   [Tailwind CSS](https://tailwindcss.com)
-   [Vite.js](https://vitejs.dev)
-   [Blade Templates](https://laravel.com/docs/blade)

---

**Última actualización:** 15 de Enero de 2025

[↑ Volver al inicio](#-página-web-de-hugo-raúl---juntos-por-el-perú)

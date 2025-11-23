# 📚 DOCUMENTACIÓN TÉCNICA - PÁGINA WEB DE HUGO RAÚL

## 🏗️ ARQUITECTURA DEL PROYECTO

Este es un proyecto **Laravel 11** que implementa una página web política con panel administrativo.

### Estructura Base

```
app-candidato/
├── app/                    # Código de la aplicación
│   ├── Http/
│   │   ├── Controllers/    # Controladores MVC
│   │   ├── Middleware/     # Middlewares (AdminMiddleware)
│   │   └── Requests/       # Form Requests (validaciones)
│   ├── Models/             # Modelos Eloquent
│   └── Providers/          # Proveedores de servicios
├── database/               # Migraciones y seeders
│   ├── migrations/         # Cambios de BD
│   └── seeders/            # Datos iniciales
├── resources/              # Frontend
│   ├── css/                # Estilos (Tailwind CSS)
│   ├── js/                 # JavaScript
│   └── views/              # Vistas Blade
├── routes/                 # Definición de rutas
├── storage/                # Archivos subidos
└── public/                 # Archivos públicos
```

---

## 📊 MODELO DE BASE DE DATOS

### 1. **Tabla: users**

Almacena información de usuarios (ciudadanos y administradores)

| Campo             | Tipo      | Descripción           |
| ----------------- | --------- | --------------------- |
| id                | BIGINT    | Identificador único   |
| name              | STRING    | Nombre completo       |
| email             | STRING    | Email único           |
| phone             | STRING    | Número de teléfono    |
| email_verified_at | TIMESTAMP | Fecha de verificación |
| password          | STRING    | Contraseña encriptada |
| role              | ENUM      | 'admin' o 'user'      |
| created_at        | TIMESTAMP | Fecha de creación     |
| updated_at        | TIMESTAMP | Última actualización  |

```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

### 2. **Tabla: biografias**

Información de la biografía del candidato (máximo 1 registro)

| Campo      | Tipo      | Descripción            |
| ---------- | --------- | ---------------------- |
| id         | BIGINT    | Identificador único    |
| titulo     | STRING    | Título de la biografía |
| contenido  | LONGTEXT  | Contenido principal    |
| imagen     | STRING    | Ruta de imagen         |
| vision     | TEXT      | Visión personal        |
| mision     | TEXT      | Misión personal        |
| created_at | TIMESTAMP | Fecha de creación      |
| updated_at | TIMESTAMP | Última actualización   |

---

### 3. **Tabla: trayectorias**

Experiencias y cargos del candidato

| Campo       | Tipo      | Descripción              |
| ----------- | --------- | ------------------------ |
| id          | BIGINT    | Identificador único      |
| titulo      | STRING    | Nombre del cargo/puesto  |
| descripcion | TEXT      | Descripción de funciones |
| anio_inicio | YEAR      | Año de inicio            |
| anio_fin    | YEAR      | Año de finalización      |
| institucion | STRING    | Institución/Empresa      |
| created_at  | TIMESTAMP | Fecha de creación        |
| updated_at  | TIMESTAMP | Última actualización     |

---

### 4. **Tabla: actividades**

Eventos y actividades públicas

| Campo       | Tipo      | Descripción          |
| ----------- | --------- | -------------------- |
| id          | BIGINT    | Identificador único  |
| titulo      | STRING    | Nombre del evento    |
| descripcion | TEXT      | Descripción          |
| fecha       | DATETIME  | Fecha y hora         |
| lugar       | STRING    | Ubicación            |
| imagen      | STRING    | Imagen del evento    |
| created_at  | TIMESTAMP | Fecha de creación    |
| updated_at  | TIMESTAMP | Última actualización |

---

### 5. **Tabla: noticias**

Noticias publicadas en la web

| Campo             | Tipo      | Descripción                 |
| ----------------- | --------- | --------------------------- |
| id                | BIGINT    | Identificador único         |
| titulo            | STRING    | Título de noticia           |
| contenido         | TEXT      | Contenido completo          |
| imagen            | STRING    | Imagen de portada           |
| fecha_publicacion | DATETIME  | Fecha de publicación        |
| publicado         | BOOLEAN   | Estado (publicado/borrador) |
| created_at        | TIMESTAMP | Fecha de creación           |
| updated_at        | TIMESTAMP | Última actualización        |

---

### 6. **Tabla: citas**

Solicitudes de citas legales gratuitas

| Campo         | Tipo      | Descripción                          |
| ------------- | --------- | ------------------------------------ |
| id            | BIGINT    | Identificador único                  |
| user_id       | BIGINT    | FK a users                           |
| fecha         | DATE      | Fecha solicitada                     |
| hora          | TIME      | Hora solicitada                      |
| motivo        | TEXT      | Motivo de la consulta                |
| estado        | ENUM      | 'pendiente', 'aprobado', 'rechazado' |
| razon_rechazo | TEXT      | Razón si es rechazada                |
| created_at    | TIMESTAMP | Fecha de creación                    |
| updated_at    | TIMESTAMP | Última actualización                 |

**Relación**: FK user_id → users.id (ON DELETE CASCADE)

---

### 7. **Tabla: mensajes_contacto**

Mensajes de contacto de ciudadanos

| Campo      | Tipo      | Descripción            |
| ---------- | --------- | ---------------------- |
| id         | BIGINT    | Identificador único    |
| nombre     | STRING    | Nombre del remitente   |
| correo     | STRING    | Email                  |
| telefono   | STRING    | Teléfono               |
| mensaje    | TEXT      | Contenido del mensaje  |
| leido      | BOOLEAN   | Si fue leído por admin |
| created_at | TIMESTAMP | Fecha de creación      |
| updated_at | TIMESTAMP | Última actualización   |

---

### 8. **Tabla: propuestas**

Propuestas políticas/electorales

| Campo       | Tipo      | Descripción          |
| ----------- | --------- | -------------------- |
| id          | BIGINT    | Identificador único  |
| titulo      | STRING    | Nombre de propuesta  |
| descripcion | TEXT      | Descripción completa |
| imagen      | STRING    | Imagen ilustrativa   |
| created_at  | TIMESTAMP | Fecha de creación    |
| updated_at  | TIMESTAMP | Última actualización |

---

## 🔗 DIAGRAMA ER (Entidad-Relación)

```
┌─────────────┐
│   USERS     │
├─────────────┤
│ id (PK)     │
│ name        │
│ email       │
│ phone       │
│ password    │
│ role        │◄──────────────┐
└─────────────┘               │
      ▲                       │
      │ 1                  1:N
      │                       │
      │                ┌──────────────┐
      │                │    CITAS     │
      │                ├──────────────┤
      │                │ id (PK)      │
      │                │ user_id (FK) │
      │                │ fecha        │
      │                │ hora         │
      │                │ motivo       │
      │                │ estado       │
      └────────────────┴──────────────┘

┌─────────────────┐
│  BIOGRAFIAS     │  (Máximo 1)
├─────────────────┤
│ id (PK)         │
│ titulo          │
│ contenido       │
│ imagen          │
│ vision          │
│ mision          │
└─────────────────┘

┌─────────────────┐
│ TRAYECTORIAS    │  (1:N)
├─────────────────┤
│ id (PK)         │
│ titulo          │
│ descripcion     │
│ anio_inicio     │
│ anio_fin        │
│ institucion     │
└─────────────────┘

┌─────────────────┐
│  ACTIVIDADES    │  (1:N)
├─────────────────┤
│ id (PK)         │
│ titulo          │
│ descripcion     │
│ fecha           │
│ lugar           │
│ imagen          │
└─────────────────┘

┌─────────────────┐
│   NOTICIAS      │  (1:N)
├─────────────────┤
│ id (PK)         │
│ titulo          │
│ contenido       │
│ imagen          │
│ fecha_publ      │
│ publicado       │
└─────────────────┘

┌─────────────────┐
│  PROPUESTAS     │  (1:N)
├─────────────────┤
│ id (PK)         │
│ titulo          │
│ descripcion     │
│ imagen          │
└─────────────────┘

┌──────────────────┐
│ MENSAJES_CONTACTO│  (1:N)
├──────────────────┤
│ id (PK)          │
│ nombre           │
│ correo           │
│ telefono         │
│ mensaje          │
│ leido            │
└──────────────────┘
```

---

## 📦 MODELOS ELOQUENT

### 1. User Model

```php
class User extends Authenticatable {
    // Relaciones
    public function citas() {
        return $this->hasMany(Cita::class);
    }

    // Métodos helpers
    public function esAdmin(): bool {
        return $this->role === 'admin';
    }
}
```

**Tabla:** users  
**Fillable:** name, email, phone, password, role  
**Relaciones:**

-   hasMany(Cita::class) - Un usuario puede tener muchas citas

---

### 2. Biografia Model

```php
class Biografia extends Model {
    public static function obtener() {
        return self::first() ?? new self();
    }
}
```

**Tabla:** biografias  
**Fillable:** titulo, contenido, imagen, vision, mision  
**Método Especial:** obtener() - retorna la única biografía o una nueva instancia

---

### 3. Trayectoria Model

```php
class Trayectoria extends Model {
    protected $casts = [
        'anio_inicio' => 'integer',
        'anio_fin' => 'integer',
    ];
}
```

**Tabla:** trayectorias  
**Fillable:** titulo, descripcion, anio_inicio, anio_fin, institucion

---

### 4. Actividad Model

```php
class Actividad extends Model {
    protected $casts = [
        'fecha' => 'datetime',
    ];
}
```

**Tabla:** actividades  
**Fillable:** titulo, descripcion, fecha, lugar, imagen

---

### 5. Noticia Model

```php
class Noticia extends Model {
    protected $casts = [
        'fecha_publicacion' => 'datetime',
        'publicado' => 'boolean',
    ];
}
```

**Tabla:** noticias  
**Fillable:** titulo, contenido, imagen, fecha_publicacion, publicado

---

### 6. Cita Model

```php
class Cita extends Model {
    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getEstadoClase() {
        return match ($this->estado) {
            'pendiente' => 'bg-yellow-100 text-yellow-800',
            'aprobado' => 'bg-green-100 text-green-800',
            'rechazado' => 'bg-red-100 text-red-800',
        };
    }
}
```

**Tabla:** citas  
**Fillable:** user_id, fecha, hora, motivo, estado, razon_rechazo  
**Relaciones:** belongsTo(User)

---

### 7. MensajeContacto Model

```php
class MensajeContacto extends Model {
    public function marcarComoLeido() {
        $this->update(['leido' => true]);
        return $this;
    }
}
```

**Tabla:** mensajes_contacto  
**Fillable:** nombre, correo, telefono, mensaje, leido

---

### 8. Propuesta Model

```php
class Propuesta extends Model {
    // Modelo simple
}
```

**Tabla:** propuestas  
**Fillable:** titulo, descripcion, imagen

---

## 🎮 CONTROLADORES Y LÓGICA

### 1. BiografiaController

**Métodos:**

-   `show()` - Mostrar biografía pública
-   `edit()` - Mostrar formulario edición (Admin)
-   `update()` - Guardar cambios (Admin)

**Autorización:** El método `edit()` verifica que sea admin

---

### 2. TrayectoriaController

**Métodos (CRUD):**

-   `index()` - Listado público
-   `indexAdmin()` - Listado admin con paginación
-   `create()` - Formulario creación
-   `store()` - Guardar nuevo registro
-   `edit()` - Formulario edición
-   `update()` - Actualizar
-   `destroy()` - Eliminar

**Validaciones:**

```php
'titulo' => 'required|string|max:255',
'descripcion' => 'required|string',
'anio_inicio' => 'required|integer|min:1900|max:' . date('Y'),
'anio_fin' => 'nullable|integer|min:1900|max:' . date('Y'),
'institucion' => 'required|string|max:255',
```

---

### 3. ActividadController

**Métodos (CRUD):**

-   `index()` - Listado público paginado
-   `indexAdmin()` - Listado admin
-   `create()`, `store()`, `edit()`, `update()`, `destroy()`

**Validaciones:**

```php
'titulo' => 'required|string|max:255',
'descripcion' => 'required|string',
'fecha' => 'required|date',
'lugar' => 'required|string|max:255',
'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
```

**Gestión de archivos:** Deleta imagen anterior si se sube una nueva

---

### 4. NoticiaController

**Métodos (CRUD):**

-   `index()` - Listado público (solo publicadas)
-   `show()` - Detalle de noticia
-   `indexAdmin()`, `create()`, `store()`, `edit()`, `update()`, `destroy()`

**Validaciones:**

```php
'titulo' => 'required|string|max:255',
'contenido' => 'required|string',
'fecha_publicacion' => 'required|date',
'publicado' => 'boolean',
'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
```

---

### 5. CitaController

**Métodos:**

-   `create()` - Mostrar formulario
-   `store()` - Guardar cita
-   `misCitas()` - Ver mis citas (usuario autenticado)
-   `indexAdmin()` - Listado admin
-   `aprobar()` - Aprobar cita
-   `rechazar()` - Rechazar con motivo
-   `destroy()` - Eliminar cita

**Validaciones en store:**

```php
'fecha' => 'required|date|after:today',
'hora' => 'required|date_format:H:i',
'motivo' => 'required|string|max:1000',
```

---

### 6. MensajeContactoController

**Métodos:**

-   `create()` - Mostrar formulario público
-   `store()` - Guardar mensaje
-   `indexAdmin()` - Listado admin
-   `show()` - Ver detalles (marca como leído)
-   `destroy()` - Eliminar

**Validaciones:**

```php
'nombre' => 'required|string|max:255',
'correo' => 'required|email|max:255',
'telefono' => 'nullable|string|max:20',
'mensaje' => 'required|string|max:1000',
```

---

### 7. PropuestaController

**Métodos (CRUD):**

-   `index()` - Listado público
-   `show()` - Detalles
-   `indexAdmin()`, `create()`, `store()`, `edit()`, `update()`, `destroy()`

**Validaciones:**

```php
'titulo' => 'required|string|max:255',
'descripcion' => 'required|string',
'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
```

---

### 8. DashboardController

**Métodos:**

-   `__invoke()` - Mostrar dashboard según rol del usuario

**Dashboard Admin muestra:**

-   Total de citas, citas pendientes
-   Total de mensajes, no leídos
-   Total de noticias y actividades
-   Últimas 5 citas
-   Últimos 5 mensajes

**Dashboard Usuario muestra:**

-   Mis citas
-   Próximas actividades
-   Últimas noticias

---

### 9. PageController

**Métodos:**

-   `home()` - Página de inicio
-   `index()` - Alias de welcome

---

## 🛣️ RUTAS DEL SISTEMA

### Rutas Públicas

```
GET  /                          → welcome (página inicio)
GET  /biografia                 → biografía.show
GET  /trayectoria               → trayectoria.index
GET  /propuestas                → propuestas.index
GET  /propuestas/{propuesta}    → propuestas.show
GET  /actividades               → actividades.index
GET  /noticias                  → noticias.index
GET  /noticias/{noticia}        → noticias.show
GET  /contacto                  → contacto.create (formulario)
POST /contacto                  → contacto.store (guardar)
```

### Rutas Autenticadas (Usuarios)

```
GET  /dashboard                 → dashboard (principal)
GET  /citas                     → citas.create (formulario)
POST /citas                     → citas.store (guardar)
GET  /mis-citas                 → citas.misCitas (ver mis citas)
GET  /settings/profile          → profile.edit (Fortify)
GET  /settings/password         → user-password.edit (Fortify)
GET  /settings/appearance       → appearance.edit (Fortify)
GET  /settings/two-factor       → two-factor.show (Fortify)
```

### Rutas Admin (middleware: admin)

**Prefix: /admin, Name: admin.**

```
GET  /admin/dashboard                      → admin.dashboard
GET  /admin/biografias/edit                → admin.biografias.edit
PUT  /admin/biografias                     → admin.biografias.update

GET  /admin/trayectorias                   → admin.trayectorias.index
GET  /admin/trayectorias/create            → admin.trayectorias.create
POST /admin/trayectorias                   → admin.trayectorias.store
GET  /admin/trayectorias/{id}/edit         → admin.trayectorias.edit
PUT  /admin/trayectorias/{id}              → admin.trayectorias.update
DELETE /admin/trayectorias/{id}            → admin.trayectorias.destroy

GET  /admin/actividades                    → admin.actividades.index
GET  /admin/actividades/create             → admin.actividades.create
POST /admin/actividades                    → admin.actividades.store
GET  /admin/actividades/{id}/edit          → admin.actividades.edit
PUT  /admin/actividades/{id}               → admin.actividades.update
DELETE /admin/actividades/{id}             → admin.actividades.destroy

GET  /admin/noticias                       → admin.noticias.index
GET  /admin/noticias/create                → admin.noticias.create
POST /admin/noticias                       → admin.noticias.store
GET  /admin/noticias/{id}/edit             → admin.noticias.edit
PUT  /admin/noticias/{id}                  → admin.noticias.update
DELETE /admin/noticias/{id}                → admin.noticias.destroy

GET  /admin/propuestas                     → admin.propuestas.index
GET  /admin/propuestas/create              → admin.propuestas.create
POST /admin/propuestas                     → admin.propuestas.store
GET  /admin/propuestas/{id}/edit           → admin.propuestas.edit
PUT  /admin/propuestas/{id}                → admin.propuestas.update
DELETE /admin/propuestas/{id}              → admin.propuestas.destroy

GET  /admin/citas                          → admin.citas.index
PUT  /admin/citas/{id}/aprobar             → admin.citas.aprobar
PUT  /admin/citas/{id}/rechazar            → admin.citas.rechazar
DELETE /admin/citas/{id}                   → admin.citas.destroy

GET  /admin/mensajes                       → admin.mensajes.index
GET  /admin/mensajes/{id}                  → admin.mensajes.show
DELETE /admin/mensajes/{id}                → admin.mensajes.destroy
```

---

## 🔐 CONTROL DE ACCESO

### Middleware: AdminMiddleware

```php
// Ubicación: app/Http/Middleware/AdminMiddleware.php
if (!auth()->check() || !auth()->user()->esAdmin()) {
    abort(403, 'No tienes permiso');
}
```

**Se aplica a:** Todas las rutas bajo `/admin/*`

### Autenticación

-   **Driver:** Laravel Fortify (configurado en proyecto)
-   **Verificación de email:** Requerida
-   **Two-Factor:** Disponible

---

## 📁 ESTRUCTURA DE VISTAS BLADE

### Vistas Públicas

```
resources/views/
├── welcome.blade.php           # Página inicio
├── biografia/
│   └── show.blade.php
├── trayectoria/
│   └── index.blade.php
├── propuestas/
│   ├── index.blade.php
│   └── show.blade.php
├── actividades/
│   └── index.blade.php
├── noticias/
│   ├── index.blade.php
│   └── show.blade.php
├── contacto/
│   └── create.blade.php
└── citas/
    ├── create.blade.php
    └── mis-citas.blade.php
```

### Vistas Admin

```
resources/views/admin/
├── dashboard.blade.php         # Panel principal
├── biografias/
│   └── edit.blade.php
├── trayectorias/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── actividades/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── noticias/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── propuestas/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── citas/
│   └── index.blade.php
└── mensajes/
    ├── index.blade.php
    └── show.blade.php
```

---

## 🔄 FLUJO DE DATOS: Usuario → Backend → BD

### Ejemplo: Crear una Actividad

**1. Usuario Admin accede a:**

```
GET /admin/actividades/create
```

**2. Controller ActividadController@create:**

```php
public function create() {
    $this->authorize('admin'); // Verifica rol
    return view('admin.actividades.create');
}
```

**3. Vista muestra formulario** (`admin/actividades/create.blade.php`)

**4. Usuario completa y envía:**

```
POST /admin/actividades
```

**5. Controller ActividadController@store:**

```php
public function store(Request $request) {
    $this->authorize('admin');
    $validated = $request->validate([...]);
    if ($request->hasFile('imagen')) {
        $validated['imagen'] = $request->file('imagen')->store('actividades', 'public');
    }
    Actividad::create($validated); // Guarda en BD
    return redirect()->route('admin.actividades.index')->with('success', '...');
}
```

**6. Base de datos recibe:**

```sql
INSERT INTO actividades (titulo, descripcion, fecha, lugar, imagen, created_at, updated_at)
VALUES ('...', '...', '...', '...', 'path/to/image.jpg', NOW(), NOW());
```

**7. Usuario redirigido a listado** (`admin/actividades/index`)

**8. Vista obtiene datos:**

```php
@foreach($actividades as $actividad)
    <!-- Muestra cada actividad -->
@endforeach
```

---

## 🎯 CRUD COMPLETO: TRAYECTORIAS

### 1. **READ (Ver listado)**

```
GET /admin/trayectorias → TrayectoriaController@indexAdmin()
```

```php
$trayectorias = Trayectoria::orderBy('anio_inicio', 'desc')->paginate(10);
return view('admin.trayectorias.index', compact('trayectorias'));
```

### 2. **CREATE (Crear nuevo)**

```
GET /admin/trayectorias/create → TrayectoriaController@create()
```

```php
return view('admin.trayectorias.create');
```

### 3. **STORE (Guardar)**

```
POST /admin/trayectorias → TrayectoriaController@store()
```

```php
$validated = $request->validate([...]);
Trayectoria::create($validated);
```

### 4. **UPDATE (Editar)**

```
GET /admin/trayectorias/{id}/edit → TrayectoriaController@edit()
PUT /admin/trayectorias/{id} → TrayectoriaController@update()
```

### 5. **DELETE (Eliminar)**

```
DELETE /admin/trayectorias/{id} → TrayectoriaController@destroy()
```

---

## 🗄️ GESTIÓN DE ARCHIVOS

### Almacenamiento Público

-   **Ubicación:** `public/storage/`
-   **Directorio virtual:** Creado mediante `php artisan storage:link`
-   **Acceso URL:** `asset('storage/ruta/archivo')`

### Carpetas de Almacenamiento

```
storage/app/public/
├── biografias/     # Imágenes de biografía
├── actividades/    # Imágenes de actividades
├── noticias/       # Imágenes de noticias
└── propuestas/     # Imágenes de propuestas
```

### Subida de Archivos

```php
if ($request->hasFile('imagen')) {
    $validated['imagen'] = $request->file('imagen')
        ->store('carpeta', 'public');
}
```

### Eliminación de Archivos

```php
if ($modelo->imagen && file_exists(public_path('storage/' . $modelo->imagen))) {
    unlink(public_path('storage/' . $modelo->imagen));
}
```

---

## 📧 VALIDACIONES

### Validaciones Comunes

**Usuario:**

```php
'email' => 'required|email|unique:users',
'password' => 'required|min:8|confirmed',
'role' => 'required|in:admin,user',
```

**Biografía:**

```php
'titulo' => 'required|string|max:255',
'contenido' => 'required|string',
'imagen' => 'nullable|image|max:2048',
```

**Actividad/Noticia:**

```php
'fecha' => 'required|date',
'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
```

**Cita:**

```php
'fecha' => 'required|date|after:today',
'hora' => 'required|date_format:H:i',
'motivo' => 'required|string|max:1000',
```

---

Fin del documento de arquitectura.

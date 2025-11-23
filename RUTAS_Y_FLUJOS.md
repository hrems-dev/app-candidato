# 🛣️ REFERENCIA COMPLETA DE RUTAS

## Página Web de Hugo Raúl - Juntos por el Perú

---

## 📍 ÍNDICE DE RUTAS

### Secciones

-   [🌐 Rutas Públicas](#rutas-públicas)
-   [🔐 Rutas Autenticadas](#rutas-autenticadas-usuarios)
-   [👨‍💼 Rutas Admin](#rutas-admin)
-   [🔄 Flujos de Datos](#flujos-de-datos)
-   [🔀 Ejemplo: Crear una Actividad](#ejemplo-completo-crear-actividad)

---

## 🌐 RUTAS PÚBLICAS

### Página de Inicio

```
GET /
Nombre: welcome
Controlador: PageController@index
Vista: welcome.blade.php
Descripción: Landing page principal con hero, stats, noticias destacadas
Parámetros: Ninguno
Autenticación: No requerida
Middleware: web
```

### Biografía del Candidato

```
GET /biografia
Nombre: biografia.show
Controlador: BiografiaController@show
Vista: biografia/show.blade.php
Descripción: Muestra biografía, visión y misión del candidato
Parámetros: Ninguno
Datos BD:
    - Traer FROM biografias LIMIT 1
    - Si no existe, muestra formulario vacío
Autenticación: No
```

### Trayectoria Profesional (Listado)

```
GET /trayectoria
Nombre: trayectoria.index
Controlador: TrayectoriaController@index
Vista: trayectoria/index.blade.php
Descripción: Lista de experiencias profesionales del candidato
Query: SELECT * FROM trayectorias ORDER BY anio_inicio DESC
Paginación: No (todas las trayectorias)
Autenticación: No
Campos mostrados: titulo, descripcion, anio_inicio, anio_fin, institucion
```

### Propuestas (Listado)

```
GET /propuestas
Nombre: propuestas.index
Controlador: PropuestaController@index
Vista: propuestas/index.blade.php
Descripción: Grid de propuestas políticas (2 columnas)
Query: SELECT * FROM propuestas PAGINATE(6)
Paginación: 6 por página
Autenticación: No
```

### Propuesta (Detalle)

```
GET /propuestas/{propuesta}
Nombre: propuestas.show
Controlador: PropuestaController@show
Vista: propuestas/show.blade.php
Parámetro: propuesta (Model Binding - ID de propuesta)
Descripción: Detalle completo de propuesta con imagen y descripción
Query: SELECT * FROM propuestas WHERE id = ?
Error: 404 si no existe
Autenticación: No
```

### Actividades (Listado)

```
GET /actividades
Nombre: actividades.index
Controlador: ActividadController@index
Vista: actividades/index.blade.php
Descripción: Eventos públicos programados
Query: SELECT * FROM actividades ORDER BY fecha DESC PAGINATE(6)
Paginación: 6 por página
Mostrar: Título, fecha, ubicación, imagen
Autenticación: No
```

### Noticias (Listado)

```
GET /noticias
Nombre: noticias.index
Controlador: NoticiaController@index
Vista: noticias/index.blade.php
Descripción: Noticias publicadas (solo publicado = true)
Query: SELECT * FROM noticias WHERE publicado = 1
        ORDER BY fecha_publicacion DESC PAGINATE(6)
Paginación: 6 por página
Autenticación: No
IMPORTANTE: Solo muestra noticias con publicado = 1
```

### Noticia (Detalle)

```
GET /noticias/{noticia}
Nombre: noticias.show
Controlador: NoticiaController@show
Vista: noticias/show.blade.php
Parámetro: noticia (Model Binding)
Descripción: Artículo completo con imagen y contenido
Query: SELECT * FROM noticias WHERE id = ? AND publicado = 1
Validación: Retorna 404 si publicado = false
Autenticación: No
```

### Formulario de Contacto

```
GET /contacto
Nombre: contacto.create
Controlador: MensajeContactoController@create
Vista: contacto/create.blade.php
Descripción: Formulario para ciudadanos contacten
Campos: nombre, correo, telefono (opcional), mensaje
Autenticación: No
```

### Guardar Mensaje de Contacto

```
POST /contacto
Nombre: contacto.store
Controlador: MensajeContactoController@store
Método HTTP: POST
Descripción: Procesa y guarda mensaje de contacto
Parámetros (Form):
    - nombre (string, 1-255 caracteres)
    - correo (email válido)
    - telefono (opcional, string)
    - mensaje (texto, máx 1000 caracteres)
Validaciones:
    - nombre: required|string|max:255
    - correo: required|email|max:255
    - telefono: nullable|string|max:20
    - mensaje: required|string|max:1000
Base de datos:
    INSERT INTO mensajes_contacto (nombre, correo, telefono, mensaje, leido)
    VALUES (?, ?, ?, ?, false)
Respuesta:
    - Si OK: Redirect con mensaje "Gracias, pronto nos contactaremos"
    - Si Error: Vuelve con errores mostrados
Autenticación: No
```

### Solicitar Cita (Formulario)

```
GET /citas
Nombre: citas.create
Controlador: CitaController@create
Vista: citas/create.blade.php
Descripción: Formulario para solicitar cita legal
Requerimientos: Usuario debe estar autenticado
    - Si NO está autenticado → Redirect a /login
Campos del formulario:
    - fecha (date picker)
    - hora (time picker)
    - motivo (textarea)
Autenticación: ✅ REQUERIDA (auth middleware)
Email verificado: ✅ REQUERIDO (verified middleware)
```

### Guardar Solicitud de Cita

```
POST /citas
Nombre: citas.store
Controlador: CitaController@store
Método: POST
Descripción: Guarda nueva solicitud de cita
Parámetros:
    - fecha (date, must be after today)
    - hora (time format HH:mm)
    - motivo (string, max 1000)
Validaciones:
    - fecha: required|date|after:today
    - hora: required|date_format:H:i
    - motivo: required|string|max:1000
Acción BD:
    INSERT INTO citas (user_id, fecha, hora, motivo, estado, created_at)
    VALUES (auth()->id(), ?, ?, ?, 'pendiente', now())
Estado inicial: 'pendiente' (requiere aprobación admin)
Respuesta: Redirect a /mis-citas con "Cita solicitada exitosamente"
Autenticación: ✅ auth + verified
```

---

## 🔐 RUTAS AUTENTICADAS (USUARIOS)

### Dashboard/Panel Principal

```
GET /dashboard
Nombre: dashboard
Controlador: DashboardController (invocable)
Vista: dashboard.blade.php (para usuarios regulares)
Descripción: Panel de control personalizado según rol
Middleware: auth, verified
Lógica:
    if (auth()->user()->esAdmin()) {
        return view('admin.dashboard')  // Admin
    }
    return view('dashboard')  // Usuario regular
Datos mostrados para usuarios:
    - Mis citas solicitadas
    - Próximas actividades
    - Últimas noticias
```

### Mis Solicitudes de Citas

```
GET /mis-citas
Nombre: citas.misCitas
Controlador: CitaController@misCitas
Vista: citas/mis-citas.blade.php
Descripción: Lista de citas del usuario autenticado
Query:
    SELECT * FROM citas
    WHERE user_id = auth()->id()
    ORDER BY fecha DESC
Paginación: No (o todas las del usuario)
Mostrar: fecha, hora, motivo, estado (con badge color)
Estados badge:
    - pendiente: Amarillo (⏳)
    - aprobado: Verde (✅)
    - rechazado: Rojo (❌) + motivo si aplica
Middleware: auth, verified
```

### Perfil del Usuario (Fortify)

```
GET /settings/profile
Nombre: profile.edit
Controlador: Fortify (built-in)
Vista: profile/edit.blade.php
Descripción: Editar información de perfil
Campos: name, email, photo
Middleware: auth, verified
```

### Cambiar Contraseña (Fortify)

```
GET /settings/password
Nombre: user-password.edit
Controlador: Fortify (built-in)
Descripción: Formulario cambiar contraseña
Middleware: auth, verified
```

### Apariencia/Preferencias (Fortify)

```
GET /settings/appearance
Nombre: appearance.edit
Controlador: Fortify (built-in)
Descripción: Configurar preferencias visuales
Middleware: auth, verified
```

### Autenticación de Dos Factores (Fortify)

```
GET /settings/two-factor
Nombre: two-factor.show
Controlador: Fortify (built-in)
Descripción: Configurar 2FA (QR, backup codes)
Middleware: auth, verified
```

---

## 👨‍💼 RUTAS ADMIN

### Prefijo de Todas las Rutas Admin

```
Prefix: /admin
Nombre: admin.*
Middleware: auth, verified, admin (AdminMiddleware)
```

### Dashboard Admin

```
GET /admin/dashboard
Nombre: admin.dashboard
Controlador: DashboardController@__invoke (misma clase que arriba)
Vista: admin/dashboard.blade.php
Descripción: Panel administrativo con estadísticas
Middleware: auth, verified, admin

Estadísticas mostradas:
    - Total de citas recibidas
    - Citas pendientes (requieren decisión)
    - Total de mensajes de contacto
    - Mensajes no leídos
    - Total de noticias publicadas
    - Total de actividades

Tablas dinámicas:
    - Últimas 5 citas (con usuario, fecha, estado)
    - Últimos 5 mensajes (con nombre, asunto preview)

Menú de acceso rápido a módulos:
    ├─ Biografía
    ├─ Trayectorias
    ├─ Actividades
    ├─ Noticias
    ├─ Propuestas
    ├─ Citas
    └─ Mensajes
```

### MÓDULO: BIOGRAFÍA (Admin)

#### Ver/Editar Biografía

```
GET /admin/biografias/edit
Nombre: admin.biografias.edit
Controlador: BiografiaController@edit
Vista: admin/biografias/edit.blade.php
Descripción: Formulario para editar biografía del candidato
Query: $biografia = Biografia::obtener()
Campos:
    - titulo (text input)
    - contenido (textarea/editor)
    - vision (textarea)
    - mision (textarea)
    - imagen (file upload, optional)
Middleware: auth, verified, admin
```

#### Guardar Biografía

```
PUT /admin/biografias
Nombre: admin.biografias.update
Controlador: BiografiaController@update
Método: PUT (via form method spoofing)
Parámetros:
    - titulo: required|string|max:255
    - contenido: required|string
    - vision: required|string
    - mision: required|string
    - imagen: nullable|image|max:2048
Lógica:
    1. Validar datos
    2. Si hay imagen nueva:
        - Eliminar anterior (si existe)
        - Guardar nueva: $request->file('imagen')->store('biografias', 'public')
    3. Actualizar registro en BD
    4. Redirect con "Biografía actualizada"
Middleware: auth, verified, admin
```

---

### MÓDULO: TRAYECTORIAS (Admin CRUD)

#### Listado de Trayectorias (Admin)

```
GET /admin/trayectorias
Nombre: admin.trayectorias.index
Controlador: TrayectoriaController@indexAdmin
Vista: admin/trayectorias/index.blade.php
Query: SELECT * FROM trayectorias PAGINATE(10) ORDER BY anio_inicio DESC
Paginación: 10 por página
Tabla con: titulo, institucion, periodo (anio_inicio-anio_fin), acciones
Botones: [Editar] [Eliminar]
Link: "+ Nueva Trayectoria"
Middleware: auth, verified, admin
```

#### Crear Trayectoria

```
GET /admin/trayectorias/create
Nombre: admin.trayectorias.create
Controlador: TrayectoriaController@create
Vista: admin/trayectorias/create.blade.php
Campos del formulario:
    - titulo (required)
    - descripcion (required, textarea)
    - anio_inicio (required, año)
    - anio_fin (optional, año)
    - institucion (required)
Middleware: auth, verified, admin
```

#### Guardar Nueva Trayectoria

```
POST /admin/trayectorias
Nombre: admin.trayectorias.store
Controlador: TrayectoriaController@store
Método: POST
Validaciones:
    - titulo: required|string|max:255
    - descripcion: required|string
    - anio_inicio: required|integer|min:1900|max:<CURRENT_YEAR>
    - anio_fin: nullable|integer|min:1900|max:<CURRENT_YEAR>
    - institucion: required|string|max:255
Acción:
    Trayectoria::create($validated)
Respuesta: Redirect a /admin/trayectorias con success
Middleware: auth, verified, admin
```

#### Editar Trayectoria

```
GET /admin/trayectorias/{trayectoria}/edit
Nombre: admin.trayectorias.edit
Controlador: TrayectoriaController@edit
Vista: admin/trayectorias/edit.blade.php
Parámetro: trayectoria (Model Binding)
Campos: Mismo que create, pre-llenados
Middleware: auth, verified, admin
```

#### Actualizar Trayectoria

```
PUT /admin/trayectorias/{trayectoria}
Nombre: admin.trayectorias.update
Controlador: TrayectoriaController@update
Método: PUT
Parámetro: trayectoria (Model Binding)
Parámetros: Mismo que store
Acción: $trayectoria->update($validated)
Respuesta: Redirect con success
Middleware: auth, verified, admin
```

#### Eliminar Trayectoria

```
DELETE /admin/trayectorias/{trayectoria}
Nombre: admin.trayectorias.destroy
Controlador: TrayectoriaController@destroy
Método: DELETE
Parámetro: trayectoria (Model Binding)
Acción:
    $trayectoria->delete()
    // Sin archivos que eliminar
Respuesta: Redirect con "Eliminado exitosamente"
Middleware: auth, verified, admin
```

---

### MÓDULO: ACTIVIDADES (Admin CRUD)

#### Listado de Actividades (Admin)

```
GET /admin/actividades
Nombre: admin.actividades.index
Controlador: ActividadController@indexAdmin
Vista: admin/actividades/index.blade.php
Query: SELECT * FROM actividades PAGINATE(10) ORDER BY fecha DESC
Mostrar: titulo, fecha, lugar, imagen thumbnail, acciones
Botones: [Editar] [Eliminar]
Middleware: auth, verified, admin
```

#### Crear Actividad

```
GET /admin/actividades/create
Nombre: admin.actividades.create
Controlador: ActividadController@create
Vista: admin/actividades/create.blade.php
Campos:
    - titulo (text)
    - descripcion (textarea)
    - fecha (date picker)
    - hora (time picker)
    - lugar (text)
    - imagen (file upload, optional)
Middleware: auth, verified, admin
```

#### Guardar Actividad

```
POST /admin/actividades
Nombre: admin.actividades.store
Controlador: ActividadController@store
Validaciones:
    - titulo: required|string|max:255
    - descripcion: required|string
    - fecha: required|date
    - hora: required|date_format:H:i
    - lugar: required|string|max:255
    - imagen: nullable|image|mimes:jpeg,png,jpg,gif|max:2048
Almacenamiento imagen:
    if ($request->hasFile('imagen')) {
        $validated['imagen'] = $request->file('imagen')
            ->store('actividades', 'public');
    }
Acción: Actividad::create($validated)
Middleware: auth, verified, admin
```

#### Editar Actividad

```
GET /admin/actividades/{actividad}/edit
Nombre: admin.actividades.edit
Controlador: ActividadController@edit
Vista: admin/actividades/edit.blade.php
Pre-llena campos + muestra imagen actual
Opción de reemplazar imagen
Middleware: auth, verified, admin
```

#### Actualizar Actividad

```
PUT /admin/actividades/{actividad}
Nombre: admin.actividades.update
Controlador: ActividadController@update
Lógica especial para imagen:
    if ($request->hasFile('imagen')) {
        // Eliminar anterior
        if ($actividad->imagen && file_exists(
            public_path('storage/' . $actividad->imagen)
        )) {
            unlink(public_path('storage/' . $actividad->imagen));
        }
        // Guardar nueva
        $validated['imagen'] = $request->file('imagen')
            ->store('actividades', 'public');
    }
    $actividad->update($validated);
Middleware: auth, verified, admin
```

#### Eliminar Actividad

```
DELETE /admin/actividades/{actividad}
Nombre: admin.actividades.destroy
Controlador: ActividadController@destroy
Lógica:
    - Eliminar imagen si existe
    - Eliminar registro de BD
    - Redirect con success
Middleware: auth, verified, admin
```

---

### MÓDULO: NOTICIAS (Admin CRUD)

#### Listado de Noticias (Admin)

```
GET /admin/noticias
Nombre: admin.noticias.index
Controlador: NoticiaController@indexAdmin
Vista: admin/noticias/index.blade.php
Query: SELECT * FROM noticias PAGINATE(6)
    ORDER BY fecha_publicacion DESC
    (Sin filtro, muestra todas: borradores + publicadas)
Grid 2 columnas con:
    - Imagen
    - Título
    - Fecha publicación
    - Badge: "✅ Publicado" o "⏳ Borrador"
    - Botones: [Editar] [Eliminar]
Middleware: auth, verified, admin
```

#### Crear Noticia

```
GET /admin/noticias/create
Nombre: admin.noticias.create
Controlador: NoticiaController@create
Vista: admin/noticias/create.blade.php
Campos:
    - titulo (text)
    - contenido (textarea or rich editor)
    - imagen (file upload)
    - fecha_publicacion (datetime picker)
    - publicado (toggle/checkbox)
        Si ☑ → visible en web pública
        Si ☐ → solo visible para admin (borrador)
Middleware: auth, verified, admin
```

#### Guardar Noticia

```
POST /admin/noticias
Nombre: admin.noticias.store
Controlador: NoticiaController@store
Validaciones:
    - titulo: required|string|max:255
    - contenido: required|string
    - imagen: nullable|image|max:2048
    - fecha_publicacion: required|date_time
    - publicado: boolean
Acción: Noticia::create($validated)
Respuesta: Redirect a /admin/noticias
Middleware: auth, verified, admin
```

#### Editar Noticia

```
GET /admin/noticias/{noticia}/edit
Nombre: admin.noticias.edit
Controlador: NoticiaController@edit
Vista: admin/noticias/edit.blade.php
Pre-llena todos los campos
Permite cambiar estado (borrador ↔ publicado)
Middleware: auth, verified, admin
```

#### Actualizar Noticia

```
PUT /admin/noticias/{noticia}
Nombre: admin.noticias.update
Controlador: NoticiaController@update
Similar a actividades (manejar imagen reemplazo)
Acción: $noticia->update($validated)
Nota importante:
    - Si publicado = true: NOW() visible en web
    - Si publicado = false: Desaparece de web pública
Middleware: auth, verified, admin
```

#### Eliminar Noticia

```
DELETE /admin/noticias/{noticia}
Nombre: admin.noticias.destroy
Controlador: NoticiaController@destroy
Elimina imagen asociada + registro BD
Middleware: auth, verified, admin
```

---

### MÓDULO: PROPUESTAS (Admin CRUD)

Mismo patrón que Noticias:

-   `GET /admin/propuestas` → list
-   `GET /admin/propuestas/create` → form
-   `POST /admin/propuestas` → save
-   `GET /admin/propuestas/{id}/edit` → edit form
-   `PUT /admin/propuestas/{id}` → update
-   `DELETE /admin/propuestas/{id}` → delete

Campos:

-   titulo (required)
-   descripcion (required)
-   imagen (optional)

---

### MÓDULO: CITAS (Admin Management)

#### Listado de Citas

```
GET /admin/citas
Nombre: admin.citas.index
Controlador: CitaController@indexAdmin
Vista: admin/citas/index.blade.php
Query: SELECT citas.*, users.name FROM citas
       JOIN users ON citas.user_id = users.id
       PAGINATE(20)
Tabla con:
    - Usuario (nombre)
    - Fecha solicitada
    - Hora
    - Motivo (preview)
    - Estado (badge: pendiente/aprobado/rechazado)
    - Acciones (botones)

Botones:
    ├─ Si estado = 'pendiente':
    │   ├─ [✅ Aprobar] → Envía a aprobar()
    │   └─ [❌ Rechazar] → Abre modal
    │
    ├─ Si estado = 'aprobado':
    │   └─ [Ver] o solo display
    │
    └─ Si estado = 'rechazado':
        └─ [Ver motivo]

Todos: [Delete] para eliminar registro

Modal rechazo:
    ┌──────────────────┐
    │ Razón Rechazo:   │
    │ [textarea]       │
    │ [Rechazar]       │
    └──────────────────┘

Middleware: auth, verified, admin
```

#### Aprobar Cita

```
PUT /admin/citas/{cita}/aprobar
Nombre: admin.citas.aprobar
Controlador: CitaController@aprobar
Método: PUT
Parámetro: cita (Model Binding)
Acción:
    $cita->update([
        'estado' => 'aprobado'
    ]);
Respuesta: Redirect con "Cita aprobada exitosamente"
Middleware: auth, verified, admin
```

#### Rechazar Cita

```
PUT /admin/citas/{cita}/rechazar
Nombre: admin.citas.rechazar
Controlador: CitaController@rechazar
Método: PUT
Parámetros:
    - razon_rechazo (required string)
Validaciones:
    - razon_rechazo: required|string|max:500
Acción:
    $cita->update([
        'estado' => 'rechazado',
        'razon_rechazo' => $request->razon_rechazo
    ]);
Respuesta: Redirect con "Cita rechazada"
Middleware: auth, verified, admin

Nota: El usuario verá el motivo en /mis-citas
```

#### Eliminar Cita

```
DELETE /admin/citas/{cita}
Nombre: admin.citas.destroy
Controlador: CitaController@destroy
Acción: $cita->delete()
Respuesta: Redirect
Middleware: auth, verified, admin
```

---

### MÓDULO: MENSAJES DE CONTACTO (Admin)

#### Listado de Mensajes

```
GET /admin/mensajes
Nombre: admin.mensajes.index
Controlador: MensajeContactoController@indexAdmin
Vista: admin/mensajes/index.blade.php
Query: SELECT * FROM mensajes_contacto
       PAGINATE(10) ORDER BY created_at DESC
Mostrar en cards/tabla:
    - Nombre
    - Email
    - Mensaje preview
    - Fecha
    - Indicador: "NEW" si leido = false
    - Botones: [Ver] [Eliminar]
Middleware: auth, verified, admin
```

#### Ver Mensaje Completo

```
GET /admin/mensajes/{mensaje}
Nombre: admin.mensajes.show
Controlador: MensajeContactoController@show
Vista: admin/mensajes/show.blade.php
Parámetro: mensaje (Model Binding)
Acción al cargar:
    - Mostrar detalles completos
    - Marcar como leído: $mensaje->marcarComoLeido()
Campos mostrados:
    - nombre
    - correo
    - telefono
    - mensaje (completo)
    - fecha (created_at)
Botones:
    - [Responder por Email*] (*funcionalidad futura)
    - [Eliminar]
Middleware: auth, verified, admin
```

#### Eliminar Mensaje

```
DELETE /admin/mensajes/{mensaje}
Nombre: admin.mensajes.destroy
Controlador: MensajeContactoController@destroy
Acción: $mensaje->delete()
Respuesta: Redirect a /admin/mensajes
Middleware: auth, verified, admin
```

---

## 🔄 FLUJOS DE DATOS

### FLUJO 1: Ciudadano Solicita Cita Legal

```
1. GET /citas (no autenticado)
   └─ Redirect a /login

2. Usuario se loguea
   POST /login (Fortify)

3. GET /citas (autenticado)
   └─ CitaController@create
   └─ Muestra formulario

4. Usuario completa formulario y envía
   POST /citas
   └─ CitaController@store
   └─ Validaciones OK
   └─ INSERT INTO citas (user_id, fecha, hora, motivo, estado='pendiente')
   └─ Redirect a /mis-citas

5. Usuario puede ver estado
   GET /mis-citas
   └─ Query: citas WHERE user_id = auth()->id()
   └─ Muestra: "Estado: ⏳ Pendiente"

6. Admin revisa y aprueba
   PUT /admin/citas/{id}/aprobar
   └─ UPDATE citas SET estado = 'aprobado'
   └─ Ciudadano ve: "Estado: ✅ Aprobado"

O Admin rechaza:
   PUT /admin/citas/{id}/rechazar
   └─ UPDATE citas SET estado = 'rechazado', razon_rechazo = '...'
   └─ Ciudadano ve: "Estado: ❌ Rechazado - Motivo: ..."
```

### FLUJO 2: Admin Publica Nueva Noticia

```
1. Admin accede a panel
   GET /admin/dashboard
   └─ DashboardController@__invoke

2. Navega a noticias
   GET /admin/noticias
   └─ NoticiaController@indexAdmin
   └─ Muestra todas (publicadas + borradores)

3. Click "+ Nueva Noticia"
   GET /admin/noticias/create
   └─ Muestra formulario

4. Admin llena datos
   POST /admin/noticias
   └─ NoticiaController@store
   └─ Validaciones
   └─ Si imagen: file->store('noticias', 'public')
   └─ INSERT INTO noticias
      (titulo, contenido, imagen, fecha_publicacion, publicado=false)
   └─ Redirect a /admin/noticias (muestra como "⏳ Borrador")

5. Admin revisa y publica
   GET /admin/noticias/{id}/edit
   └─ Marca checkbox "Publicado"

6. Guarda cambios
   PUT /admin/noticias/{id}
   └─ UPDATE noticias SET publicado = true
   └─ Ahora aparece en GET /noticias (pública)

7. Ciudadanos ven la noticia
   GET /noticias
   └─ NoticiaController@index
   └─ Query: WHERE publicado = 1
   └─ Muestra la nueva noticia

   GET /noticias/{id}
   └─ NoticiaController@show
   └─ Muestra artículo completo (solo si publicado = 1)
```

### FLUJO 3: Gestión de Imágenes

```
SUBIDA:
POST /admin/actividades
├─ if ($request->hasFile('imagen'))
├─   $file = $request->file('imagen')
├─   $path = $file->store('actividades', 'public')
│   // $path = "actividades/abc123.jpg"
├─ INSERT INTO actividades (..., imagen = $path, ...)
└─ Imagen guardada en: storage/app/public/actividades/abc123.jpg
   Accesible en web via: asset('storage/actividades/abc123.jpg')

ACTUALIZACIÓN:
PUT /admin/actividades/{id}
├─ if ($request->hasFile('imagen'))
├─   if (file_exists(public_path('storage/' . $old_path)))
├─     unlink(public_path('storage/' . $old_path))  // Borrar anterior
├─   $new_path = $file->store('actividades', 'public')
├─ UPDATE actividades SET imagen = $new_path
└─ Imagen anterior eliminada, nueva guardada

ELIMINACIÓN:
DELETE /admin/actividades/{id}
├─ if ($actividad->imagen && file_exists(...))
├─   unlink(public_path('storage/' . $actividad->imagen))
├─ DELETE FROM actividades WHERE id = ?
└─ Imagen y registro eliminados
```

---

## 🔀 EJEMPLO COMPLETO: CREAR UNA ACTIVIDAD

### Paso 1: Admin Accede a Actividades

```
GET /admin/actividades
↓
Middleware chain: auth → verified → admin (AdminMiddleware)
Middleware verifica:
  - Usuario está autenticado: ✅
  - Email verificado: ✅
  - user.role = 'admin': ✅
↓
ActividadController@indexAdmin() ejecuta:
  $actividades = Actividad::paginate(10);
  return view('admin.actividades.index', compact('actividades'));
↓
Vista muestra grid de actividades existentes
```

### Paso 2: Admin Hace Click en "+ Nueva Actividad"

```
GET /admin/actividades/create
↓
ActividadController@create()
  $this->authorize('admin');  // Verifica nuevamente
  return view('admin.actividades.create');
↓
Vista: admin/actividades/create.blade.php
Campos en formulario:
  <form action="{{ route('admin.actividades.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input name="titulo" required>
    <textarea name="descripcion" required></textarea>
    <input name="fecha" type="date" required>
    <input name="hora" type="time" required>
    <input name="lugar" required>
    <input name="imagen" type="file" accept="image/*">
    <button type="submit">Guardar</button>
  </form>
```

### Paso 3: Admin Completa Formulario

Datos ingresados:

```
titulo = "Mitin Electoral en Lima"
descripcion = "Encuentro con ciudadanos para discutir propuestas"
fecha = "2025-01-20"
hora = "14:30"
lugar = "Plaza de Armas, Lima"
imagen = [Archivo: mitin.jpg (800KB)]
```

### Paso 4: Admin Envía Formulario

```
POST /admin/actividades
↓
Content-Type: multipart/form-data
Body:
  titulo=Mitin Electoral en Lima
  descripcion=Encuentro con ciudadanos...
  fecha=2025-01-20
  hora=14:30
  lugar=Plaza de Armas, Lima
  imagen=[binary file data]
  _token=CSRF_TOKEN
```

### Paso 5: Controller Procesa Datos

```
ActividadController@store()
  │
  ├─ Validar entrada:
  │   $validated = $request->validate([
  │       'titulo' => 'required|string|max:255',
  │       'descripcion' => 'required|string',
  │       'fecha' => 'required|date',
  │       'hora' => 'required|date_format:H:i',
  │       'lugar' => 'required|string|max:255',
  │       'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
  │   ]);
  │   // Resultado: $validated = [
  │   //     'titulo' => 'Mitin Electoral en Lima',
  │   //     'descripcion' => 'Encuentro con ciudadanos...',
  │   //     'fecha' => '2025-01-20',
  │   //     'hora' => '14:30',
  │   //     'lugar' => 'Plaza de Armas, Lima'
  │   // ]
  │
  ├─ Procesar imagen (si existe):
  │   if ($request->hasFile('imagen')) {
  │       $path = $request->file('imagen')->store('actividades', 'public');
  │       // $path = "actividades/xyz789abc.jpg"
  │       $validated['imagen'] = $path;
  │   }
  │   // Ahora: $validated['imagen'] = 'actividades/xyz789abc.jpg'
  │
  ├─ Guardar en BD:
  │   Actividad::create($validated);
  │   // Ejecuta SQL:
  │   // INSERT INTO actividades
  │   //   (titulo, descripcion, fecha, hora, lugar, imagen, created_at, updated_at)
  │   // VALUES
  │   //   ('Mitin Electoral en Lima',
  │   //    'Encuentro con ciudadanos...',
  │   //    '2025-01-20',
  │   //    '14:30',
  │   //    'Plaza de Armas, Lima',
  │   //    'actividades/xyz789abc.jpg',
  │   //    '2025-01-10 10:30:00',
  │   //    '2025-01-10 10:30:00')
  │
  └─ Redirigir:
      return redirect()->route('admin.actividades.index')
                     ->with('success', 'Actividad creada exitosamente');
```

### Paso 6: Archivo Guardado en Servidor

```
Localización en servidor:
  storage/app/public/actividades/xyz789abc.jpg
  (archivo físico de imagen)

Acceso público vía symlink:
  public/storage/actividades/xyz789abc.jpg
  (apunta a la ruta anterior)

URL para mostrar en web:
  http://localhost:8000/storage/actividades/xyz789abc.jpg
  (Blade: {{ asset('storage/actividades/xyz789abc.jpg') }})
```

### Paso 7: Vista Admin Lista Actualizada

```
GET /admin/actividades (redirigido después de guardar)
↓
ActividadController@indexAdmin()
  $actividades = Actividad::paginate(10);

SQL ejecutada:
  SELECT * FROM actividades ORDER BY created_at DESC LIMIT 10

Resultado incluye:
  [
    {
      'id' => 1,
      'titulo' => 'Mitin Electoral en Lima',
      'descripcion' => 'Encuentro con ciudadanos...',
      'fecha' => '2025-01-20 14:30:00',
      'lugar' => 'Plaza de Armas, Lima',
      'imagen' => 'actividades/xyz789abc.jpg',
      'created_at' => '2025-01-10 10:30:00'
    }
  ]
↓
Vista muestra:
  ┌─────────────────────────────────┐
  │ [Imagen: mitin.jpg]             │
  │ Mitin Electoral en Lima         │
  │ 📅 2025-01-20 14:30             │
  │ 📍 Plaza de Armas, Lima         │
  │ [Editar] [Eliminar]             │
  └─────────────────────────────────┘
```

### Paso 8: Ciudadano Ve Actividad en Web Pública

```
GET /actividades
↓
ActividadController@index()
  $actividades = Actividad::orderBy('fecha', 'desc')
                          ->paginate(6);
↓
Vista pública: actividades/index.blade.php
  Muestra actividad en el listado

Ciudadano click en "Más detalles" (si existe)
GET /actividades/1 (si implementado)
↓
Muestra detalles completos de la actividad
```

### Timeline Completo

```
10:30:00 → Admin: POST /admin/actividades
10:30:01 → BD: INSERT registra nuevo ID = 1
10:30:01 → Filesystem: Imagen guardada en storage/app/public/actividades/
10:30:02 → Redirect: GET /admin/actividades
10:30:02 → Vista: Muestra nueva actividad en el listado
14:30:00 → [Fecha/Hora de actividad real]
[Mañana] → Ciudadano accede a /actividades y ve la actividad listada
```

---

Fin de referencia de rutas.

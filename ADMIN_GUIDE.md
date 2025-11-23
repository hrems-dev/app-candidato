# 👨‍💼 GUÍA DE ADMINISTRACIÓN - PANEL ADMIN

## Página Web de Hugo Raúl

---

## 🔓 ACCESO AL PANEL ADMIN

### Login

```
URL: http://localhost:8000/login

Email:    admin@hugoraul.com
Password: admin123456
```

Después de ingresar credenciales, accede a:

```
http://localhost:8000/admin/dashboard
```

---

## 📊 DASHBOARD PRINCIPAL

### Panel de Control (`/admin/dashboard`)

El dashboard muestra información clave en tiempo real:

```
┌─────────────────────────────────────────┐
│          PANEL ADMINISTRATIVO           │
├─────────────────────────────────────────┤
│                                         │
│  📋 Total de Citas: 25                 │
│  ⏳ Pendientes de Aprobación: 5        │
│  💬 Mensajes de Contacto: 12           │
│  📬 No Leídos: 3                       │
│                                         │
├─────────────────────────────────────────┤
│                                         │
│  MÓDULOS DISPONIBLES:                  │
│  • Biografía           👤              │
│  • Trayectoria         💼              │
│  • Actividades         📅              │
│  • Noticias            📰              │
│  • Propuestas          💡              │
│  • Citas Legales       ⚖️              │
│  • Mensajes             📧              │
│                                         │
├─────────────────────────────────────────┤
│                                         │
│  ÚLTIMAS CITAS SOLICITADAS:            │
│  ├─ Juan Pérez - 2025-01-15 (Pendiente)
│  ├─ María García - 2025-01-14 (Aprobado)
│  └─ Carlos López - 2025-01-13 (Rechazado)
│                                         │
│  ÚLTIMOS MENSAJES:                     │
│  ├─ Sofia Martínez - "Consulta sobre..."
│  └─ Roberto Chen - "Información acerca de"
│                                         │
└─────────────────────────────────────────┘
```

### Estadísticas Mostradas

-   **Total de Citas:** Número total de solicitudes recibidas
-   **Citas Pendientes:** Requieren acción (aprobar/rechazar)
-   **Mensajes Contacto:** Consultas de ciudadanos
-   **No Leídos:** Mensajes que necesitan atención

---

## 👤 MÓDULO 1: BIOGRAFÍA

### Editar Biografía del Candidato

**URL:** `/admin/biografias/edit`

#### Campos Disponibles

```
┌─────────────────────────────────────────┐
│         EDITAR BIOGRAFÍA                │
├─────────────────────────────────────────┤
│                                         │
│ TÍTULO:                                 │
│ [Hugo Raúl López Vargas]                │
│                                         │
│ CONTENIDO (Editor de Texto):            │
│ Nació en Lima, 1975...                 │
│ [Área de texto grande]                  │
│                                         │
│ VISIÓN:                                 │
│ Construir un Perú más justo...          │
│ [Área de texto]                         │
│                                         │
│ MISIÓN:                                 │
│ Defender los derechos de todos...       │
│ [Área de texto]                         │
│                                         │
│ FOTO DE PERFIL:                         │
│ [Imagen actual] [Seleccionar archivo]   │
│ Máximo 2MB - Formatos: JPG, PNG, GIF   │
│                                         │
│                 [GUARDAR]               │
│                                         │
└─────────────────────────────────────────┘
```

#### Pasos para Editar

1. **Acceder** a `/admin/biografias/edit`
2. **Modificar** cualquier campo
3. **Cambiar foto** (opcional) - Automáticamente elimina la anterior
4. **Guardar** con botón azul

#### Consideraciones

-   La biografía es **única** (máximo 1 registro)
-   La foto debe ser **profesional** (200x200 mínimo)
-   El contenido soporta **HTML básico** si es necesario

---

## 💼 MÓDULO 2: TRAYECTORIA LABORAL

### Listado de Trayectorias

**URL:** `/admin/trayectorias`

```
┌──────────────────────────────────────────────────────┐
│              TRAYECTORIA PROFESIONAL                 │
├──────────────────────────────────────────────────────┤
│                                                      │
│ [+ Nueva Trayectoria]                              │
│                                                      │
│ TABLA:                                               │
│ ┌────────────────────────────────────────────────┐  │
│ │ Título          │ Institución    │ Período   │  │
│ ├────────────────────────────────────────────────┤  │
│ │ Diputado        │ Congreso       │ 2020-2024 │  │
│ │ [Editar] [Delete]                              │  │
│ ├────────────────────────────────────────────────┤  │
│ │ Abogado         │ Estudio Legal  │ 2015-2020 │  │
│ │ [Editar] [Delete]                              │  │
│ └────────────────────────────────────────────────┘  │
│                                                      │
└──────────────────────────────────────────────────────┘
```

### Crear Nueva Trayectoria

**URL:** `/admin/trayectorias/create`

```
┌─────────────────────────────────────────┐
│        AGREGAR TRAYECTORIA              │
├─────────────────────────────────────────┤
│                                         │
│ TÍTULO *:                               │
│ [Diputado Provincial]                   │
│ Ej: Abogado, Ingeniero, Gerente        │
│                                         │
│ DESCRIPCIÓN *:                          │
│ [Ejercía funciones legislativas...]     │
│ [Área de texto]                         │
│                                         │
│ AÑO DE INICIO *:                        │
│ [2020]  (Mínimo: 1900)                 │
│                                         │
│ AÑO DE FINALIZACIÓN:                    │
│ [2024]  (Opcional)                      │
│                                         │
│ INSTITUCIÓN *:                          │
│ [Congreso de la República]              │
│                                         │
│       [Guardar]  [Cancelar]            │
│                                         │
└─────────────────────────────────────────┘
```

#### Campos Requeridos (\*)

-   **Título:** Nombre del cargo (máx 255 caracteres)
-   **Descripción:** Breve resumen de funciones
-   **Año Inicio:** Número entre 1900 y actual
-   **Institución:** Empresa u organización

#### Campos Opcionales

-   **Año Fin:** Si sigue vigente, dejar vacío

### Editar Trayectoria

**URL:** `/admin/trayectorias/{id}/edit`

Mismo formulario que crear, con campos pre-llenados.

### Eliminar Trayectoria

En listado, hacer click en botón rojo [Delete]. Confirmar en modal.

---

## 📅 MÓDULO 3: ACTIVIDADES

### Listado de Actividades

**URL:** `/admin/actividades`

```
┌──────────────────────────────────────────────────────┐
│            ACTIVIDADES Y EVENTOS                     │
├──────────────────────────────────────────────────────┤
│                                                      │
│ [+ Nueva Actividad]                                 │
│                                                      │
│ GRID DE ACTIVIDADES:                                │
│                                                      │
│ ┌─────────────────┐  ┌─────────────────┐           │
│ │ [Imagen]        │  │ [Imagen]        │           │
│ │ Mitin en Lima   │  │ Marcha Chiclayo │           │
│ │ 📅 2025-01-20   │  │ 📅 2025-01-25   │           │
│ │ 📍 Plaza Mayor  │  │ 📍 Calle Mayor  │           │
│ │ [Edit] [Delete] │  │ [Edit] [Delete] │           │
│ └─────────────────┘  └─────────────────┘           │
│                                                      │
└──────────────────────────────────────────────────────┘
```

### Crear Nueva Actividad

**URL:** `/admin/actividades/create`

```
┌─────────────────────────────────────────┐
│       CREAR NUEVA ACTIVIDAD             │
├─────────────────────────────────────────┤
│                                         │
│ TÍTULO *:                               │
│ [Mitin Electoral - Plaza Mayor]         │
│                                         │
│ DESCRIPCIÓN *:                          │
│ [Encuentro con ciudadanos de Lima...]   │
│ [Área de texto]                         │
│                                         │
│ FECHA *:                                │
│ [2025-01-20] (Formato: YYYY-MM-DD)    │
│                                         │
│ HORA *:                                 │
│ [14:30] (Formato: HH:MM)               │
│                                         │
│ LUGAR *:                                │
│ [Plaza de Armas - Lima Centro]          │
│                                         │
│ IMAGEN:                                 │
│ [Seleccionar archivo]                   │
│ Máximo 2MB - JPG, PNG, GIF              │
│                                         │
│       [Guardar]  [Cancelar]            │
│                                         │
└─────────────────────────────────────────┘
```

#### Campos Requeridos

-   **Título:** Nombre del evento
-   **Descripción:** Detalles del evento
-   **Fecha:** Cuándo ocurre (yyyy-mm-dd)
-   **Hora:** A qué hora (hh:mm)
-   **Lugar:** Dónde se realizará

#### Campos Opcionales

-   **Imagen:** Foto del evento

### Editar Actividad

Mismo formulario, con campos pre-llenados.

### Eliminar Actividad

Botón rojo [Delete] elimina la actividad y su imagen asociada.

---

## 📰 MÓDULO 4: NOTICIAS

### Listado de Noticias

**URL:** `/admin/noticias`

```
┌──────────────────────────────────────────────────────┐
│               GESTIÓN DE NOTICIAS                    │
├──────────────────────────────────────────────────────┤
│                                                      │
│ [+ Nueva Noticia]                                   │
│                                                      │
│ GRID:                                                │
│                                                      │
│ ┌─────────────────┐  ┌─────────────────┐           │
│ │ [Imagen]        │  │ [Imagen]        │           │
│ │ "Propuestas..." │  │ "Actividades... │           │
│ │ ✅ Publicado    │  │ ⏳ Borrador     │           │
│ │ [Edit] [Delete] │  │ [Edit] [Delete] │           │
│ └─────────────────┘  └─────────────────┘           │
│                                                      │
└──────────────────────────────────────────────────────┘
```

Indicadores:

-   ✅ Verde = Publicado (visible en web pública)
-   ⏳ Gris = Borrador (solo visible para admin)

### Crear Nueva Noticia

**URL:** `/admin/noticias/create`

```
┌─────────────────────────────────────────┐
│         CREAR NUEVA NOTICIA             │
├─────────────────────────────────────────┤
│                                         │
│ TÍTULO *:                               │
│ [Hugo Raúl presenta propuestas...]      │
│                                         │
│ CONTENIDO *:                            │
│ [Editor de texto con formato...]        │
│ [Área de texto grande]                  │
│                                         │
│ IMAGEN:                                 │
│ [Seleccionar archivo]                   │
│ [Vista previa]                          │
│                                         │
│ FECHA DE PUBLICACIÓN *:                 │
│ [2025-01-15 10:30]                      │
│ Formato: YYYY-MM-DD HH:MM              │
│                                         │
│ ESTADO:                                 │
│ ☑ Publicado   ☐ Borrador               │
│ (Si está marcado, será visible)         │
│                                         │
│       [Guardar]  [Cancelar]            │
│                                         │
└─────────────────────────────────────────┘
```

#### Campos Requeridos

-   **Título:** Encabezado de noticia
-   **Contenido:** Cuerpo completo
-   **Fecha:** Cuándo publicar
-   **Estado:** Publicado o borrador

#### Campos Opcionales

-   **Imagen:** Foto de portada

### Estados de Publicación

| Estado       | Visible Públicamente | Ubicación                      |
| ------------ | -------------------- | ------------------------------ |
| ✅ Publicado | SÍ                   | http://localhost:8000/noticias |
| ⏳ Borrador  | NO                   | Solo admin                     |

**Uso:** Crear en borrador, revisar, luego marcar "Publicado" para que aparezca en web.

---

## 💡 MÓDULO 5: PROPUESTAS POLÍTICAS

### Listado de Propuestas

**URL:** `/admin/propuestas`

### Crear Propuesta

**URL:** `/admin/propuestas/create`

```
┌─────────────────────────────────────────┐
│      CREAR NUEVA PROPUESTA              │
├─────────────────────────────────────────┤
│                                         │
│ TÍTULO *:                               │
│ [Reforma del sistema de salud]          │
│                                         │
│ DESCRIPCIÓN *:                          │
│ [Detalles de la propuesta...]           │
│ [Área de texto]                         │
│                                         │
│ IMAGEN:                                 │
│ [Seleccionar archivo]                   │
│                                         │
│       [Guardar]  [Cancelar]            │
│                                         │
└─────────────────────────────────────────┘
```

#### Campos Requeridos

-   **Título:** Nombre de la propuesta
-   **Descripción:** Explicación detallada

#### Campos Opcionales

-   **Imagen:** Ilustración o foto

### Editar y Eliminar

-   Mismo procedimiento que otros módulos
-   Botón [Edit] para modificar
-   Botón [Delete] para eliminar

---

## ⚖️ MÓDULO 6: SOLICITUD DE CITAS LEGALES

### Gestión de Citas

**URL:** `/admin/citas`

```
┌───────────────────────────────────────────────────────┐
│        GESTIÓN DE CITAS LEGALES                       │
├───────────────────────────────────────────────────────┤
│                                                       │
│ TABLA DE SOLICITUDES:                                │
│                                                       │
│ ┌────────────────────────────────────────────────┐   │
│ │ Usuario  │ Fecha     │ Hora  │ Estado    │ Acción
│ ├────────────────────────────────────────────────┤   │
│ │ Juan P.  │ 2025-01-20 │ 14:30 │ ⏳ Pdte │ ✅ ❌  │
│ ├────────────────────────────────────────────────┤   │
│ │ María G. │ 2025-01-15 │ 10:00 │ ✅ Apr  │ -   │
│ ├────────────────────────────────────────────────┤   │
│ │ Carlos L.│ 2025-01-10 │ 15:30 │ ❌ Rech │ -   │
│ └────────────────────────────────────────────────┘   │
│                                                       │
│ Leyenda:                                              │
│ ⏳ Pendiente = Requiere acción                       │
│ ✅ Aprobado = Confirmada                             │
│ ❌ Rechazado = Denegada                              │
│                                                       │
└───────────────────────────────────────────────────────┘
```

### Estados de Cita

**Flujo de Estados:**

```
┌──────────┐     ┌──────────┐
│ PENDIENTE│────→│ APROBADO │
└──────────┘     └──────────┘
     │
     └──────→┌──────────┐
             │RECHAZADO │
             └──────────┘
```

### Aprobar Cita

1. **Localizar** fila con estado ⏳ Pendiente
2. **Click** en botón ✅ (verde)
3. **Confirmación:** "Cita aprobada exitosamente"
4. Estado cambia a ✅ Aprobado

### Rechazar Cita

1. **Click** en botón ❌ (rojo)
2. **Modal aparece:**

```
┌─────────────────────────────────┐
│ RECHAZAR CITA                   │
├─────────────────────────────────┤
│                                 │
│ ¿Razón del rechazo?             │
│ [No disponible esa fecha...]    │
│ [Área de texto]                 │
│                                 │
│      [Rechazar]  [Cancelar]    │
│                                 │
└─────────────────────────────────┘
```

3. **Escribir motivo** (requerido)
4. **Confirmar** - El ciudadano verá el motivo en su cuenta

### Ver Detalles de Cita

Click en la fila para ver:

-   Información del usuario solicitante
-   Fecha y hora solicitada
-   Motivo de consulta legal
-   Historia de cambios

### Eliminar Cita

Botón [Delete] (solo si necesario)

---

## 📧 MÓDULO 7: MENSAJES DE CONTACTO

### Listado de Mensajes

**URL:** `/admin/mensajes`

```
┌──────────────────────────────────────────────────────┐
│         MENSAJES DE CIUDADANOS                       │
├──────────────────────────────────────────────────────┤
│                                                      │
│ CARD LAYOUT:                                         │
│                                                      │
│ ┌─────────────────────────────────┐                │
│ │ NEW  María García               │                │
│ │ Email: maria@example.com        │                │
│ │                                 │                │
│ │ "Consulta sobre la propuesta    │                │
│ │  de educación..."               │                │
│ │                                 │                │
│ │ Tel: +51 999 123 456            │                │
│ │ [Ver Completo]  [Eliminar]      │                │
│ └─────────────────────────────────┘                │
│                                                      │
└──────────────────────────────────────────────────────┘
```

**Indicadores:**

-   🟡 **NEW** = No leído (requiere atención)
-   ⚪ Sin indicador = Ya leído

### Ver Mensaje Completo

**URL:** `/admin/mensajes/{id}`

```
┌─────────────────────────────────────────────┐
│         DETALLES DEL MENSAJE                │
├─────────────────────────────────────────────┤
│                                             │
│ DE:           María García                 │
│ EMAIL:        maria@example.com            │
│ TELÉFONO:     +51 999 123 456              │
│                                             │
│ MENSAJE:                                   │
│ ┌────────────────────────────────────────┐ │
│ │ Consulta sobre la propuesta de         │ │
│ │ educación. Me gustaría saber si        │ │
│ │ incluye educación superior...          │ │
│ └────────────────────────────────────────┘ │
│                                             │
│ FECHA RECIBIDA: 2025-01-15 10:30          │
│                                             │
│ [RESPONDER POR EMAIL*] [ELIMINAR]         │ │
│                                             │
│ * Funcionalidad futura                    │
│                                             │
└─────────────────────────────────────────────┘
```

**Acciones:**

-   Leer contenido completo
-   Responder manualmente (copiar email del ciudadano)
-   Eliminar si es spam

### Marcar como Leído

Al hacer click en "Ver Completo", el mensaje se marca automáticamente como leído.

### Eliminar Mensaje

Botón [Eliminar] elimina el mensaje permanentemente.

---

## 🔧 CONSEJOS Y MEJORES PRÁCTICAS

### Biografía

✅ **Hacer:**

-   Usar fotos profesionales (CV style)
-   Actualizar regularmente
-   Mantener tono formal pero accesible

❌ **Evitar:**

-   Fotos casuales
-   Contenido político muy agresivo
-   Información personal innecesaria

### Trayectoria

✅ **Hacer:**

-   Listar en orden cronológico (reciente primero)
-   Incluir logros principales
-   Mantener descripciones concisas

❌ **Evitar:**

-   Períodos incompletos
-   Descripciones vagas
-   Omitir empleadores importantes

### Actividades

✅ **Hacer:**

-   Programar actividades con anticipación
-   Incluir ubicación exacta (dirección completa)
-   Foto representativa del evento

❌ **Evitar:**

-   Actividades sin ubicación clara
-   Fechas pasadas sin actualizar
-   Imágenes de baja calidad

### Noticias

✅ **Hacer:**

-   Crear en borrador primero
-   Revisar ortografía antes de publicar
-   Agendar publicación para horarios picos

❌ **Evitar:**

-   Errores tipográficos
-   Publicar directamente sin revisar
-   Información contradictoria

### Citas Legales

✅ **Hacer:**

-   Responder rápido (24-48 horas)
-   Ser claro en motivo de rechazo
-   Mantener registro de aprobaciones

❌ **Evitar:**

-   Rechazos sin explicación
-   Dejar citas pendientes indefinidamente

### Mensajes

✅ **Hacer:**

-   Revisar regularmente (mínimo 1x diaria)
-   Responder consultas válidas
-   Usar la información para mejorar

❌ **Evitar:**

-   Ignorar mensajes
-   Responder de mala manera
-   Eliminar sin leer

---

## ⌨️ ATAJOS ÚTILES

| Acción         | Atajo          |
| -------------- | -------------- |
| Ir a Dashboard | Ctrl + Alt + D |
| Crear nuevo    | Ctrl + N       |
| Guardar        | Ctrl + S       |
| Cancelar       | Esc            |
| Ir a Inicio    | Home           |
| Ir a Final     | End            |

---

## 🆘 SOLUCIÓN DE PROBLEMAS

### P: No puedo subir imágenes

**R:** Verifica que:

-   El archivo sea JPG, PNG o GIF
-   Pese menos de 2MB
-   La carpeta `storage/app/public` tenga permisos de escritura

### P: El formulario no guarda

**R:** Comprueba:

-   Los campos requeridos (\*) estén completos
-   El email sea válido (si aplica)
-   No haya caracteres especiales problemáticos

### P: Las imágenes no se ven

**R:** Ejecuta en terminal:

```
php artisan storage:link
```

### P: Olvidé mi contraseña

**R:** Contacta al administrador técnico para reset

---

## 📞 CONTACTO TÉCNICO

Para problemas técnicos contacta:

-   **Email:** soporte@hugoraul.com
-   **Teléfono:** +51 999 000 000

Para cambios de contenido:

-   Reporta errores en `/admin`
-   Usa el formulario de feedback (si existe)

---

**Fin de la Guía de Administración**

¡Gracias por administrar la plataforma de Hugo Raúl! 🙏

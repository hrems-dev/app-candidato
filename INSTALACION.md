# 🚀 MANUAL DE INSTALACIÓN Y CONFIGURACIÓN

## Página Web de Hugo Raúl - Juntos por el Perú

---

## 📋 REQUISITOS PREVIOS

Antes de instalar, asegúrate de tener:

### Software Obligatorio

-   **PHP 8.2+** (recomendado 8.3)
    -   Extensiones: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo
-   **MySQL 8.0+** o MariaDB 10.4+
-   **Composer 2.0+** (gestor de dependencias PHP)
-   **Node.js 18+** (para Vite y npm)
-   **Git** (control de versiones)

### Verificar Instalación

```powershell
# En PowerShell Windows
php -v
mysql --version
composer --version
node --version
npm --version
git --version
```

---

## 1️⃣ CLONAR EL REPOSITORIO

```powershell
# Ir a carpeta destino
cd C:\Users\tu_usuario

# Clonar repositorio
git clone https://github.com/tuusuario/app-candidato.git

# Entrar a la carpeta
cd app-candidato
```

---

## 2️⃣ INSTALAR DEPENDENCIAS PHP

```powershell
# Instalar dependencias de Laravel con Composer
composer install

# Esperar a que termine (puede tomar 2-3 minutos)
```

**Output esperado:**

```
Generating autoload files
48 packages installed successfully
```

---

## 3️⃣ CONFIGURAR ARCHIVO .ENV

### Paso 1: Copiar archivo de ejemplo

```powershell
copy .env.example .env
```

### Paso 2: Generar clave de aplicación

```powershell
php artisan key:generate
```

**Output esperado:**

```
Application key set successfully.
```

### Paso 3: Editar archivo .env

Abre `.env` en un editor de texto y configura:

```ini
# Identificador de la aplicación
APP_NAME="Hugo Raúl - Candidato"
APP_ENV=local
APP_KEY=base64:... (generado automáticamente)
APP_DEBUG=true
APP_URL=http://localhost:8000

# Base de Datos MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app_candidato      # CAMBIAR: nombre de BD
DB_USERNAME=root               # CAMBIAR: usuario MySQL
DB_PASSWORD=                    # CAMBIAR: contraseña MySQL

# Configuración de Correo (opcional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=tu_email@example.com
MAIL_PASSWORD=tu_contraseña
MAIL_FROM_ADDRESS=noreply@hugoraul.com

# Configuración de Sesiones
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

**⚠️ Importante:**

-   Cambiar `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` según tu configuración local

---

## 4️⃣ CREAR BASE DE DATOS

### En MySQL/MariaDB:

```sql
-- Opción 1: Desde MySQL Console
CREATE DATABASE app_candidato;
CREATE USER 'candidato_user'@'localhost' IDENTIFIED BY 'contraseña_segura';
GRANT ALL PRIVILEGES ON app_candidato.* TO 'candidato_user'@'localhost';
FLUSH PRIVILEGES;
```

### O mediante phpMyAdmin (interfaz gráfica):

1. Abre http://localhost/phpmyadmin
2. Click en "+ Nueva"
3. Nombre: `app_candidato`
4. Click en "Crear"

**Actualizar .env:**

```ini
DB_DATABASE=app_candidato
DB_USERNAME=candidato_user
DB_PASSWORD=contraseña_segura
```

---

## 5️⃣ EJECUTAR MIGRACIONES

Las migraciones crean todas las tablas automáticamente:

```powershell
# Ejecutar migraciones
php artisan migrate

# Con datos iniciales (seeders)
php artisan migrate:seed
```

**Output esperado:**

```
Migration table created successfully.
Migrating: 2025_11_22_000001_create_biografias_table
Migrating: 2025_11_22_000002_create_trayectorias_table
...
Database seeding completed successfully.
```

**Tablas creadas:**

-   users
-   biografias
-   trayectorias
-   actividades
-   noticias
-   citas
-   mensajes_contacto
-   propuestas

---

## 6️⃣ CREAR ENLACE SIMBÓLICO (Storage)

Necesario para que funcionen las descargas de imágenes:

```powershell
# Crear symlink de storage a public
php artisan storage:link

# En Windows, si da error, usa:
php artisan storage:link --relative
```

**Output esperado:**

```
The [public/storage] directory has been linked.
```

**Resultado:**

-   Se crea carpeta `public/storage` → `storage/app/public`
-   Las imágenes serán accesibles en `http://localhost:8000/storage/...`

---

## 7️⃣ INSTALAR DEPENDENCIAS JAVASCRIPT

```powershell
# Instalar dependencias npm
npm install

# Compilar assets (CSS, JS)
npm run build

# O modo desarrollo (con watch)
npm run dev
```

**Output esperado:**

```
added XXX packages
VITE v5.0.0 built in XXms
```

---

## 8️⃣ INICIAR EL SERVIDOR

### Opción 1: Servidor Local de Laravel (Recomendado)

```powershell
# Terminal 1: Iniciar servidor PHP
php artisan serve

# Output:
# INFO  Server running on [http://127.0.0.1:8000]
```

Abre en navegador: **http://localhost:8000**

### Opción 2: Apache/Nginx (Producción)

Configurar VirtualHost en Apache:

```apache
<VirtualHost *:80>
    ServerName hugoraul.local
    DocumentRoot "C:\xampp\htdocs\app-candidato\public"

    <Directory "C:\xampp\htdocs\app-candidato\public">
        AllowOverride All
        Require all granted
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule ^ index.php [QSA,L]
    </Directory>
</VirtualHost>
```

---

## 9️⃣ CUENTAS DE PRUEBA (Seeder)

El `DatabaseSeeder` crea automáticamente:

### Cuenta Admin

```
Email:    admin@hugoraul.com
Password: admin123456
```

### Cuenta Usuario

```
Email:    juan@example.com
Password: user123456
```

### Datos Iniciales

-   1 Biografía
-   3 Trayectorias
-   3 Actividades
-   3 Noticias
-   5 Propuestas

---

## 🔟 VERIFICACIÓN: LISTA DE COMPROBACIÓN

Completa cada paso:

-   [ ] PHP 8.2+ instalado
-   [ ] MySQL/MariaDB en ejecución
-   [ ] Composer ejecutado (`composer install`)
-   [ ] Archivo `.env` configurado con credenciales BD
-   [ ] Clave de app generada (`php artisan key:generate`)
-   [ ] Base de datos creada
-   [ ] Migraciones ejecutadas (`php artisan migrate:seed`)
-   [ ] Storage linked (`php artisan storage:link`)
-   [ ] Dependencias npm instaladas (`npm install`)
-   [ ] Assets compilados (`npm run build`)
-   [ ] Servidor iniciado (`php artisan serve`)
-   [ ] Página accesible en http://localhost:8000
-   [ ] Login funciona con admin@hugoraul.com / admin123456

---

## 🎯 ACCESO A LA APLICACIÓN

### Página Pública

```
http://localhost:8000/
```

### Panel Admin (requiere login)

```
http://localhost:8000/admin/dashboard

Usuario: admin@hugoraul.com
Contraseña: admin123456
```

### Rutas Públicas Disponibles

```
http://localhost:8000/biografia         # Biografía del candidato
http://localhost:8000/trayectoria       # Experiencia profesional
http://localhost:8000/propuestas        # Propuestas electorales
http://localhost:8000/actividades       # Actividades públicas
http://localhost:8000/noticias          # Noticias y comunicados
http://localhost:8000/contacto          # Formulario de contacto
http://localhost:8000/citas             # Solicitar cita legal
```

---

## 🛠️ COMANDOS ÚTILES

### Desarrollo

```powershell
# Iniciar servidor de desarrollo
php artisan serve

# Ejecutar migraciones
php artisan migrate

# Rollback última migración
php artisan migrate:rollback

# Resetear BD completa
php artisan migrate:refresh --seed

# Ejecutar seeders
php artisan db:seed

# Seeder específico
php artisan db:seed --class=DatabaseSeeder

# Compilar assets
npm run dev

# Compilar assets (producción)
npm run build

# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Administración

```powershell
# Ver todas las rutas
php artisan route:list

# Crear usuario nuevo
php artisan tinker
# > User::create(['name' => 'Nuevo Usuario', 'email' => 'nuevo@example.com',
#                 'password' => bcrypt('password'), 'role' => 'user'])

# Ver estado de la app
php artisan about

# Ejecutar tests
./vendor/bin/pest
```

---

## ⚠️ SOLUCIÓN DE PROBLEMAS

### Problema: "No such file or directory" en composer install

**Solución:**

```powershell
# Limpiar cache de Composer
composer clear-cache
composer install
```

### Problema: Error en base de datos "Access Denied"

**Solución:**

```powershell
# Verificar credenciales en .env
# Verificar usuario MySQL existe:
mysql -u root -p
# > CREATE USER 'candidato_user'@'localhost' IDENTIFIED BY 'contraseña';
# > GRANT ALL PRIVILEGES ON app_candidato.* TO 'candidato_user'@'localhost';
```

### Problema: Storage link no funciona

**Solución:**

```powershell
# Ejecutar con flag --relative
php artisan storage:link --relative

# O borrar y recrear
rmdir /S public\storage
php artisan storage:link
```

### Problema: NPM dependencies error

**Solución:**

```powershell
# Limpiar node_modules
rmdir /S node_modules
npm cache clean --force
npm install
npm run dev
```

### Problema: "Column not found" en migraciones

**Solución:**

```powershell
# Resetear base de datos
php artisan migrate:refresh --seed

# O rollback completo
php artisan migrate:rollback --step=10
php artisan migrate --seed
```

### Problema: Puerto 8000 en uso

**Solución:**

```powershell
# Usar puerto diferente
php artisan serve --port=8001

# Ver qué proceso está usando puerto 8000
netstat -ano | findstr :8000

# Matar proceso (cambiar PID)
taskkill /PID 1234 /F
```

---

## 📊 ESTRUCTURA POST-INSTALACIÓN

Después de completar la instalación, tu carpeta debe verse así:

```
app-candidato/
├── app/                          # Código de la aplicación
│   ├── Http/Controllers/         # ✅ 8 Controladores
│   ├── Http/Middleware/          # ✅ AdminMiddleware
│   ├── Models/                   # ✅ 7 Modelos
│   └── Providers/
├── database/
│   ├── migrations/               # ✅ 8 Migraciones
│   └── seeders/                  # ✅ DatabaseSeeder
├── resources/
│   ├── views/                    # ✅ 26+ Vistas Blade
│   ├── css/
│   └── js/
├── routes/                       # ✅ web.php configurado
├── storage/
│   └── app/public/               # ✅ Carpetas de subida
├── public/
│   ├── index.php                 # Punto de entrada
│   └── storage/                  # ✅ Symlink
├── .env                          # ✅ Configurado
├── composer.json                 # ✅ Dependencias PHP
├── package.json                  # ✅ Dependencias npm
└── vite.config.js                # ✅ Config Vite
```

---

## 🎓 PRÓXIMOS PASOS

### Después de la Instalación

1. **Explorar la aplicación:**

    - Accede a `http://localhost:8000`
    - Prueba las rutas públicas
    - Login con admin@hugoraul.com / admin123456

2. **Personalizar contenido:**

    - Va a `/admin/biografias/edit` para agregar biografía
    - Sube imágenes en cada módulo
    - Edita la información del candidato

3. **Agregar más contenido:**

    - Crear trayectorias laborales
    - Agregar propuestas políticas
    - Publicar noticias
    - Programar actividades

4. **Configurar correos (opcional):**

    - Actualizar MAIL\_\* en .env
    - Las citas pueden enviarse por email automáticamente

5. **Preparar para producción:**
    - Ver guía de DEPLOYMENT.md
    - Configurar SSL/HTTPS
    - Optimizar performance

---

## 📞 SOPORTE Y REFERENCIAS

### Documentación Oficial

-   [Laravel 11 Docs](https://laravel.com/docs/11.x)
-   [Tailwind CSS Docs](https://tailwindcss.com/docs)
-   [Vite.js Docs](https://vitejs.dev)

### Archivos Importantes

-   `DOCUMENTACION_TECNICA.md` - Arquitectura detallada
-   `ADMIN_GUIDE.md` - Guía de uso del panel admin
-   `.env.example` - Variables de configuración disponibles

---

**Instalación completada exitosamente 🎉**

¡Tu aplicación está lista para usar!

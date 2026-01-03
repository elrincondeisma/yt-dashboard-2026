# 📦 Guía de Instalación Detallada

Esta guía te ayudará a instalar el Dashboard Ecommerce paso a paso.

## 🔍 Verificación de Requisitos

Antes de comenzar, verifica que tienes instalado:

```bash
# Verificar PHP (debe ser >= 8.2)
php -v

# Verificar Composer
composer --version

# Verificar Node.js (debe ser >= 18.x)
node -v

# Verificar NPM
npm -v
```

## 🚀 Instalación Automática

### Linux / macOS

```bash
# 1. Clonar el repositorio
git clone https://github.com/tu-usuario/dashboard.git
cd dashboard

# 2. Dar permisos de ejecución al script
chmod +x install.sh

# 3. Ejecutar el script de instalación
./install.sh
```

### Windows (Git Bash o WSL)

```bash
# 1. Clonar el repositorio
git clone https://github.com/tu-usuario/dashboard.git
cd dashboard

# 2. Ejecutar el script
bash install.sh
```

## 📝 Instalación Manual

Si prefieres instalar manualmente o el script no funciona:

### Paso 1: Instalar Dependencias de Composer

```bash
composer install --no-interaction --prefer-dist --optimize-autoloader
```

### Paso 2: Configurar Variables de Entorno

Crea un archivo `.env` en la raíz del proyecto con el siguiente contenido:

```env
APP_NAME="Dashboard Ecommerce"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost
APP_LOCALE=es
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=es_ES

LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

SESSION_DRIVER=database
SESSION_LIFETIME=120

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

VITE_APP_NAME="${APP_NAME}"
```

### Paso 3: Generar Clave de Aplicación

```bash
php artisan key:generate
```

### Paso 4: Crear Base de Datos

```bash
# Para SQLite (por defecto)
touch database/database.sqlite

# O configurar MySQL/PostgreSQL en .env y crear la base de datos manualmente
```

### Paso 5: Ejecutar Migraciones

```bash
php artisan migrate:fresh
```

### Paso 6: Ejecutar Seeders

```bash
php artisan db:seed
```

Esto creará:
- Usuario administrador: `admin@admin.com` / `password`
- 5 categorías: Informática, Coches, Bienestar, Salud, Ocio
- 50 productos distribuidos en las categorías
- 55 clientes (distribuidos desde enero 2025)
- Pedidos, pagos, carritos y más datos de prueba

### Paso 7: Instalar Dependencias de NPM

```bash
npm install
```

### Paso 8: Compilar Assets

```bash
# Para desarrollo (con hot reload)
npm run dev

# Para producción
npm run build
```

### Paso 9: Crear Enlace de Storage (Opcional)

```bash
php artisan storage:link
```

## 🎯 Verificar Instalación

1. Inicia el servidor:
   ```bash
   php artisan serve
   ```

2. Abre tu navegador en: `http://localhost:8000/admin`

3. Inicia sesión con:
   - **Email**: `admin@admin.com`
   - **Password**: `password`

4. Deberías ver el dashboard con:
   - 4 tarjetas de estadísticas
   - 4 gráficos interactivos
   - Datos desde enero 2025

## 🔧 Solución de Problemas

### Error: "SQLSTATE[HY000] [14] unable to open database file"

**Solución**: Asegúrate de que el archivo `database/database.sqlite` existe y tiene permisos de escritura:
```bash
touch database/database.sqlite
chmod 664 database/database.sqlite
```

### Error: "Class 'PDO' not found"

**Solución**: Instala la extensión PDO de SQLite:
```bash
# Ubuntu/Debian
sudo apt-get install php-sqlite3

# macOS (Homebrew)
brew install php@8.2
```

### Error: "npm: command not found"

**Solución**: Instala Node.js y NPM desde [nodejs.org](https://nodejs.org/)

### Error al compilar assets

**Solución**: 
```bash
# Limpiar caché de npm
rm -rf node_modules package-lock.json
npm install
npm run build
```

### Error: "The stream or file could not be opened"

**Solución**: Asegúrate de que los directorios de storage tienen permisos:
```bash
chmod -R 775 storage bootstrap/cache
```

## 🌐 Configuración para Producción

1. Cambia `APP_ENV=production` y `APP_DEBUG=false` en `.env`
2. Genera una nueva clave: `php artisan key:generate`
3. Optimiza la aplicación:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
4. Compila assets para producción:
   ```bash
   npm run build
   ```
5. Cambia las credenciales del administrador
6. Configura una base de datos más robusta (MySQL/PostgreSQL)

## 📚 Recursos Adicionales

- [Documentación de Laravel](https://laravel.com/docs)
- [Documentación de Filament](https://filamentphp.com/docs)
- [Documentación de Tailwind CSS](https://tailwindcss.com/docs)

## ✅ Checklist de Instalación

- [ ] PHP >= 8.2 instalado
- [ ] Composer instalado
- [ ] Node.js >= 18.x instalado
- [ ] Repositorio clonado
- [ ] Dependencias de Composer instaladas
- [ ] Archivo `.env` configurado
- [ ] Clave de aplicación generada
- [ ] Base de datos creada
- [ ] Migraciones ejecutadas
- [ ] Seeders ejecutados
- [ ] Dependencias de NPM instaladas
- [ ] Assets compilados
- [ ] Servidor iniciado
- [ ] Acceso al panel verificado

¡Listo! Tu Dashboard Ecommerce está instalado y funcionando. 🎉


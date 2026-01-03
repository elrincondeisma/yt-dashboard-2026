# 🛒 Dashboard Ecommerce

Sistema de gestión de ecommerce desarrollado con Laravel 12 y Filament 4, que incluye gestión completa de productos, pedidos, clientes, inventario y análisis de ventas.

## 📋 Requisitos Previos

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.x
- **NPM** >= 9.x
- **SQLite** (incluido en PHP) o MySQL/PostgreSQL

## 🚀 Instalación Rápida

### Opción 1: Script Automático (Recomendado)

```bash
# Clonar el repositorio
git clone https://github.com/tu-usuario/dashboard.git
cd dashboard

# Ejecutar script de instalación
./install.sh
```

El script automáticamente:
- ✅ Instala dependencias de Composer
- ✅ Crea archivo `.env`
- ✅ Genera clave de aplicación
- ✅ Crea base de datos SQLite
- ✅ Ejecuta migraciones
- ✅ Ejecuta seeders (con datos de prueba)
- ✅ Instala dependencias de NPM
- ✅ Compila assets

### Opción 2: Instalación Manual

```bash
# 1. Clonar el repositorio
git clone https://github.com/tu-usuario/dashboard.git
cd dashboard

# 2. Instalar dependencias de Composer
composer install

# 3. Crear archivo .env
cp .env.example .env
# O crear manualmente con las configuraciones básicas

# 4. Generar clave de aplicación
php artisan key:generate

# 5. Crear base de datos SQLite
touch database/database.sqlite

# 6. Ejecutar migraciones y seeders
php artisan migrate:fresh --seed

# 7. Instalar dependencias de NPM
npm install

# 8. Compilar assets
npm run build

# 9. Crear enlace simbólico de storage (opcional)
php artisan storage:link
```

## 🔐 Credenciales de Acceso

Después de la instalación, puedes acceder al panel de administración con:

- **URL**: `http://localhost:8000/admin`
- **Email**: `admin@admin.com`
- **Password**: `password`

⚠️ **Importante**: Cambia estas credenciales en producción.

## 🏃 Iniciar el Servidor

```bash
# Servidor de desarrollo
php artisan serve

# O usar el comando dev que incluye Vite, Queue, y Logs
composer run dev
```

Luego accede a: `http://localhost:8000/admin`

## 📦 Estructura del Proyecto

### Modelos Principales

- **Customer** - Clientes del ecommerce
- **Product** - Productos del catálogo
- **Category** - Categorías de productos
- **Order** - Pedidos realizados
- **OrderItem** - Items de cada pedido
- **Payment** - Pagos
- **Cart** - Carritos de compra
- **ShippingAddress** - Direcciones de envío
- **Stock** - Control de inventario

### Características

- ✅ Panel de administración con Filament 4
- ✅ Dashboard con gráficos interactivos
- ✅ Gestión completa de productos y categorías
- ✅ Sistema de pedidos y pagos
- ✅ Control de inventario
- ✅ Análisis de ventas y estadísticas
- ✅ Filtros de fecha en tiempo real
- ✅ Datos de prueba desde enero 2025

## 🧪 Testing

```bash
# Ejecutar tests
php artisan test

# O con Pest directamente
./vendor/bin/pest
```

## 📝 Configuración Adicional

### Cambiar Base de Datos

Si prefieres usar MySQL o PostgreSQL, edita el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dashboard
DB_USERNAME=root
DB_PASSWORD=tu_password
```

### Variables de Entorno Importantes

```env
APP_NAME="Dashboard Ecommerce"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost
APP_LOCALE=es
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

## 🛠️ Comandos Útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Reejecutar migraciones y seeders
php artisan migrate:fresh --seed

# Compilar assets en desarrollo
npm run dev

# Compilar assets para producción
npm run build

# Ejecutar Pint (formateador de código)
./vendor/bin/pint
```

## 📚 Tecnologías Utilizadas

- **Laravel 12** - Framework PHP
- **Filament 4** - Panel de administración
- **Livewire 3** - Componentes interactivos
- **Tailwind CSS 4** - Estilos
- **Chart.js** - Gráficos
- **SQLite** - Base de datos (por defecto)
- **Pest** - Testing framework

## 📄 Licencia

Este proyecto está bajo la licencia MIT.

## 🤝 Contribuir

Las contribuciones son bienvenidas. Por favor:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📞 Soporte

Si tienes preguntas o problemas, por favor abre un issue en el repositorio.

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

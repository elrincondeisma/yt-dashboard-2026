#!/bin/bash

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}  Instalación del Dashboard Ecommerce${NC}"
echo -e "${GREEN}========================================${NC}"
echo ""

# Verificar que PHP está instalado
if ! command -v php &> /dev/null; then
    echo -e "${RED}❌ PHP no está instalado. Por favor instala PHP 8.2 o superior.${NC}"
    exit 1
fi

# Verificar que Composer está instalado
if ! command -v composer &> /dev/null; then
    echo -e "${RED}❌ Composer no está instalado. Por favor instala Composer.${NC}"
    exit 1
fi

# Verificar que Node.js está instalado
if ! command -v node &> /dev/null; then
    echo -e "${RED}❌ Node.js no está instalado. Por favor instala Node.js.${NC}"
    exit 1
fi

# Verificar que NPM está instalado
if ! command -v npm &> /dev/null; then
    echo -e "${RED}❌ NPM no está instalado. Por favor instala NPM.${NC}"
    exit 1
fi

echo -e "${YELLOW}📦 Instalando dependencias de Composer...${NC}"
composer install --no-interaction --prefer-dist --optimize-autoloader

if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Error al instalar dependencias de Composer${NC}"
    exit 1
fi
echo -e "${GREEN}✅ Dependencias de Composer instaladas${NC}"
echo ""

# Crear archivo .env si no existe
if [ ! -f .env ]; then
    echo -e "${YELLOW}📝 Creando archivo .env...${NC}"
    if [ -f .env.example ]; then
        cp .env.example .env
        echo -e "${GREEN}✅ Archivo .env creado desde .env.example${NC}"
    else
        echo -e "${YELLOW}⚠️  .env.example no encontrado, creando .env básico...${NC}"
        touch .env
        echo "APP_NAME=Dashboard" >> .env
        echo "APP_ENV=local" >> .env
        echo "APP_KEY=" >> .env
        echo "APP_DEBUG=true" >> .env
        echo "APP_URL=http://localhost" >> .env
        echo "" >> .env
        echo "DB_CONNECTION=sqlite" >> .env
        echo "DB_DATABASE=database/database.sqlite" >> .env
        echo "" >> .env
        echo "LOG_CHANNEL=stack" >> .env
        echo "LOG_LEVEL=debug" >> .env
    fi
else
    echo -e "${GREEN}✅ Archivo .env ya existe${NC}"
fi
echo ""

# Generar clave de aplicación
echo -e "${YELLOW}🔑 Generando clave de aplicación...${NC}"
php artisan key:generate --force

if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Error al generar la clave de aplicación${NC}"
    exit 1
fi
echo -e "${GREEN}✅ Clave de aplicación generada${NC}"
echo ""

# Crear base de datos SQLite si no existe
if [ ! -f database/database.sqlite ]; then
    echo -e "${YELLOW}💾 Creando base de datos SQLite...${NC}"
    touch database/database.sqlite
    echo -e "${GREEN}✅ Base de datos SQLite creada${NC}"
else
    echo -e "${GREEN}✅ Base de datos SQLite ya existe${NC}"
fi
echo ""

# Ejecutar migraciones
echo -e "${YELLOW}🗄️  Ejecutando migraciones...${NC}"
php artisan migrate:fresh --force

if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Error al ejecutar migraciones${NC}"
    exit 1
fi
echo -e "${GREEN}✅ Migraciones ejecutadas${NC}"
echo ""

# Ejecutar seeders
echo -e "${YELLOW}🌱 Ejecutando seeders...${NC}"
php artisan db:seed --force

if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Error al ejecutar seeders${NC}"
    exit 1
fi
echo -e "${GREEN}✅ Seeders ejecutados${NC}"
echo ""

# Instalar dependencias de NPM
echo -e "${YELLOW}📦 Instalando dependencias de NPM...${NC}"
npm install

if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Error al instalar dependencias de NPM${NC}"
    exit 1
fi
echo -e "${GREEN}✅ Dependencias de NPM instaladas${NC}"
echo ""

# Compilar assets
echo -e "${YELLOW}🎨 Compilando assets...${NC}"
npm run build

if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Error al compilar assets${NC}"
    exit 1
fi
echo -e "${GREEN}✅ Assets compilados${NC}"
echo ""

# Crear enlace simbólico de storage
echo -e "${YELLOW}🔗 Creando enlace simbólico de storage...${NC}"
php artisan storage:link

if [ $? -ne 0 ]; then
    echo -e "${YELLOW}⚠️  El enlace de storage ya existe o no es necesario${NC}"
fi
echo ""

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}  ✅ Instalación completada con éxito${NC}"
echo -e "${GREEN}========================================${NC}"
echo ""
echo -e "${YELLOW}📋 Credenciales de acceso:${NC}"
echo -e "   Email: ${GREEN}admin@admin.com${NC}"
echo -e "   Password: ${GREEN}password${NC}"
echo ""
echo -e "${YELLOW}🚀 Para iniciar el servidor:${NC}"
echo -e "   ${GREEN}php artisan serve${NC}"
echo ""
echo -e "${YELLOW}🌐 Accede al panel de administración:${NC}"
echo -e "   ${GREEN}http://localhost:8000/admin${NC}"
echo ""


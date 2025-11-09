# Pastelería

Sistema completo para gestionar pasteles e ingredientes mediante un CRUD funcional. Utiliza Laravel 12 (PHP 8.3) en el backend, Vue 3 con Vite en el frontend y MySQL 8.0 como base de datos. El entorno está dockerizado para facilitar su despliegue.

## Características

- CRUD completo de Pasteles con relación many-to-many a Ingredientes
- CRUD completo de Ingredientes
- API RESTful con Laravel
- Interfaz con Vue 3
- Validaciones en backend y frontend
- Manejo de errores con alertas al usuario
- Dockerizado (MySQL, Laravel y Vite)
- CORS configurado

## Requisitos

- Docker y Docker Compose instalados
- Puertos disponibles: 3307 (MySQL), 9000 (Laravel), 5173 (Vite)

## Estructura del repositorio

```
.env                # Variables de entorno para el backend
db_script.sql       # Script SQL para crear la base de datos manualmente
docker-compose.yml  # Orquestación de servicios Docker
Dockerfile          # Construye la imagen de la aplicación PHP/Laravel
README.md           # Este archivo

backend/            # Código del backend Laravel
  composer.json     # Dependencias de PHP
  app/              # Modelos y controladores
  database/         # Migraciones y seeders
  routes/api.php    # Definición de rutas API

frontend/           # Código del frontend Vue
  package.json      # Dependencias de JavaScript
  vite.config.js    # Configuración de Vite
  index.html        # Archivo HTML raíz
  src/              # Componentes y configuración del frontend
    components/     # Componentes de Vue para pasteles e ingredientes
    router/         # Configuración de rutas en Vue
    App.vue         # Componente principal
    main.js         # Punto de entrada de la aplicación
```

## Puesta en marcha

### Con Docker

1. Clona el repositorio y ubicate en la raíz del proyecto:
   cd pasteleria

2. Levanta los contenedores:
   docker-compose up -d
   
   Esto iniciara:
   - Contenedor `db`: MySQL 8.0 en puerto 3307 con la base de datos `pasteleria`
   - Contenedor `app`: Laravel API en puerto 9000

3. Genera la clave de aplicación de Laravel:
   docker-compose exec app php artisan key:generate

4. Ejecuta las migraciones y seeders:
   docker-compose exec app php artisan migrate --seed

5. Instala dependencias del frontend (en otra terminal):
   cd frontend
   npm install
   npm run dev

6. Accede a la aplicación:
   - Frontend: `http://localhost:5173`
   - API: `http://localhost:9000/api/pasteles` o `http://localhost:9000/api/ingredientes`

### Sin Docker

1. Configura MySQL localmente y crea la base de datos:
   CREATE DATABASE pasteleria

2. Backend:
   cd backend
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --seed
   php artisan serve --port=9000

3. Frontend:
   cd frontend
   npm install
   npm run dev

## Uso de la aplicación

### Funcionalidades

**Ingredientes:**
- Crear nuevo ingrediente con nombre, descripción y fechas
- Editar ingredientes existentes
- Eliminar ingredientes (se desvinculan de pasteles automáticamente)
- Listar todos los ingredientes

**Pasteles:**
- Crear nuevo pastel con múltiples ingredientes
- Editar pasteles y sus ingredientes asociados
- Eliminar pasteles (elimina también las relaciones)
- Listar pasteles con sus ingredientes
# Lintic - Sistema de Gestión de Productos y Órdenes

Este es un proyecto de comercio electrónico simplificado utilizando **Laravel** como backend y **React.js** como frontend. La aplicación permite gestionar productos y órdenes de los clientes, incluyendo funciones para crear, editar, eliminar y visualizar productos y órdenes.

## Tecnologías utilizadas

### Backend
- **Laravel 10** (Framework PHP)
- **MySQL** (Base de datos)
- **Postman** (Para pruebas API)

### Frontend
- **React.js** (Librería de JavaScript)
- **Axios** (Cliente HTTP para consumir la API)
- **Bootstrap** (Para diseño responsivo)

## Requisitos

Para ejecutar este proyecto en tu entorno local, asegúrate de tener instalados los siguientes requisitos:

### Backend (Laravel)
- **PHP 8.1+**
- **Composer** (Gestor de dependencias para PHP)
- **MySQL** o cualquier base de datos compatible con Laravel

### Frontend (React)
- **Node.js** (versión 16 o superior)
- **npm** o **yarn** (Gestor de paquetes para JavaScript)

## Instalación

### 1. Backend

#### Paso 1.1: Clonar el repositorio

```bash
git clone https://github.com/tu_usuario/lintic.git
cd lintic

Paso 1.2: Configurar el archivo .env

Copia el archivo .env.example a .env y configura las credenciales de la base de datos.

cp .env.example .env

Edita el archivo .env y configura los detalles de la base de datos:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lintic
DB_USERNAME=root
DB_PASSWORD=

Paso 1.3: Instalar las dependencias de Laravel

composer install

Paso 1.4: Migrar la base de datos

php artisan migrate

Paso 1.5: Levantar el servidor de desarrollo

php artisan serve

Esto levantará el servidor de Laravel en http://localhost:8000.
2. Frontend
Paso 2.1: Clonar el repositorio frontend

Dentro del directorio raíz del proyecto (donde se encuentra la carpeta de Laravel), clona el repositorio frontend o ve al directorio correspondiente.

cd frontend

Paso 2.2: Instalar dependencias

npm install

Paso 2.3: Configurar la API en el frontend

Asegúrate de que la URL de la API de Laravel esté configurada correctamente en los archivos donde se realizan las solicitudes HTTP (por ejemplo, en el archivo Orders.js).

const API_URL = 'http://lintic.test/api/orders'; // Asegúrate de usar la URL correcta de tu backend

Paso 2.4: Levantar el servidor de desarrollo

npm start

Esto levantará el servidor de React en http://localhost:3000.
Funcionalidades
1. Gestión de Productos

    Crear Producto: Los administradores pueden crear nuevos productos desde el frontend.
    Ver Productos: Los usuarios pueden ver la lista de productos disponibles.
    Editar Producto: Los administradores pueden editar productos existentes.
    Eliminar Producto: Los administradores pueden eliminar productos.

2. Gestión de Órdenes

    Crear Orden: Los administradores pueden crear nuevas órdenes desde el frontend.
    Ver Órdenes: Los administradores pueden ver todas las órdenes creadas.
    Eliminar Orden: Los administradores pueden eliminar órdenes.

Rutas API
Productos

    GET /api/products: Obtiene la lista de productos.
    GET /api/products/{id}: Obtiene los detalles de un producto específico.
    POST /api/products: Crea un nuevo producto.
    PUT /api/products/{id}: Actualiza un producto existente.
    DELETE /api/products/{id}: Elimina un producto.

Órdenes

    GET /api/orders: Obtiene la lista de órdenes.
    GET /api/orders/{id}: Obtiene los detalles de una orden específica.
    POST /api/orders: Crea una nueva orden.
    DELETE /api/orders/{id}: Elimina una orden.

Pruebas
Backend

Para realizar pruebas en el backend, puedes utilizar PHPUnit:

php artisan test

Frontend

Para realizar pruebas en el frontend, puedes usar la herramienta React Testing Library o Jest si ya has configurado pruebas para tu aplicación React.
Contribución

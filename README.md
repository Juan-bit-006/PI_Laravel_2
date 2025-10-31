# 💇‍♀️ Sistema de Reservas - Peluquería Alejandra C

Este proyecto es un sistema de gestión y reservas desarrollado con **Laravel**, que permite administrar clientes, empleados, servicios y reservas de una peluquería.  
Incluye funcionalidades de autenticación, roles, exportación de datos en PDF y búsquedas dinámicas con AJAX.


# ⚙️ Instalación del Proyecto

## 📋 Requisitos previos

Antes de comenzar, asegúrate de tener instaladas las siguientes herramientas:

- PHP 8.1 o superior  
- Composer  
- MySQL  
- Node.js y npm  
- Git

---

## 🚀 Pasos para instalar el sistema

### 1️⃣ Clonar el repositorio

git clone https://github.com/Juan-bit-006/PI_Laravel_2.git
cd PI_Laravel_2



---

### 2️⃣ Crear y configurar el archivo `.env`

Edita el archivo `.env` con tus valores locales (puedes hacerlo con tu editor de texto preferido):

APP_NAME="Peluquería Alejandra C"

APP_ENV=local

APP_KEY=

APP_DEBUG=true

APP_URL=http://127.0.0.1:8000

#


DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3305

DB_DATABASE=peluqueria

DB_USERNAME=root

DB_PASSWORD=



---

### 3️⃣ Instalar dependencias de Laravel
- composer install

---

### 4️⃣ Instalar dependencias de Node 
- npm install
- npm run dev

---

### 5️⃣ Generar la clave de aplicación
- php artisan key:generate

---

### 6️⃣ Ejecutar las migraciones de la base de datos
- php artisan migrate

## Creacion de Usuario desde php artisn Tinker:
php artisan tinker

    use App\Models\User::create([
    
    'name' => 'Admin',
    
    'email' => 'admin@peluqueria.com',
   
    'password' => $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi, // Eso es contraseña 'password'
    
    'role' => 'admin',
     ]);

---

### 7️⃣ Levantar el servidor local
- php artisan serve

Una vez iniciado, abre en tu navegador:  
👉 [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 💇‍♀️ Proyecto: Peluquería Alejandra C

Este sistema de gestión permite administrar citas, clientes y servicios de la peluquería de forma sencilla y eficiente.

## Instalar DomPDF para exportar a PDF
- composer require barryvdh/laravel-dompdf

## Instalar Livewire (interfaz reactiva)
- composer require livewire/livewire

## Instalar Breeze (sistema de autenticación simple)
- composer require laravel/breeze --dev
- php artisan breeze:install

## Instalar Tinker (consola interactiva)
- composer require laravel/tinker

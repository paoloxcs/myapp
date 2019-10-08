# Guia para ejecutar el proyecto

## Paso 1 : Clonar el repositorio y configura el proyecto

`git clone https://github.com/paoloxcs/myapp.git`

copia el archivo `.env.example` como `.env`

`cp .env.example .env`

Genera la llave

`php artisan key:generate`

## Paso 2: Instalar las dependecias

`composer update`

## Paso 3: Crear la base de datos y ejecutar la migracion

Cree una base de datos, ejemplo: `db_name` 

Ejecuta de la migración 

`php artisan migrate`

## Cree datos semilla

`php artisan db:seed`

Nota: el password del usuario sera `secret`






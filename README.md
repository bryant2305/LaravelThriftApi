
Clonar proyecto

composer install

Clonar el archivo .env.example y renombrarlo a .env

Cambiar las variables de entorno

crear la base de datos

php artisan migrate

correr los seeders : php artisan migrate:fresh --seed

Levantar: php:artisan serve 


OJO CON LOS PERMISOS , SOLO EL USUARIO ADMIN TIENE PERMISO DE HACER TODO , 
EL USUARIO NORMAL SOLO TIENE PERMISO DE LEER 
( EL ADMIN PUEDE CONVERTIR EN ADMIN A UN USUARIO NORMAL)

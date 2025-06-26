# LaravelThriftApi

API RESTful construida con Laravel para la gestión de usuarios, roles y permisos.

## Descripción
Este proyecto proporciona una API para administrar usuarios, roles y permisos, con un sistema de autenticación y autorización. Incluye endpoints protegidos y diferenciación de permisos entre usuarios administradores y normales.

## Requisitos previos
- PHP >= 8.0
- Composer
- MySQL o MariaDB
- Docker y Docker Compose (opcional)

## Instalación

1. Clona el repositorio:
   ```bash
   git clone <url-del-repositorio>
   cd LaravelThriftApi
   ```
2. Instala las dependencias:
   ```bash
   composer install
   ```
3. Copia el archivo de entorno y configúralo:
   ```bash
   cp .env.example .env
   ```
   Modifica las variables de entorno según tu configuración local.
4. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```
5. Crea la base de datos y actualiza la configuración en `.env`.
6. Ejecuta las migraciones y seeders:
   ```bash
   php artisan migrate --seed
   # o para reiniciar y poblar desde cero
   php artisan migrate:fresh --seed
   ```
7. Levanta el servidor de desarrollo:
   ```bash
   php artisan serve
   ```

## Uso con Docker

1. Levanta los servicios:
   ```bash
   docker-compose up
   ```

## Sistema de permisos
- **Administrador:** Acceso total a todos los endpoints y funcionalidades. Puede convertir usuarios normales en administradores.
- **Usuario normal:** Solo tiene permisos de lectura.

## Ejecución de tests
Para correr los tests:
```bash
php artisan test
```

## Notas
- Asegúrate de que los permisos de los archivos y carpetas sean correctos para evitar problemas de acceso.
- Consulta la documentación de la API generada en `/storage/api-docs` si está disponible.

## Contribución
¡Las contribuciones son bienvenidas! Abre un issue o un pull request para sugerencias o mejoras.


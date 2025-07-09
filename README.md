# 🏆 TecBet - Plataforma de Apuestas Deportivas

<div align="center">
  <img src="https://img.shields.io/badge/Laravel-12.0-red?style=for-the-badge&logo=laravel" alt="Laravel 12.0">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue?style=for-the-badge&logo=php" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/TailwindCSS-4.0-38B2AC?style=for-the-badge&logo=tailwind-css" alt="TailwindCSS 4.0">
  <img src="https://img.shields.io/badge/Vite-6.2-646CFF?style=for-the-badge&logo=vite" alt="Vite 6.2">
</div>

## 📋 Descripción

**TecBet** es una plataforma moderna de apuestas deportivas desarrollada con Laravel 12, diseñada para ofrecer una experiencia de usuario excepcional con funcionalidades avanzadas de gestión de apuestas, eventos deportivos y administración completa.

### 🎯 Características Principales

- **🎮 Sistema de Apuestas Completo**: Apuestas 1x2, primer gol, ambos marcan
- **⚽ Gestión de Eventos Deportivos**: Creación y administración de partidos
- **💰 Sistema de Depósitos**: Múltiples métodos de pago (Yape, Plin, BCP, Visa, etc.)
- **👤 Panel de Usuario**: Historial de apuestas, perfil personalizado
- **🔧 Panel Administrativo**: Gestión completa de eventos, tipos de apuestas y usuarios
- **📱 Diseño Responsivo**: Interfaz moderna y adaptable a todos los dispositivos
- **🔔 Sistema de Notificaciones**: Alertas en tiempo real
- **📊 Dashboard Analítico**: Estadísticas y reportes detallados

## 🚀 Tecnologías Utilizadas

### Backend
- **Laravel 12.0** - Framework PHP moderno
- **PHP 8.2+** - Lenguaje de programación
- **MySQL/PostgreSQL** - Base de datos
- **Laravel Sanctum** - Autenticación API

### Frontend
- **TailwindCSS 4.0** - Framework CSS utility-first
- **Vite 6.2** - Build tool moderno
- **Bootstrap 5** - Componentes UI
- **JavaScript ES6+** - Interactividad

### Herramientas de Desarrollo
- **Laravel Sail** - Entorno Docker
- **Laravel Pint** - Formateo de código
- **Pest PHP** - Testing framework
- **Laravel Pail** - Debugging avanzado

## 📦 Instalación

### Prerrequisitos

- PHP 8.2 o superior
- Composer 2.0+
- Node.js 18+ y npm
- MySQL 8.0+ o PostgreSQL 13+
- Git

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/tu-usuario/tecbet.git
cd tecbet
```

2. **Instalar dependencias PHP**
```bash
composer install
```

3. **Instalar dependencias Node.js**
```bash
npm install
```

4. **Configurar variables de entorno**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurar la base de datos en `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tecbet
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

6. **Ejecutar migraciones y seeders**
```bash
php artisan migrate
php artisan db:seed
```

7. **Compilar assets**
```bash
npm run build
```

8. **Configurar permisos de almacenamiento**
```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

## 🎮 Uso

### Comandos de Desarrollo

```bash
# Iniciar servidor de desarrollo
php artisan serve

# Compilar assets en modo desarrollo
npm run dev

# Compilar assets para producción
npm run build

# Ejecutar tests
php artisan test

# Ejecutar tests con Pest
./vendor/bin/pest

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimizar para producción
php artisan optimize
```

### Comandos de Base de Datos

```bash
# Crear nueva migración
php artisan make:migration nombre_migracion

# Ejecutar migraciones
php artisan migrate

# Revertir última migración
php artisan migrate:rollback

# Revertir todas las migraciones
php artisan migrate:reset

# Ejecutar seeders
php artisan db:seed

# Crear seeder
php artisan make:seeder NombreSeeder
```

### Comandos de Laravel

```bash
# Crear controlador
php artisan make:controller NombreController

# Crear modelo
php artisan make:model NombreModelo

# Crear modelo con migración
php artisan make:model NombreModelo -m

# Crear middleware
php artisan make:middleware NombreMiddleware

# Listar rutas
php artisan route:list

# Tinker (consola interactiva)
php artisan tinker
```

## 🏗️ Estructura del Proyecto

```
tecbet/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Controladores del panel admin
│   │   │   ├── AuthController.php
│   │   │   ├── BettingController.php
│   │   │   └── ...
│   │   └── Middleware/
│   ├── Models/                 # Modelos Eloquent
│   └── Policies/              # Políticas de autorización
├── database/
│   ├── migrations/            # Migraciones de BD
│   ├── seeders/              # Datos de prueba
│   └── factories/            # Factories para testing
├── resources/
│   ├── views/                # Vistas Blade
│   │   ├── admin/           # Panel administrativo
│   │   ├── betting/         # Vistas de apuestas
│   │   └── layouts/         # Layouts principales
│   ├── css/                 # Estilos CSS
│   └── js/                  # JavaScript
├── routes/
│   ├── web.php              # Rutas web
│   └── api.php              # Rutas API
└── public/                  # Archivos públicos
```

## 🔧 Configuración

### Variables de Entorno Importantes

```env
# Configuración de la aplicación
APP_NAME="TecBet"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Configuración de base de datos
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tecbet
DB_USERNAME=root
DB_PASSWORD=

# Configuración de correo
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

# Configuración de sesión
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

## 🧪 Testing

```bash
# Ejecutar todos los tests
php artisan test

# Ejecutar tests específicos
php artisan test --filter NombreTest

# Ejecutar tests con cobertura
php artisan test --coverage

# Ejecutar tests de Pest
./vendor/bin/pest

# Ejecutar tests en paralelo
./vendor/bin/pest --parallel
```

## 📊 Base de Datos

### Tablas Principales

- **users** - Usuarios del sistema
- **events** - Eventos deportivos
- **bets** - Apuestas realizadas
- **bet_types** - Tipos de apuestas disponibles
- **deposits** - Depósitos de usuarios
- **payment_methods** - Métodos de pago
- **announcements** - Anuncios del sistema
- **notifications** - Notificaciones

### Relaciones Principales

```php
// User -> Bet (1:N)
// Event -> Bet (1:N)
// BetType -> Bet (1:N)
// User -> Deposit (1:N)
// PaymentMethod -> Deposit (1:N)
```

## 🚀 Despliegue

### Producción

1. **Configurar servidor**
```bash
# Instalar dependencias de producción
composer install --optimize-autoloader --no-dev

# Compilar assets
npm run build

# Configurar permisos
chmod -R 755 storage bootstrap/cache
```

2. **Configurar supervisor (para colas)**
```bash
# Crear archivo de configuración
sudo nano /etc/supervisor/conf.d/tecbet-worker.conf
```

3. **Configurar cron jobs**
```bash
# Agregar al crontab
* * * * * cd /path/to/tecbet && php artisan schedule:run >> /dev/null 2>&1
```

### Docker (Laravel Sail)

```bash
# Iniciar con Docker
./vendor/bin/sail up

# Ejecutar comandos con Docker
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm run dev
```

## 🤝 Contribución

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📝 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 👥 Autores

- **Luis Alberto Flores** - *Desarrollo inicial* - [@tu-usuario](https://github.com/tu-usuario)

## 🙏 Agradecimientos

- Laravel Team por el excelente framework
- TailwindCSS por el sistema de diseño
- Comunidad de desarrolladores PHP

## 📞 Soporte

Si tienes alguna pregunta o necesitas ayuda:

- 📧 Email: soporte@tecbet.com
- 💬 Discord: [Servidor TecBet](https://discord.gg/tecbet)
- 📖 Documentación: [docs.tecbet.com](https://docs.tecbet.com)

---

<div align="center">
  <p>Hecho con ❤️ por el equipo de TecBet</p>
  <p>⭐ Si te gusta este proyecto, dale una estrella en GitHub</p>
</div> 
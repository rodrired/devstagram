<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

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

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

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


DEPLOYMENT EN DOMCLOUD
  # Copiar .env si no existe
  - '[ ! -f .env ] && cp .env.example .env || echo ".env already exists"'

  # Configurar DB y APP_URL
  - sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=mysql/g" .env
  - sed -i "s/DB_HOST=.*/DB_HOST=localhost/g" .env
  - sed -i "s/DB_PORT=.*/DB_PORT=3306/g" .env
  - sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DATABASE}/g" .env
  - sed -i "s/DB_USERNAME=.*/DB_USERNAME=${USERNAME}/g" .env
  - sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${PASSWORD}/g" .env
  - sed -i "s|APP_URL=.*|APP_URL=http://${DOMAIN}|g" .env

  # Instalar dependencias
  - composer install --no-interaction --optimize-autoloader
  - npm install
  - npm run build

  # Generar key si no existe
  - '[ ! -f .env ] && php artisan key:generate || echo "APP_KEY exists"'

  # Ejecutar migraciones de forma segura
  - php artisan migrate --force || echo "Migration skipped"

  # Crear link de storage
  - php artisan storage:link || echo "Storage link exists"

  # Publicar assets de Livewire (si usas)
  - php artisan livewire:publish || echo "Livewire assets exist"

    ACTUALIZAR MODIFICACIONES
   source: <TuRepositorio>

features:
  - mysql
  - ssl
  - ssl always

nginx:
  root: public_html/public
  fastcgi: on
  locations:
    - match: /
      try_files: $uri $uri/ /index.php$is_args$args
    - match: ~ \.[^\/]+(?<!\.php)$
      try_files: $uri =404

commands:
  - mkdir -p /home/rodrired-devstagram/public_html && cd $_
  
  # Obtener cambios del repo
  - git pull origin main || git clone <TuRepositorio> .

  # Configuración del .env
  - '[ ! -f .env ] && cp .env.example .env || echo ".env exists"'
  - sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=mysql/g" .env
  - sed -i "s/DB_HOST=.*/DB_HOST=localhost/g" .env
  - sed -i "s/DB_PORT=.*/DB_PORT=3306/g" .env
  - sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DATABASE}/g" .env
  - sed -i "s/DB_USERNAME=.*/DB_USERNAME=${USERNAME}/g" .env
  - sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${PASSWORD}/g" .env
  - sed -i "s|APP_URL=.*|APP_URL=http://${DOMAIN}|g" .env

  # Instalar dependencias PHP y JS
  - composer install --no-interaction --optimize-autoloader
  - npm install
  - npm run build

  # Clave de aplicación
  - '[ ! -f .env ] && php artisan key:generate || echo "APP_KEY exists"'

  # Migraciones
  - php artisan migrate --force || echo "Migrations skipped"

  # Storage y Livewire
  - php artisan storage:link || echo "Storage link exists"
  - php artisan livewire:publish || echo "Livewire assets exist"


  ACTUALIZAR CODIGO
  commands:
  # Copiar .env si no existe
  - '[ ! -f .env ] && cp .env.example .env || echo ".env already exists"'

  # Configurar DB y APP_URL
  - sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=mysql/g" .env
  - sed -i "s/DB_HOST=.*/DB_HOST=localhost/g" .env
  - sed -i "s/DB_PORT=.*/DB_PORT=3306/g" .env
  - sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DATABASE}/g" .env
  - sed -i "s/DB_USERNAME=.*/DB_USERNAME=${USERNAME}/g" .env
  - sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${PASSWORD}/g" .env
  - sed -i "s|APP_URL=.*|APP_URL=http://${DOMAIN}|g" .env

  # Instalar dependencias
  - composer install --no-interaction --optimize-autoloader
  - npm install
  - npm run build

  # Generar key si no existe
  - '[ ! -f .env ] && php artisan key:generate || echo "APP_KEY exists"'

  # Ejecutar migraciones de forma segura
  - php artisan migrate --force || echo "Migration skipped"

  # Crear link de storage
  - php artisan storage:link || echo "Storage link exists"

  # Publicar assets de Livewire (si usas)
  - php artisan livewire:publish || echo "Livewire assets exist"

  PARA ACTUALIZAR
  cd /home/rodrired-devstagram/public_html && git pull origin main



  DESPLIEGUE DESDE 0

source: https://github.com/rodrired/devstagram.git

features:
  - mysql
  - ssl
  - ssl always

nginx:
  root: public_html/public
  fastcgi: on
  locations:
    - match: /
      try_files: $uri $uri/ /index.php$is_args$args
    - match: ^/livewire/
      try_files: $uri /index.php$is_args$args
    - match: ~ \.[^\/]+(?<!\.php)$
      try_files: $uri =404

commands:
  - mkdir -p /home/rodrired-devstagram/public_html && cd $_

  # Limpiar cambios locales y actualizar repo
  - git reset --hard
  - git clean -fd
  - git pull origin main || git clone https://github.com/rodrired/devstagram.git .

  # Configuración del .env
  - '[ ! -f .env ] && cp .env.example .env || echo ".env exists"'
  - sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=mysql/g" .env
  - sed -i "s/DB_HOST=.*/DB_HOST=localhost/g" .env
  - sed -i "s/DB_PORT=.*/DB_PORT=3306/g" .env
  - sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DATABASE}/g" .env
  - sed -i "s/DB_USERNAME=.*/DB_USERNAME=${USERNAME}/g" .env
  - sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${PASSWORD}/g" .env
  - sed -i "s|APP_URL=.*|APP_URL=https://${DOMAIN}|g" .env
  - sed -i "s/APP_ENV=.*/APP_ENV=production/g" .env
  - sed -i "s/APP_DEBUG=.*/APP_DEBUG=false/g" .env
  - sed -i "s/VITE_DEV_SERVER=.*/VITE_DEV_SERVER=false/g" .env || echo "VITE_DEV_SERVER=false" >> .env

  # Dependencias PHP
  - composer install --no-interaction --optimize-autoloader --no-dev

  # Dependencias JS y build
  - cp -r vendor/livewire/livewire/dist public/livewire

  - npm ci
  - npm run build

  # Clave de app (no interactivo en prod)
  - php artisan key:generate --force || echo "APP_KEY exists"

  # Migraciones
  - php artisan migrate --force || echo "Migrations skipped"

  # Storage
  - php artisan storage:link || echo "Storage link exists"

  # Limpiar cachés
  - php artisan config:clear
  - php artisan route:clear
  - php artisan view:clear
  - php artisan cache:clear

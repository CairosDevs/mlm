## MLM

Aplicación para control y gestión de membresias y pagos de beneficios

## PROCESO DE INSTALACION

clone proyecto en su servidor o equipo local, ejecute los siguientes comandos

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve

npm install && npm run build

## CRONJOBS COLA DE CORREOS

en el servidor crear una entrada de cronjob con la siguiente informacion

* * * * * cd /path-to-your-project && php artisan queue:work --stop-when-empty >> /dev/null 2>&1


## BASE DE DATOS

editar en .env
personalizar los datos del configuracion de base de datos

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=XXXXX
DB_USERNAME=XXXXX
DB_PASSWORD=XXXXX

## SMTP

editar en .env
personalizar los datos del configuracion de SMTP

MAIL_MAILER=smtp
MAIL_HOST=XXXXXX
MAIL_PORT=XXXX
MAIL_USERNAME=XXXXX
MAIL_PASSWORD=XXXXXX
MAIL_ENCRYPTION=XXXXXX
MAIL_FROM_ADDRESS="hello@MLM.com"
MAIL_FROM_NAME="${APP_NAME}"

## CREDENCIALES DE PRUEBA

  tipo de usuario         email                       contraseña

-administrador           admin@mlm.com               password
-socio                   user@mlm.com                password

## Licencia

Es open-sourced software licenciado bajo [MIT license](https://opensource.org/licenses/MIT).

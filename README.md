##Description : 

Ini adalah backend (API dan Admin DAshboard) dari apliasi booking penginapan capsule-inn.

##Stacks : 
--Laravel 9.x
--PHP ^8.0


##STEPS : 

```sh
composer install
```

```sh
cp .env-example .env
```

```sh
php artisan key:generate
```

```sh
php artisan serve
```

-- Setup Databases : 

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=root
DB_PASSWORD=
```

-- Setup Mailtrap : 

```sh
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_NAME="${APP_NAME}"
MAIL_FROM_ADDRESS="no-reply@capsuleinn.id"
```

--To generate postman API DOcs Run :

```sh
php artisan export:postman --bearer="1|S5Tz6ScVcjO6zRPwLTGBHqMSkVIzjzrX9fuTLfDd"
```
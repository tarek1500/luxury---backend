# Social App
Mini social app Laravel project.

## Installation
Follow the following guide line to setup the project:

- Use composer dependency manager [Composer](https://getcomposer.org/) to install the API server dependencies.
```bash
composer install
```
- Copy **.env.example** file to **.env** on the root folder.
- Open your **.env** file and change **database**.
- Run the following command to generate a key for your project:
```bash
php artisan key:generate
```
- Run the following command for migrations:
```bash
php artisan migrate
```
- Run the following command for seeds:
```bash
php artisan db:seed
```
- You can use the following seeds to login:
```bash
tarek@domain.com
mohammed@domain.com
bob@domain.com
jack@domain.com

Password: 123456
```
- Run the following command to start the API server:
```bash
php artisan serve
```
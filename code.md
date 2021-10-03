php artisan make:model ... -m --> add model and migrations
php artisan migrate:rollback --> drop table
php artisan migrate --> run sql
php artisan make:controller ... --> add controller
php artisan serve --> start server

//install package Laravel in github
1: composer install
2: Copy .env.example file to .env on the root folder. You can type copy .env.example --> .env
3: Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
4: php artisan key:generate
5: php artisan migrate
6: php artisan serve

- Run command "composer install" if there is no vendor folder
- Token is generated using passport package
- documentation (https://laravel.com/docs/8.x/passport)
- Expiration period of tokens are set in AuthServiceProvider to 30 days
- physically create db "cb_test"
- use command "php artisan migrate --seed" to migrate to DB and seed
- use command "php artisan passport:client --personal" after migration to create a passport client key
- use command "php artisan serve" to run the local server at port 8000
- postman JSON file is also included by the name "Code Bright Taz.postman_collection.json"
- [PLEASE CHANGE THE TOKEN WITH YOUR LOGIN TOKEN BEFORE TESTING IN POSTMAN]
- if shows keys not found error use command "php artisan passport:install"
- use command "php artisan test" to unit test feed after seeding 
- [PLEASE USE FRESH MIGRATION AND SEED FOR UNIT TESTING]
- use command "php artisan migrate:fresh --seed" and "php artisan passport:client --personal"
- Tested in PHP 7.4 and Laravel 8.65, and it worked absolutely fine


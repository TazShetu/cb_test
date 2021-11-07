- Run command "composer install" if there is no vendor folder
- Token is generated using passport package
- documentation (https://laravel.com/docs/8.x/passport)
- Expiration period of tokens are set in AuthServiceProvider to 30 days
- physically create db "cb_test"
- use command "php artisan migrate --seed" to migrate to DB and seed
- use command "php artisan passport:client --personal" after migration to create a passport client key
- use command "php artisan serve" to run the local server at port 8000
- postman JSON file is also included [change token before test]
- Test with that if you are running local server at port 8000
- if shows keys not found error use command "php artisan passport:install"
- 


- 
- 


- unit test [description include in readme]
- 

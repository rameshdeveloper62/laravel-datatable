
*login*

curl -X POST   http://localhost:8000/api/login -H 'accept: application/json' -H "Content-Type: application/json" -d '{"email": "john@test.com", "password": "12345678"}'

*register*

curl -X POST http://localhost:8000/api/register -H "Accept: application/json" -H "Content-Type: application/json" -d '{"name": "John", "email": "john@test.com", "password": "12345678", "password_confirmation": "12345678"}'

*User:*

curl -X GET 
  http://localhost:8000/api/user -H 'accept: application/json' -H 'authorization: Bearer wLBgrGe31roPu4QQ6VLAWbp1EbZMC7DddvA1X4BD5Rojnjd51kVPTtTjZxLW'

*logout*

  curl -X POST   http://localhost:8000/api/logout -H 'accept: application/json' -H 'Authorization':'Bearer jYjsTwqdBDZ1evOhaaJrF8IuKSFNZQB1S5T6SziYOyAT2R6iVTKgYkhra6JO'


*Article*

 curl -X GET http://localhost:8000/api/articles -H 'authorization: Bearer wLBgrGe31roPu4QQ6VLAWbp1EbZMC7DddvA1X4BD5Rojnjd51kVPTtTjZxLW'


*Testing*

- create Test

php artisan make:test UserTest

run testing

add in composer.json file

```
"scripts": {
        "test" : [
            "vendor/bin/phpunit"
        ]
}
```
- composer test
- vendor/bin/phpunit - without add above script

*Seeder*

-create seeder class

php artisan make:seeder ArticlesTableSeeder

- run specific seeder with class name

php artisan db:seed --class=ArticlesTableSeeder

- run all seeder

php artisan db:seed --force
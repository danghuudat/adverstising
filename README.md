## Normal Installation

Install [MySql](https://www.mysql.com/), [PHP](https://www.php.net/) and [Composer](https://getcomposer.org/) as environment <br>
- Run: "composer install"<br>
- Copy .env.example file to .env on the root folder<br>
- Run "php artisan key:generate" to generate app key in .env <br>
- Run "php artisan migrate" to run create table <br>
- Run "php artisan db:seed" to have test data<br>
- Run "php artisan serve"<br>
- Run API with domain http://localhost:8000 or any domain which is showed in the command tab
## Docker Installation
- Run docker-compose up
- Run: "composer install"<br>
- Copy .env.example file to .env on the root folder<br>
- Run "php artisan key:generate" to generate app key in .env <br>
- Run "php artisan migrate" to run create table <br>
- Run "php artisan db:seed" to have test data<br>
- Run "php artisan serve"<br>
- Run API with domain http://localhost:8000 or any domain which is showed in the command tab

## API List
GET /api/advertisement: get list advertisements<br>
POST /api/advertisement: Create new advertisement<br>
GET /api/advertisement/{id}: Get a specific advertisement<br>

## My doubts:
As the requirement, i need to validate "3 links to a photo", 
i'm not sure about this but i validated not allow 3 same links in an advertisement.

I think the field "name" and "title" is the same so i choosed to use "name".

I created unit test for all business case i think it's right.

I put the document in document folder

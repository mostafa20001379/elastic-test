## Elasticsearch Test with laravel


### Installation
- Clone the project's master branch from gitlab.
  - ``$ git clone https://github.com/mostafa20001379/elastic-test.git``

- For the first time, we need to install dependencies of the project by the composer.

    - $ cd project-path
    - $ composer install
- Modify `.env` file as you need.

- Generate the Laravel App Key.
    - ``$ php artisan key:generate``
- To preparing the database run this command.
    - ``$ php artisan db:seed DataSeeder``


## Usage
You can reach **OpenAPI** documentation by opening the service's URL in the browser at http://APP_URL/api/documentation.


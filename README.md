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


## notice

- Database has 5 indexes
    - instagram
    - news
    - twitter
    - instagram_gallery
    - notification

- Database seeder insert first 4 indexes with 100 items with faker.
- `show` api has 4 filter 
  - datetime
  - title
  - username
  - name


- `show` and `delete` apis tested but `store` and `notification` apis didn't test.
- Because of some problem **Unit test** not implemented.

## Usage
You can reach **OpenAPI** documentation by opening the service's URL in the browser at http://APP_URL/api/documentation.


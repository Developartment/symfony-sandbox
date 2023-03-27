# Symfony Sandbox
The default repository for Symfony projects.

## Development

This sandbox use Docker and Docker compose for development. You can easily start the whole app by one command listed bellow.

1. Run `docker-compose up` in the root of the project.
2. Open `http://localhost:8085` in your browser.
3. Your database server is on `localhost:3310`

---


### Migrations
To execute migrations inside running container, you can use:

~~~bash
docker exec symfony-sandbox-php-fpm php bin/console doctrine:migrations:migrate
~~~

### Dev tools
To run tools such as PHPStan, PHPCS and PHPCBF inside running container, run the following commands

~~~bash
docker exec symfony-sandbox-php-fpm check:types
docker exec symfony-sandbox-php-fpm composer check:cs
docker exec symfony-sandbox-php-fpm composer check:cs:fix
~~~

### Run tests
To run tests inside your Docker container, run this command:

~~~bash
docker exec symfony-sandbox-php-fpm check:tests
~~~

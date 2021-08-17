# PHP MVC Framework

My PHP MVC framework

## About PHP MVC Framework

## Installation

Via composer

```bash
composer create-project mohamed179/php-mvc-framework example-app
```

## Configuration

You have to create .env file to configure your application.

You can have cope from .env.example file then write your own configuration

```bash
cp .env.example .env
```

## Run the application

You have to run the following command to start serving the application

```bash
cd public/
php -S localhost:8000
```

Then go to: `http://localhost:8000`

## Using CLI

You can run cli commands by running `cli` file

### Examples

```bash
php cli --help
```

```bash
php cli migrate
```

```bash
php cli make:controller PostController --model Post
```

## License

This PHP framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT)
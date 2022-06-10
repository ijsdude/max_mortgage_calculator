# Max mortgage calculator

A simple application that can calculate your maximum mortgage based on some user specified values.

## Application specifications

- PHP: 8.1
- Symfony: 6.1.0
- Using the default docker configuration provided by Symfony
  - This provides symfony/flex functionality to automatically add docker configuration when a new symfony/flex recipy is installed

## Getting Started
To get this application to run on your local system follow the steps below:

1. Run `docker-compose build --no-cache --pull` to build fresh images
2. Run `docker-compose up` (the logs will be displayed in the current shell)
   1. If you want to run it in the background `docker-compose up -d`
3. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
   1. To be able to make requests to the API you need an API token
      1. Create a new `.env.local` in your root directory by copying the `.env` file. Now fill in the value at `API_KEY` to be able to make API requests.
   2. See next chapter `Api Documentation`, to find out what endpoints are available
4. Run `docker-compose down --remove-orphans` to stop the Docker containers.

## Api documentation
The API documentation can be found in the `/docs` directory in the root of this project. In here you will find a `swagger.yml` file. To open this go to https://editor.swagger.io/ and past in the code.

## Testing
This application uses `PHPUNIT`, use the following command to run all the tests.

- `./vendor/bin/phpunit`

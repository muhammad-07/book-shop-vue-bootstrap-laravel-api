<img align="right" width="auto" height="auto" src="https://www.elastic.co/static-res/images/elastic-logo-200.png"/>

# Laravel Vue Book store using Elasticsearch

## About Laravel Vue Book store using Elasticsearch

This is a web headless application, to demonstrate use of Elastic Search using Vue and Bootstrap as front-end and Laravel as Backend

## Requirements

- PHP 8.1.*
- Laravel 9.*
- Vue 3.*
- MySQL
- Elastic Search setup

## Installation and Configuration

Clone this repo and setup .env using .env.example, you may need to set app and database config as well as ES_CLOUD_ID and 
ES_API_KEY in order to use Elastic Search (ES).

```ini
ES_CLOUD_ID ="YOUR_ES_CLOUD_ID"
ES_API_KEY="YOUR_ES_API_KEY" 
APP_NAME="The Book Store"
APP_URL=http://your-server-name.test
```

Here I am using Elastic Search Cloud server for development purpose for the sake of time and resource saving, for production we can setup ES on our server to make queries more faster.

You can create ES cloud account [here](https://cloud.elastic.co/)

## Using Elastic Cloud

You can use [Elastic Cloud](https://www.elastic.co/cloud/) as server with 
`elasticsearch-php`. Elastic Cloud is the PaaS solution offered by 
[Elastic](https://www.elastic.co).

For connecting to Elastic Cloud you just need the `Cloud ID` and the `API key`.

You can get the `Cloud ID` from the `My deployment` page of your dashboard (see 
the red rectangle reported in the screenshot).

![Cloud ID](docs/images/cloud_id.png)

You can generate an `API key` in the `Management` page under the section 
`Security`.

![Security](docs/images/create_api_key.png)

When you click on `Create API key` button you can choose a name and set the 
other options (for example, restrict privileges, expire after time, and so on).

![Choose an API name](docs/images/api_key_name.png)

After this step you will get the `API key`in the API keys page. 

![API key](docs/images/cloud_api_key.png)

**IMPORTANT**: you need to copy and store the `API key`in a secure place, since 
you will not be able to view it again in Elastic Cloud.

Once you have collected the `Cloud ID` and the `API key`, you can add those keys to .env:

```ini
ES_CLOUD_ID ="YOUR_ES_CLOUD_ID"
ES_API_KEY="YOUR_ES_API_KEY" 
```

### Funally, run following commands

Install packages via composer:

```sh
composer install
```

Migrate and Seed the database:
> This will create all necessary tables in the database.
> This will get the fake data from fakerapi as suggested in requirements and will store it in our database. 

```sh
php artisan migrate:fresh --seed
```

Create indexes(records) on Elastic Search for the data we just seeded from fakerapi

```sh
php artisan index:books
```

If in case your server doesn't have ssl add above command doesn't work the you can Index data on Elastic Search manually by visiting: your-server.test/es_index_all 

```sh
your-server.test/es_index_all
```


Installing NPM packages and run the application:

```sh
npm install && npm run dev
```

## Console commands

This package also provides some useful console commands.

Create Indexes on Elastic search for all the rows in our table:

```sh
php artisan index:books
```

## Bugs, Suggestions, Contributions and Support

You can email me [here](mailto:muhammad.begawala@gmail.com) for any inquiery, suggestion or contribution

Please use [Github](https://github.com/muhammad-07/book-shop-vue-bootstrap-laravel-api) for reporting bugs, 
and making comments or suggestions.
 

## Copyright and License

[laravel-vue-book-shop-elasticsearch](https://github.com/muhammad-07/book-shop-vue-bootstrap-laravel-api)
was written by [Muhammad B](mailto:muhammad.begawala@gmail.com) and is released under the 
[MIT License](LICENSE.md).

Copyright (c) 2023 [Muhammad B](mailto:muhammad.begawala@gmail.com)

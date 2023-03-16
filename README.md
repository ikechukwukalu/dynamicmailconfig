# REQUIRE PIN

<!-- [![Latest Version on Packagist](https://img.shields.io/packagist/v/ikechukwukalu/dynamicmailconfig?style=flat-square)](https://packagist.org/packages/ikechukwukalu/dynamicmailconfig)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/ikechukwukalu/dynamicmailconfig/main?style=flat-square)](https://scrutinizer-ci.com/g/ikechukwukalu/dynamicmailconfig/)
[![Code Quality](https://img.shields.io/codefactor/grade/github/ikechukwukalu/dynamicmailconfig?style=flat-square)](https://www.codefactor.io/repository/github/ikechukwukalu/dynamicmailconfig)
[![Github Workflow Status](https://img.shields.io/github/actions/workflow/status/ikechukwukalu/dynamicmailconfig/dynamicmailconfig.yml?branch=main&style=flat-square)](https://github.com/ikechukwukalu/dynamicmailconfig/actions/workflows/dynamicmailconfig.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/ikechukwukalu/dynamicmailconfig?style=flat-square)](https://packagist.org/packages/ikechukwukalu/dynamicmailconfig)
[![Licence](https://img.shields.io/packagist/l/ikechukwukalu/dynamicmailconfig?style=flat-square)](https://github.com/ikechukwukalu/dynamicmailconfig/blob/main/LICENSE.md) -->

A simple Laravel package that provides a middleware which will require users to confirm routes utilizing their pin for authentication.

## REQUIREMENTS

- PHP 8.0+
- Laravel 9+

## STEPS TO INSTALL

``` shell
composer require ikechukwukalu/dynamicmailconfig
```

- `php artisan vendor:publish --tag=dmc-migrations`
- `php artisan migrate`
- Set `REDIS_CLIENT=predis` and `QUEUE_CONNECTION=redis` within your `.env` file.
- `php artisan queue:work`

## ROUTES

### Api routes

- **POST** `api/change/pin`
- **POST** `api/pin/required/{uuid}`

### Web routes

- **POST** `change/pin`
- **POST** `pin/required/{uuid}`
- **GET** `change/pin`
- **GET** `pin/required/{uuid?}`

## NOTE

- To receive json response add `'Accept': 'application/json'` to your headers.
- To aid your familiarity with this package you can run `php artisan sample:routes` to scaffold routes that will call functions within the `BookController`.

### Sample routes

- **POST** `v1/sample/books`
- **DELETE** `v1/sample/books{id}`
- **GET** `create/book`

## HOW IT WORKS

- First, it's like eating candy.
- The `dynamic.mail.config` middlware should be added to a route or route group.
- This middleware will arrest all incoming requests.
- A temporary URL (`pin/required/{uuid}`) is generated for a user to authenticate with the specified input `config(dynamicmailconfig.input)` using their pin.
- It either returns a `JSON` response with the generated URL or it redirects to a page where a user is required to authenticate the request by entering their pin into a form that will send a **POST** request to the generated URL when submitted.

### Reserved keys for payload

- `_uuid`
- `_pin`
- `expires`
- `signature`

## PUBLISH CONFIG

- `php artisan vendor:publish --tag=dmc-config`

## PUBLISH LANG

- `php artisan vendor:publish --tag=dmc-lang`

## PUBLISH VIEWS

- `php artisan vendor:publish --tag=dmc-views`

## LICENSE

The RP package is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

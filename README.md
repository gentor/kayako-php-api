# Kayako PHP SDK

PHP SDK for Kayako Rest API

## Installation

Installation using composer:

```
composer require gentor/kayako-php-api
```

## Usage
```php
$client = new Client([
    'base_url' => 'base_url',
    'client_id' => 'client_id',
    'client_secret' => 'client_secret',
    'username' => 'username',
    'password' => 'password',
]);
```

* Create User
```php
$user = $client->users->create([
    'role_id' => 4,
    'full_name' => 'API User',
    'email' => 'api.user@test.com'
]);
```

## Documentation

[Kayako API](https://developer.kayako.com/api/v1/reference/introduction/)

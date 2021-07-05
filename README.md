# Laravel stock management system

This project has been developed using **Laravel** and **Vuejs**.

## Quick Start

To install the application first copy .env.example int .env and update it accordingly. Then follow the steps bellow:

``` bash
# Install Dependencies
composer install

# Run Migrations
php artisan migrate

# Import Articles
php artisan db:seed

# Add virtual host if using Apache

# If you get an error about an encryption key
php artisan key:generate
```

**Note:** Please don't forget to install npm packages.

## Database schema
You can find the database schema **[here](./db/README.md "click to follow")**.
## Endpoints

#### Create a new client
``` bash
POST api/client
```

Payload:
``` json
{
    "username": "string"
}
```
#### Get all clients
``` bash
GET api/client
```

#### Add a stock
``` bash
POST api/stock
```

Payload:
``` json
{
    "company_name": "string",
    "unit_price": 0
}
```

#### Get all stocks
``` bash
GET api/stock
```

#### Update a stock
``` bash
PUT api/stock/{stock_id}
```
Payload:
``` json
{
    "unit_price": 0
}
```
#### Delete a stock
``` bash
DELETE api/stock/{stock_id}
```
#### Purchase a stock for a client
``` bash
PUT api/client{client_id}/stock/{stock_id}
```
Payload:
``` json
{
    "volume": 1
}
```



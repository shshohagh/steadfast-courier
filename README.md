# Steadfast Courier

A Laravel package for integrating Steadfast Courier API.

## Installation

You can install the package via composer:

```bash
composer require shshohagh/steadfast-courier

## Usage

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Shshohagh\SteadfastCourier\SteadfastServiceProvider" --tag="config"

Update your .env file with your Steadfast API credentials:

```dotenv
STEADFAST_BASE_URL=https://portal.steadfast.com.bd/api/v1
STEADFAST_API_KEY=your-api-key
STEADFAST_SECRET_KEY=your-secret-key

Use the Steadfast class to interact with the API.

```php
use Shshohagh\SteadfastCourier\Steadfast;

$steadfast = app(Steadfast::class);
$response = $steadfast->placeOrder($orderData);




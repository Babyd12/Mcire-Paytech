# PayTech Package for Laravel

This package provides an easy integration of the PayTech payment gateway into your Laravel applications.




<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center"><a href="https://paytech.sn/" target="_blank"><img src="https://paytech.sn/assets/srcs/img/logo_paytech.png" width="400" alt="Laravel Logo"></a></p>

## Installation

```bash
composer require mcire/paytech
```

The package discovery is enabled by default in Laravel 5.5+. If you're using an earlier version, manually add the service provider and facade in `config/app.php`:

```php
'providers' => [
    // ...
    Mcire\PayTech\PayTechServiceProvider::class,
],

'aliases' => [
    // ...
    'PayTech' => Mcire\PayTech\Facades\PayTech::class,
],
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=config
```

Add the following variables to your `.env` file:

```dotenv
PAYTECH_API_KEY=your_api_key
PAYTECH_API_SECRET=your_api_secret
PAYTECH_ENV=test # or 'prod' for production
PAYTECH_IPN_URL=https://your-domain.com/ipn
PAYTECH_SUCCESS_URL=https://your-domain.com/success
PAYTECH_CANCEL_URL=https://your-domain.com/cancel
```

## Tips for configuring PayTech's IPN locally
PayTech requires the callback route (IPN) to be accessible via HTTPS. This can pose a challenge during local development. 

## If you don't need to handle IPN calls :

simply configure the IPN URL as follows
```bash
  PAYTECH_IPN_URL=https://127.0.0.1:8000/ipn
```


## If you need to handle IPN calls locally:

- Use an HTTPS proxy like Ngrok.
  ## 🔗 Links
[![Ngork](https://ngrok.com/docs/img/ngrok-black.svg)](https://ngrok.com/docs/getting-started/)


## Usage

### Initiating a Payment

```php
use Mcire\PayTech\Facades\PayTech;

try {
    $response = PayTech::requestPayment([
        'item_name' => 'Product name',
        'item_price' => 1000, // Price in cents
        'currency' => 'XOF',
        'ref_command' => Str::random(12), // Unique reference
        'command_name' => 'Order description',
    ]);
    
    // Redirect to PayTech payment page
    return redirect($response['redirect_url']);
} catch (\Exception $e) {
    // Error handling
    abort(500, $e->getMessage());
}
```

### Available Parameters

| Parameter | Type | Description | Required |
|-----------|------|-------------|---------|
| item_name | string | Product name | Yes |
| item_price | integer | Price in cents | Yes |
| currency | string | Currency (XOF, EUR, etc.) | Yes |
| ref_command | string | Unique order reference | Yes |
| command_name | string | Order description | Yes |

### Handling Returns

The package automatically handles three types of returns:

1. **IPN (Instant Payment Notification)**
   - URL configured in `PAYTECH_IPN_URL`
   - Server-to-server notification from PayTech
   - Used to update order status

2. **Success Page**
   - URL configured in `PAYTECH_SUCCESS_URL`
   - Redirection after successful payment

3. **Cancel Page**
   - URL configured in `PAYTECH_CANCEL_URL`
   - Redirection after payment cancellation

## Environments

The package supports two environments:
- test: For testing (default)
- prod: For production

Configure the environment via the `PAYTECH_ENV` variable in your `.env` file.

## Security

- All requests are made over HTTPS
- API keys are securely stored in the `.env` file
- Communications are authenticated via API_KEY and API_SECRET headers

## Common Error Codes

| Code | Description | Solution |
|------|-------------|----------|
| 400 | Invalid parameters | Check the sent parameters |
| 401 | Authentication failed | Verify your API keys |
| 500 | Server error | Contact PayTech support |

## Support

For any questions or issues:
- Open an issue on GitHub
- Contact me at mamadoucirecamara99@gmail.com

## License

This package is open-sourced software licensed under the MIT license. See the LICENSE file for more details.

<?php

namespace Syedmahamudul\Sslcommerz\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Syedmahamudul\Sslcommerz\Services\SslcommerzService init(array $data)
 * @method static \Syedmahamudul\Sslcommerz\Services\SslcommerzService setCustomer(array $customer)
 * @method static \Syedmahamudul\Sslcommerz\Services\SslcommerzService setShipping(array $shipping)
 * @method static \Syedmahamudul\Sslcommerz\Services\SslcommerzService addProduct(array $product)
 * @method static \Syedmahamudul\Sslcommerz\Services\PaymentResponse execute()
 * @method static bool validate(array $data, string $transactionId, float $amount)
 */
class Sslcommerz extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sslcommerz';
    }
}
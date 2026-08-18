<?php

if (!function_exists('sslcommerz')) {
    /**
     * Get SSLCommerz instance
     *
     * @return \Syedmahamudul\Sslcommerz\Services\SslcommerzService
     */
    function sslcommerz()
    {
        return app('sslcommerz');
    }
}

if (!function_exists('sslcommerz_config')) {
    /**
     * Get SSLCommerz configuration
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function sslcommerz_config($key, $default = null)
    {
        return config("sslcommerz.{$key}", $default);
    }
}

if (!function_exists('sslcommerz_sandbox')) {
    /**
     * Check if SSLCommerz is in sandbox mode
     *
     * @return bool
     */
    function sslcommerz_sandbox()
    {
        return config('sslcommerz.sandbox', true);
    }
}

if (!function_exists('sslcommerz_currency')) {
    /**
     * Get SSLCommerz currency
     *
     * @return string
     */
    function sslcommerz_currency()
    {
        return config('sslcommerz.currency', 'BDT');
    }
}
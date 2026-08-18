<?php

namespace Syedmahamudul\Sslcommerz\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SslcommerzMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Add IPN validation
        if ($request->is(config('sslcommerz.routes.prefix', 'sslcommerz') . '/*')) {
            // Verify that the request is from SSLCommerz
            // You can add IP whitelisting or signature validation here
        }

        return $next($request);
    }
}
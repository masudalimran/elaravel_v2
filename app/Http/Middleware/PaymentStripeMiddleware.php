<?php

namespace App\Http\Middleware;

use Closure;

class PaymentStripeMiddleware
{

    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Unsubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        // user is already subscribed, therefore shouldn't be able to re-subscribe again
        if (optional($request->user())->hasActiveSubscription()) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}

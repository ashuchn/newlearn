<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkIfPaymentDone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $payment = false;
        if(!$payment) {
            return redirect()->route('login')->with('error','Payment not initiated');
        }
        return $next($request);
    }
}

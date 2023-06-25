<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkAccountIsChoosen
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
        if(\Session::has('accountChoosen')) {
            if(\Session::get('accountChoosen') == true){
                return $next($request);
            } else {
                flash()->options([
                    'timeout' => 3000,
                    'position' => 'top-center',
                ])->addError('you need to choose account first!');
                return redirect()->route('login');
            }
        }  else {
            flash()->options([
                'timeout' => 3000,
                'position' => 'top-center',
            ])->addError('you need to choose account first!');
            return redirect()->route('login');
        }
        
    }
}

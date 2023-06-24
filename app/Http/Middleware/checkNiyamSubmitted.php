<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserNiyam;
use Illuminate\Http\Request;

class checkNiyamSubmitted
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
        if(UserNiyam::where([
            ['user_id', auth()->user()->id],
            ['submitted_on', \Carbon\Carbon::now()->format('Y-m-d')]
        ])->exists()) {
            return back()->with('error','Niyam already submitted for today');
        }
            return $next($request);
    }
}

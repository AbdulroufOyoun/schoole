<?php

namespace App\Http\Middleware\user;

use App\Http\Controllers\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;

class admin
{
    use ApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (auth()->user()->AccountType !== "academic" && auth()->user()->AccountType !== "admin") {

             return $this->notAdmin();
        }
        return $next($request);

    }
}

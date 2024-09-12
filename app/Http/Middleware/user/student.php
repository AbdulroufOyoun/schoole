<?php

namespace App\Http\Middleware\user;

use App\Http\Controllers\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;

class student
{
    use ApiResponseTrait;

    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->AccountType == "student") {
            return $next($request);
        }
        return $this->notAllow();

    }
}

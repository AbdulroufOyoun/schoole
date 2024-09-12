<?php

namespace App\Http\Middleware\user;

use App\Http\Controllers\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;

class teacher
{
    use ApiResponseTrait;

    public function handle(Request $request, Closure $next)
    {

        if (auth()->user()->AccountType == "teacher") {
            return $next($request);
        }
        return $this->notAllow();

    }
}
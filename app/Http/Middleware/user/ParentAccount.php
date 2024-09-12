<?php

namespace App\Http\Middleware\user;

use App\Http\Controllers\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;

class ParentAccount
{
    use ApiResponseTrait;

    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->AccountType == "Parent") {
            return $next($request);
        }
        return $this->notAllow();

    }
}

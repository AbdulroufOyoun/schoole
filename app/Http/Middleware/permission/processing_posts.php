<?php

namespace App\Http\Middleware\permission;

use App\Http\Controllers\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
class processing_posts
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
        if(auth()->user()->hasPermissionTo('procesing posts', 'web')){
            return $next($request);
        }
        return $this->notAllow();

    }
}

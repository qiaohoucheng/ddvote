<?php

namespace App\Http\Middleware;

use Closure;

class CheckWeixin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $uid = session('dduid');
        if(!$uid){
            redirect('/auth/weixin');
        }
        return $next($request);
    }
}

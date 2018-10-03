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
        $uid = 0;
        if(!$uid){
            redirect('/auth/weixin');
        }
        echo $uid;
        return $next($request);
    }
}

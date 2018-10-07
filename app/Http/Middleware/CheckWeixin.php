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
        $uid = $request->session()->get('d2_uid');
        if(!$uid || $uid == 0){
            return  redirect('/auth/weixin');
        }
        return $next($request);
    }
}

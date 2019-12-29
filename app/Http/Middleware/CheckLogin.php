<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        // 判断用户是否登入
        if(!session()->has('login.user')){
            return redirect(route('admin.login'))->with('error','非法登入');
        }

        return $next($request);
    }
}

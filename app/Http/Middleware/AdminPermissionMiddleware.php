<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPermissionMiddleware
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
       
        if(Auth::check())
        {
            if(Auth::user()->role_as == '0')
            {
                return redirect('/admin/layout_admin')->with('status','Vào trang Admin');
            }
            else
            {
                return redirect('/user/home')->with('status','Vào trang người dùng');
            }
        }
        else
        {
            return redirect('/user/login')->with('status','Please Login First');
        }
    }
}

<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;

class AdminloginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
    if(Auth::check()){
            $user = Auth::user();
            if($user->quyen ==1)
        return $next($request);
    else
        return redirect('admin/dangnhap')->with('thongbao','admin mới được vào');
        }
        else
            return redirect('admin/dangnhap')->with('thongbao','đăng nhập thất bại');
    }
}

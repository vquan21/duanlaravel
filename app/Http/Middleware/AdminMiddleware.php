<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('admin') && $request->session()->get('admin')) {
            return $next($request);
        }

        return redirect()->route('client.home')->with('error', '❗️ Bạn không có quyền truy cập vào trang này !');
    }
}

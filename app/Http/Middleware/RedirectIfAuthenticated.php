<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }

        // return $next($request);
        $table_id = $_GET['tableId'];
        $table_no = $_GET['tableNo'];
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($guard === 'web') {
                    return redirect(RouteServiceProvider::HOME);
                } else if ($guard === 'customer') {
                    return redirect(route('order.menu', [
                        'tableNo' => $table_no,
                        'tableId' => $table_id
                    ]));
                }
            }
        }
        return $next($request);
    }
}

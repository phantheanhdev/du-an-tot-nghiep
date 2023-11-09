<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNewNameMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->hasCookie('customer_name')) {
            $table = $_GET['tableNo'];
            return redirect()->route('form_infor_user', 'tableNo=' . $table)->with('error', 'Vui lòng nhập tên mới để mua hàng.');
        }
        return $next($request);
    }
}

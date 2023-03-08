<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateDeviceParams
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
        $uid = $request->input('uid');
        $app_id = $request->input('app_id');
        $language = $request->input('language');
        $os = $request->input('os');

        if (!$uid || !$app_id || !$language || !$os) {
            return response()->json(['error' => 'Invalid parameters'], 400);
        }

        return $next($request);
    }
}

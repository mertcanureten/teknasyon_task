<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidatePurchaseParams
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
        $client_token = $request->input('client_token');
        $receipt = $request->input('receipt');

        if (!$client_token || !$receipt) {
            return response()->json(['error' => 'Invalid parameters'], 400);
        }

        return $next($request);
    }
}

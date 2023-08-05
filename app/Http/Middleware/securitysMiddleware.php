<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\AsingPin;
use Illuminate\Support\Facades\Auth;

class securitysMiddleware
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
        $data = AsingPin::where('user_id', Auth::user()->id)->first();
        if ($data == null) {
            return $next($request);
        } else {
            return redirect('pinView/'.$data->id.'/pinView');
        }       
    }
}

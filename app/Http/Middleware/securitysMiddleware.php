<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\AsingPin;

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
        // $data = User::select('users.id', 'users.email', 'asing_pins.user_id', 'asing_pins.status')
        //         ->join('asing_pins', 'users.id', '=', 'asing_pins.user_id')
        //         ->first();
        // if ($data->status) {
        //     return redirect('pinView/'.$data->id.'/pinView');
        // } else {
            return $next($request);
        // }        
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AsingPin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Services\UserStatusService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AsingPinController as apc;

class securitysMiddleware
{


    protected $UserStatusService;

    public function __construct(UserStatusService $UserStatusService)
    {
        $this->UserStatusService = $UserStatusService;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('System')) {
            return $next($request);
        }

        if (!$this->UserStatusService->consultarEstadoPerfil(Auth::user()) ||
            !$this->UserStatusService->consultarEstadoPin(Auth::user()) ||
            !$this->UserStatusService->verificarMembresia(Auth::user())) {
            return $next($request);
        }

        $lastValidated = $request->session()->get('pin_validated_at');

        

        if ($lastValidated) {
            $minutesSinceLastValidated = Carbon::now()->diffInMinutes(Carbon::createFromTimestamp($lastValidated));
            
            if ($minutesSinceLastValidated > 5) {
                $request->session()->forget('pin_validated');
                $request->session()->forget('pin_validated_at');
            }
        }
    
        if ($request->session()->get('pin_validated', false)) {
            return $next($request);
        }

        $data = AsingPin::where('user_id', Auth::user()->id)->first();
        if ($data == null) {
            return redirect('dashboard');
        } else {
            $request->session()->put('url.intended', parse_url($request->fullUrl(), PHP_URL_PATH));
            $apc = new apc();
            $apc->validatePinSend();

            return redirect('pinView/'.$data->id.'/pinView');
        }
    }
}

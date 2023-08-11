<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AsingPin;
use App\Models\AsignProfile;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use App\Services\UserStatusService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class VerifyAccountStatusMiddleware
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
        $usuario = Auth::user();
        
        if ($usuario) {
            $perfilActivo = $this->UserStatusService->consultarEstadoPerfil($usuario);
            $pinesActivos = $this->UserStatusService->consultarEstadoPin($usuario);
            $membresiaAprobada = $this->UserStatusService->verificarMembresia($usuario);

            View::share('UserStatus', [
                'perfilActivo' => $perfilActivo && $pinesActivos && $membresiaAprobada,
            ]);
        }
        
        return $next($request);
    }

}

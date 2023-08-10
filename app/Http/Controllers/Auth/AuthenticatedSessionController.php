<?php

namespace App\Http\Controllers\Auth;

use App\Models\AsingPin;
use Illuminate\View\View;
use App\Models\AsignProfile;
use Illuminate\Http\Request;
use App\Services\UserStatusService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    protected $UserStatusService;

    public function __construct(UserStatusService $UserStatusService)
    {
        $this->UserStatusService = $UserStatusService;
    }
    
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(RouteServiceProvider::HOME);
    // }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        $perfilActivo = $this->UserStatusService->consultarEstadoPerfil($user);
        $pinActivo = $this->UserStatusService->consultarEstadoPin($user);
    
        if ($perfilActivo && $pinActivo) {
            $membresiaAprobada = $this->UserStatusService->verificarMembresia();
            if (!$membresiaAprobada) {
                return redirect()->route('membership');
            }
        } else {
            // Si el perfil o los pines no están activos, rederigir a perfil
            return redirect()->route('editProfile')->withErrors(['Debes terminar de activar tu perfil.']);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

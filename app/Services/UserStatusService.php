<?php

namespace App\Services;

use App\Models\AsingPin;
use App\Models\AsignProfile;
use App\Models\OrderPayment;
use Illuminate\Support\Facades\Auth;

class UserStatusService
{
    public function consultarEstadoPerfil($usuario)
    {
        $perfil = AsignProfile::where('user_id', $usuario->id)->first();
    
        if ($perfil && $perfil->status) {
            return true;
        } else {
            return false;
        }
    }

    public function consultarEstadoPin($usuario)
    {
        $pines = AsingPin::where('user_id', $usuario->id)->first();
    
        if ($pines && $pines->status) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarMembresia($usuario)
    {
        $membership = OrderPayment::where('user_id', $usuario->id)
                                        ->where('type', 'membership')
                                        ->first();
    
        if ($membership && $membership->status == 'paid') {
            return true;
        } else {
            return false;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AsignProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNotificationController extends Controller
{
    public function isProfileAproved()
    {
        $profile = AsignProfile::where('user_id', Auth::user()->id)->first();

        if ($profile->status == false && $profile->is_reviewed == true) {
            $isAproved = false;
            toastr()->timeOut(3000)->addError('El perfil fue rechazado, reenvie documentos nuevamente');
        } else {
            $isAproved = true;
        }

        return $isAproved;
    }
}

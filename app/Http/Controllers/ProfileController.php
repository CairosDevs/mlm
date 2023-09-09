<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AsingPin;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\AsignProfile;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\AsingPinController as ap;
use App\Models\Referral;

class ProfileController extends Controller
{
    public function molde($id)
    {
        $asignProfile = AsignProfile::where('user_id', $id)->first();
        $asignPin = AsingPin::where('user_id', $id)->first();
        $asignedMembership = OrderPayment::where('user_id', $id)
                                        ->where('type', 'membership')
                                        ->first();
        $rurl = Referral::where('referral_code', '!=', null)
                        ->where('user_id', $id)
                        ->first();
        $url = false;
        if ($rurl != null) {
            $url = url("/register/{$rurl->referral_code}");
        }
        return [$asignProfile,$asignPin,$asignedMembership,$url];
    }

    public function viewPin()
    {
        $id = Auth::user()->id;
        $data = $this->molde($id);
        return view('profile.view-pin', [
            'user' => Auth::user(),
            'asignProfile' => $data[0],
            'asignPin' => $data[1],
            'membership' => $data[2],
            'referral_url' => $data[3],
        ]);
    }
    public function editProfile(Request $request)
    {
        $id = Auth::user()->id;

        $data = $this->molde($id);
        $request->merge(['user_id' => $id, 'editProfile' => 'editProfile']);
        $pin = new ap();
        $pins = $pin->validatePin($request);

        if (!$pins) {
            return view('securitypin.validate-pin', compact('request'));
        } else {
            return view('profile.edit', [
                'user' => $request->user(),
                'asignProfile' => $data[0],
                'asignPin' => $data[1],
                'membership' => $data[2],
                'referral_url' => $data[3],
            ]);
        }
    }
    
    public function editValidate(Request $request)
    {
        $id = Auth::user()->id;
        $data = $this->molde($id);
        $request->merge(['user_id' => $id, 'editValidate' => 'editValidate']);
        $pin = new ap();
        $pins = $pin->validatePin($request);
        if (!$pins) {
            return view('securitypin.validate-pin', compact('request'));
        } else {
            return view('profile.validationProfile', [
                'user' => $request->user(),
                'asignProfile' => $data[0],
                'asignPin' => $data[1],
                'membership' => $data[2],
                'referral_url' => $data[3],
            ]);
        }
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $id = Auth::user()->id;
        $data = $this->molde($id);
        return view('profile.edit', [
            'user' => $request->user(),
            'asignProfile' => $data[0],
            'asignPin' => $data[1],
            'membership' => $data[2],
            'referral_url' => $data[3],
        ]);
    }

    public function registerProfile(Request $request): View
    {
        $id = Auth::user()->id;
        $data = $this->molde($id);
        return view('profile.edit', [
            'asignProfile' => $data[0],
            'asignPin' => $data[1],
            'membership' => $data[2],
            'referral_url' => $data[3],
        ]);
    }

    public function validationProfile(Request $request): View
    {
        $id = Auth::user()->id;
        $data = $this->molde($id);
        return view('profile.validationProfile', [
            'user' => $request->user(),
            'asignProfile' => $data[0],
            'asignPin' => $data[1],
            'membership' => $data[2],
            'referral_url' => $data[3],
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $id = Auth::user()->id;
        $request->merge(['user_id' => $id]);
        
        $pin = new ap();
        $pins = $pin->validatePin($request);
        if (!$pins) {
            return view('securitypin.validate-pin', compact('request'));
        }

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $id = Auth::user()->id;
        AsignProfile::where('user_id', $id)->delete();

        $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Update the user's profile information. extra
     */
    public function asignProfile(Request $request)
    {

        // $validated = $request->validate([
        //     'dni'  => ['required', 'image'],
        //     'country'  => ['required', 'string', 'max:25'],
        //     'placeBirth'  => ['required', 'string', 'max:25'],
        //     'birthdate'  => ['required', 'string', 'max:25'],
        //     'address'  => ['required', 'string', 'max:25'],
        //     'PostalCode'  => ['required', 'string', 'max:25'],
        //     'digitalContract' => ['required','mimes:pdf','max:2048'],
        // ]);

        $id = Auth::user()->id;
        $request->merge(['user_id' => $id]);

        $asignProfile = AsignProfile::where('user_id', $id)->first();

        if ($request->file('digitalContract') != null) {
            $doc = $this->uploadFile($request, $id, $request->file('digitalContract'));
        } else {
            $doc = $asignProfile->digitalContract;
        }

        $request->merge(['doc' => $doc]);

        $image_path = 'documents/dni/'. Str::random(8) .".". $request->dni->getClientOriginalExtension();
        
        $image = Image::make($request->dni)
            ->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg', 80);

        Storage::disk('local')->put($image_path, (string) $image);

        $data = [
            'user_id'  => $id,
            'dni'  => $image_path,
            'country'  => $request->country,
            'placeBirth'  => $request->placeBirth,
            'birthdate'  => $request->birthdate,
            'address'  => $request->address,
            'PostalCode'  => $request->postalCode,
            'digitalContract'  => $doc,
        ];
        if ($asignProfile == null) {
            $user = AsignProfile::create($data);
        } else {
            $user = AsignProfile::where('user_id', $id)->update($data);
        }
        return Redirect::route('profile.edit')->with('status', 'profile - updated');
    }

    public function uploadFile($request, $id, $fileSave)
    {

        $file = $request->file('digitalContract');
        $ext = $file->extension();
        $fileName = Str::random(8) .".". $ext;

        $path = storage_path('app/public/documents/contract/');
        $doc = 'documents/contract/'.$fileName;

        $deleteFile = storage_path('app/public/documents/contract/'.$fileSave);

        if (is_file($deleteFile)) {
            unlink($deleteFile);
        }

        $file->move($path, $fileName);
        return $doc;
    }
    
    /**
     * Activate pin
     */
    public function asingPin(Request $request)
    {
        $id = Auth::user()->id;
        $request->merge(['user_id' => $id]);

        $pin = new ap();
        $pins = $pin->validatePin($request);
        if (!$pins) {
            return view('securitypin.validate-pin', compact('request'));
        }
        $pin = new ap();
        $pin->activatePin($request);
        return Redirect::route('profile.edit')->with('status', 'pin activated');
    }

    public function listValidatation(Request $request)
    {
        $users = AsignProfile::where('status', false)->paginate(10);


        return view('profile.listValidation', ['users' => $users]);
    }

    public function showValidatation(Request $request, $id)
    {
        $user = AsignProfile::where('id', $id)->first();

        return view('profile.showValidation', ['user' => $user]);
    }

    
    public function updateStatusDocs(Request $request, $id)
    {
        $user = AsignProfile::where('id', $id)->first();
        $user->status = $request->input('status') == 'aprobado' ? true : false;
        $user->is_reviewed = true;
        $user->save();

        if ($user->status) {
            return Redirect::route('profile.list.validation', $user->id)->with('sweet-success', 'Perfil activado');
        } else {
            return Redirect::route('profile.list.validation', $user->id)->with('sweet-info', 'Usuario notificado de rechazo');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\AsignProfile;
use Illuminate\Support\Facades\Storage;
use App\Models\AsingPin;
use App\Http\Controllers\AsingPinController as ap;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $id = Auth::user()->id;
        $asignProfile = AsignProfile::where('user_id', $id)->first();
        $asignPin = AsingPin::where('user_id', $id)->first();
        return view('profile.edit', [
            'user' => $request->user(),
            'asignProfile' => $asignProfile,
            'asignPin' => $asignPin,
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
    public function asignProfile(Request $request) {
        $request->validate([
            'dni'  => ['required', 'numeric'],
            'country'  => ['required', 'string', 'max:25'],
            'placeBirth'  => ['required', 'string', 'max:25'],
            'birthdate'  => ['required', 'string', 'max:25'],
            'address'  => ['required', 'string', 'max:25'],
            'PostalCode'  => ['required', 'string', 'max:25'],  
            'digitalContract' => ['required','mimes:pdf,xlxs,xlx,docx,doc,csv,txt,png,gif,jpg,jpeg','max:2048'],         
        ]);

        $id = Auth::user()->id;
        $request->merge(['user_id' => $id]);

        $asignProfile = AsignProfile::where('user_id', $id)->first();
        if ($request->file('digitalContract') != null) {
            $doc = $this->uploadFile($request, $id, $request->file('digitalContract'));
        } else {
            $doc = $asignProfile->digitalContract;
        }
        $request->merge(['doc' => $doc]);
        $pin = new ap();
        $pins = $pin->validatePin($request);
        if (!$pins) {
            return view('securitypin.validate-pin', compact('request'));
        } 

        $data = [
            'user_id'  => $id,
            'dni'  => $request->dni,
            'country'  => $request->country,
            'placeBirth'  => $request->placeBirth,
            'birthdate'  => $request->birthdate,
            'address'  => $request->address,
            'PostalCode'  => $request->PostalCode,
            'digitalContract'  => $doc,
        ];
        if ($asignProfile == null) {
            $user = AsignProfile::create($data);
        } else {
            $user = AsignProfile::where('user_id', $id)->update($data);
        }
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function uploadFile($request, $id, $fileSave) {
        $file = $request->file('digitalContract');
        $ext = $file->extension();
        $fileName = time() . '.'. $ext; 
        $path = storage_path('app/public/digitalContract/'.$id);
        $doc = 'digitalContract/'.$id.'/'.$fileName;
        $deleteFile = storage_path('app/public/'.$fileSave);
        if (is_file($deleteFile)) { 
            unlink($deleteFile);
        }
        $file->move($path,$fileName);
        return $doc;
    }
    
    /**
     * Activate pin
     */
    public function asingPin(Request $request) {
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
}

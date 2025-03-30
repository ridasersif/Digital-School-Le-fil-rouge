<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateEmailRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function updateEmail(UpdateEmailRequest $request) {
        $user = Auth::user();
        Log::info('User trying to update email', [
            'user_id' => $user->id,
            'entered_password' => $request->password,
            'hashed_password' => $user->password,
        ]);
    
       
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Mot de passe incorrect'])->withInput();
        }
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('success', 'E-mail mis à jour avec succès');
    }


    public function updatePassword(UpdatePasswordRequest $request) {
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mot de passe actuel incorrect']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $profile = $user->profile;
        if (!$profile) {
            $profile = new Profile([
                'user_id' => $user->id, 
            ]);
        }
        $user->update([
            'name' => $request->input('name'),
        ]);
        $profile->update([
            'phone' => $request->input('phone'),
            'birthdate' => $request->input('birthdate'),
            'occupation' => $request->input('occupation'),
            'address' => $request->input('address'),
            'website' => $request->input('website'),
            'facebook_profile' => $request->input('facebook_profile'),
        ]);
    
        return redirect()->back()->with('success', 'Profil mis à jour avec succès!');
    }
    
    
}

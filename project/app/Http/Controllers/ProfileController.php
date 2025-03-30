<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\AvatarRequest;
use App\Http\Requests\Profile\UpdateEmailRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Interfaces\Profile\ProfileInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use AuthorizesRequests;
    protected $profileRepository;

    public function __construct(ProfileInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function updateEmail(UpdateEmailRequest $request)
    {
        $user = Auth::user();

        
        Log::info('User trying to update email', [
            'user_id' => $user->id,
            'entered_password' => $request->password,
            'hashed_password' => $user->password,
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Mot de passe incorrect'])->withInput();
        }

        $this->profileRepository->updateEmail($user, $request->email);
        return redirect()->back()->with('success', 'E-mail mis à jour avec succès');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
       

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mot de passe actuel incorrect']);
        }

        $this->profileRepository->updatePassword($user, $request->new_password);
        return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user(); 

        $this->profileRepository->updateProfile($user, $request->all());
    
        return redirect()->back()->with('success', 'Profil mis à jour avec succès!');
    }
    public function updateAvatar(AvatarRequest $request)
    {
        $user = Auth::user();
      

        if ($request->hasFile('avatar')) {
            $this->profileRepository->updateAvatar($user, $request->file('avatar'));
            return redirect()->back()->with('success', 'Photo de profil mise à jour avec succès');
        }

        return redirect()->back()->withErrors(['avatar' => 'Veuillez sélectionner une image.']);
    }



    
}

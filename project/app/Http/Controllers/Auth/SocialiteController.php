<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\Formateur;
use App\Models\Profile;
use App\Models\Role;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('social_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('home');
                
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'social_type' => 'google',
                    'password' => Hash::make('password'),
                    'role_id' => 4
                ]);
                Profile::create([
                    'user_id' => $newUser->id,
                ]);
                Auth::login($newUser);
                return redirect()->route('select-role');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
          
            return redirect()->route('login')->with('error', 'error de Google: ' . $e->getMessage());
        }
    }
    public function showRoleSelection()
    {
        $roles = Role::all();
        return view('auth.select-role', compact('roles'));
    }

    public function saveRole(Request $request)
    {
        $request->validate([
            'role' => 'required|exists:roles,id',
        ]);

        /**
         * @var App\Models\User
         */
        $user = Auth::user();

        $user->role_id = $request->role;
        if ($user->role_id == 3) {
            $user->status = 'active';
            Etudiant::create([
                'user_id' => $user->id
            ]);

        } elseif ($user->role_id == 2) {
            $user->status = 'inactive';
            Formateur::create([
                'user_id' => $user->id
            ]);
        }
        $user->update([
            'role_id' => $user->role_id,
            'status' => $user->status,
        ]);


        return redirect()->route('home');
    }
}

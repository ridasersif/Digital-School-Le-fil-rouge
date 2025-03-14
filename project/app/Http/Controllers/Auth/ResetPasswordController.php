<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
  
    public function showResetForm(Request $request, $token)
{
    return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
}


  
    public function reset(Request $request)
    {
       
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',  
            'token' => 'required'
        ]);

     
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
              
                $user->password = Hash::make($password);
                $user->save();
            }
        );

    
        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Votre mot de passe a été réinitialisé avec succès.');
        } else {
            return back()->withErrors(['email' => 'Le lien de réinitialisation n\'est plus valide.']);
        }
    }
}

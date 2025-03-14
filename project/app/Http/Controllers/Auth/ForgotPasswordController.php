<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm(){
       
        return view('auth.forgot-password');
    }
    public function sendResetLinkEmail(Request $request)
    {
       
        
        $request->validate([
            'email' => 'required|email|exists:users,email', 
        ]);
        session()->flash('email', $request->email);
    
        $response = Password::sendResetLink($request->only('email'));
    
        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('status', 'Nous avons envoyé un lien de réinitialisation à votre adresse email.');
        } else {
            return back()->withErrors(['email' => 'Le lien de réinitialisation n\'a pas pu être envoyé.']);
        }
    }
    
    
}

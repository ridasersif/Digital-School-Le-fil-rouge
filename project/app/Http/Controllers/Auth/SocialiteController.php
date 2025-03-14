<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
            $finduser=User::where('social_id',$user->id)->first();
            if($finduser){
                Auth::login($finduser);
               
                return redirect()->route('home');
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id, 
                    'social_type' => 'google', 
                    'password' => Hash::make('password'),
                    'role_id' => 4
                ]);
                Auth::login($newUser);
                return redirect()->route('home');
            }
    
        } catch (\Exception $e) {
          
            return redirect()->route('login')->with('error', 'error de Google: ' . $e->getMessage());
        }
    }
}

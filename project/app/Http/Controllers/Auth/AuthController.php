<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
   
    public function formRegister()
    {
        $roles=Role::all();
     
        return view('auth.register', compact('roles'));
      
    }

  
    public function register(RegisterRequest $request)
    {
        $role = $request->role;
        if ($role== 3) {
            $status = 'active';
        } elseif ($role == 2) {
            $status = 'inactive';
        }

        $user =User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role_id'=>$role,
            'status'=>$status

        ]);
        Auth::login($user);
        return redirect()->route('home');
    }

   
    public function formLogin()
    {
        return view('auth.login');
    }

   
    public function login(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('home');
        }
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput(); 
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}

<?php

namespace App\Repositories\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AdminRepository 
{
    public function getAllUsers()
    {
        return User::with('profile')->get();
    }
  
}

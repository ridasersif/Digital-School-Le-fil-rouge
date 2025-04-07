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
    public function getAllInstructors()
    {
        return User::with('profile')->where('role_id', 2)->get();
    }
    public function getAllStudents()
    {
        return User::with('profile')->where('role_id', 3)->get();
    }
  
    public function getInactiveUsers()
    {
        return User::with('profile')->where('status', 'inactive')->get();
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

    // Méthode pour changer le statut d'un utilisateur
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();
        return $user;
    }
  
}

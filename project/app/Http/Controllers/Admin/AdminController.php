<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function showAllUsers()
    {
        $users = $this->adminRepository->getAllUsers();

        return view('admin.users.index', compact('users'));
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succès!']);
    }
    public function toggleStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();
    
        return response()->json([
            'success' => true,
            'new_status' => $user->status,
            'label' => $user->status === 'active' ? 'Actif' : 'Inactif',
            'badge_class' => $user->status === 'active' ? 'success' : 'danger',
        ]);
    }

}

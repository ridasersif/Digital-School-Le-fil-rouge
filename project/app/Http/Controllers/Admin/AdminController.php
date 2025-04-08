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
        return view('admin.users.index', compact('users'))->with('userType', 'all');
    }

    public function showInactiveUsers()
    {
        $users = $this->adminRepository->getInactiveUsers();
        return view('admin.users.index', compact('users'))->with('userType', 'inactive');
    }

    public function showAllInstructors()
    {
        $users = $this->adminRepository->getAllInstructors();
        return view('admin.users.index', compact('users'))->with('userType', 'instructors');
    }

    public function showAllStudents()
    {
        $users = $this->adminRepository->getAllStudents();
        return view('admin.users.index', compact('users'))->with('userType', 'students');
    }


    public function deleteUser($id)
    {
        $this->adminRepository->deleteUser($id);
        return response()->json(['message' => 'Utilisateur supprimé avec succès!']);
    }

    public function toggleStatus(Request $request)
    {
        $user = $this->adminRepository->toggleStatus($request->id);

        return response()->json([
            'success' => true,
            'new_status' => $user->status,
            'label' => $user->status === 'active' ? 'Actif' : 'Inactif',
            'badge_class' => $user->status === 'active' ? 'success' : 'danger',
        ]);
    }
}

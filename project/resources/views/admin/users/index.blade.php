
@extends('layouts.dashboard')

@section('title', 
$userType === 'inactive' ? 'Liste des utilisateurs inactifs' :
    ($userType === 'instructors' ? 'Liste des Formateur' :
    ($userType === 'students' ? 'Liste des étudiants' : 'Liste des utilisateurs'))
)

@push('styles')
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="{{ asset('assets/CSS/dashboard/admin/users.css') }}">
@endpush

@section('contents')
    <div class="d-flex align-items-center justify-content-between mb-4">
      
        @section('title',  $userType === 'inactive' ? 'Liste des utilisateurs inactifs' : ($userType === 'instructors' ? 'Liste des instructeurs' : ($userType === 'students' ? 'Liste des étudiants' : 'Liste des utilisateurs')))

        <h1>{{ $userType === 'inactive' ? 'Liste des utilisateurs inactifs' : ($userType === 'instructors' ? 'Liste des Formateur' : ($userType === 'students' ? 'Liste des étudiants' : 'Liste des utilisateurs')) }}</h1>
        
        <!-- Reste du code pour afficher les utilisateurs -->
        
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">{{ $userType === 'inactive' ? 'Liste des utilisateurs inactifs' : ($userType === 'instructors' ? 'Liste des Formateur' : ($userType === 'students' ? 'Liste des étudiants' : 'Liste des utilisateurs')) }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <table id="usersTable" class="table table-hover text-center align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nom complet</th>
                                    <th class="text-center">Avatar</th>
                                    <th class="text-center">Email</th>
                                    @if ($userType === 'all'|| $userType==='inactive')
                                    <th class="text-center">Rôle</th>
                                    @endif
                                    <th class="text-center">Statut</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="text-center">{{ $user->id }}</td>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">
                                        @if($user->profile && $user->profile->avatar)
                                        <img class="rounded-circle user-avatar" src="{{ asset('storage/' . $user->profile->avatar) }}" alt="{{ $user->name }}" style="width: 40px; height: 40px;">
                                        @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto" style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-secondary" aria-hidden="true"></i>
                                        </div>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    @if ($userType === 'all'|| $userType==='inactive')
                                     <td class="text-center">{{ ucfirst($user->role->name) }}</td>
                                    @endif
                                    <td class="text-center">
                                        <button class="badge border-0 bg-{{ $user->status == 'active' ? 'success' : 'danger' }} toggle-status-btn" 
                                            data-id="{{ $user->id }}" 
                                            data-name="{{ $user->name }}" 
                                            data-status="{{ $user->status }}"
                                            data-url="{{ route('admin.users.toggleStatus', $user->id) }}">
                                        {{ $user->status == 'active' ? 'Actif' : 'Inactif' }}
                                    </button>
                                    
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-action-group">
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#userModal-{{ $user->id }}">
                                                <i class="fas fa-eye fa-sm" aria-hidden="true"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm delete-user" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                                <i class="fas fa-trash fa-sm" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal Détails de l'utilisateur -->
                                @include('admin.users.show')
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
   @include('admin.users.delete')

    <!-- Modal Confirmation activation/désactivation des utilisateurs -->
   @include('admin.users.toggleStatus')
@endsection

@push('scripts')
<script src="{{ asset('assets/JS/dashboard/admin/users.js') }}"></script>

@endpush
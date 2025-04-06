
@extends('layouts.dashboard')

@section('title', 'Liste utilisateurs')

@push('styles')
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        /* Style général */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            border-bottom: none;
            padding: 1rem 1.25rem;
            border-radius: 15px 15px 0 0;
            font-weight: 600;
        }
        
        /* Style du tableau */
        .table-container {
            padding: 0.5rem;
            border-radius: 0.5rem;
        }
        
        #usersTable {
            width: 100% !important;
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        #usersTable thead th {
            background-color: #f8f9fa;
            color: #5a5c69;
            font-weight: 600;
            padding: 0.75rem;
            border-bottom: 2px solid #e3e6f0;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        #usersTable tbody td {
            vertical-align: middle;
            padding: 0.75rem;
            border-bottom: 1px solid #f1f1f1;
            font-size: 0.9rem;
        }
        
        #usersTable tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
            transition: all 0.2s ease;
        }
        
        /* Style des badges */
        .badge {
            padding: 0.5em 0.75em;
            font-weight: 500;
            font-size: 0.75rem;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .badge:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        /* Style des boutons d'action */
        .btn-action-group {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }
        
        .btn-sm {
            padding: 0.35rem 0.65rem;
            font-size: 0.75rem;
            border-radius: 5px;
            transition: all 0.2s ease;
        }
        
        .btn-sm:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        /* Style du champ de recherche */
        .dataTables_filter {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .dataTables_filter label {
            width: 100%;
            margin-bottom: 0;
            display: flex;
        }
        
        .dataTables_filter input {
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            border-radius: 50px;
            border: 1px solid #e3e6f0;
            width: 100% !important;
            max-width: 300px;
            font-size: 0.9rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            transition: all 0.3s ease;
            background-color: #f8f9fc;
        }
        
        .dataTables_filter input:focus {
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
            border-color: #bac8f3;
            outline: 0;
            background-color: #fff;
        }
        
        .dataTables_filter::before {
            content: "\f002";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 10;
        }
        
        /* Style du sélecteur de pagination */
        .dataTables_length {
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }
        
        .dataTables_length select {
            border-radius: 50px;
            padding: 0.5rem 2rem 0.5rem 1rem;
            margin: 0 0.5rem;
            border: 1px solid #e3e6f0;
            font-size: 0.9rem;
            background-color: #f8f9fc;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236c757d' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: calc(100% - 0.75rem) center;
            background-size: 12px;
        }
        
        .dataTables_length select:focus {
            border-color: #bac8f3;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
            background-color: #fff;
        }
        
        .dataTables_length label {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0;
        }
        
        /* Style pagination */
        .dataTables_paginate {
            margin-top: 1rem;
        }
        
        .dataTables_paginate .pagination {
            justify-content: center;
            gap: 0.25rem;
        }
        
        .page-item .page-link {
            border-radius: 5px;
            border: none;
            padding: 0.4rem 0.75rem;
            color: #4e73df;
            font-weight: 500;
            box-shadow: 0 1px 5px rgba(0,0,0,0.05);
        }
        
        .page-item.active .page-link {
            background-color: #4e73df;
            color: white;
        }
        
        .page-item.disabled .page-link {
            color: #6c757d;
            opacity: 0.5;
        }
        
        /* Avatar */
        .user-avatar {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        /* Alerte de notification */
        .notification-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            max-width: 350px;
            z-index: 9999;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-20px);
            opacity: 0;
            animation: slideIn 0.3s forwards;
        }
        
        @keyframes slideIn {
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        /* Style responsive */
        @media (max-width: 992px) {
            .table-container {
                overflow-x: auto;
            }
            
            #usersTable {
                min-width: 800px;
            }
        }
        
        @media (max-width: 768px) {
            .dataTables_filter input {
                max-width: 100%;
            }
            
            .dataTables_length, .dataTables_filter {
                justify-content: center;
                text-align: center;
            }
            
            .dataTables_length label {
                justify-content: center;
            }
            
            #usersTable_wrapper .row {
                flex-direction: column;
            }
            
            #usersTable_wrapper .col-sm-12.col-md-6 {
                width: 100%;
                max-width: 100%;
                flex: 0 0 100%;
            }
        }
    </style>
@endpush

@section('contents')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Liste utilisateurs</h1>
    </div>
    
    {{-- @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Liste des utilisateurs</h6>
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <table id="usersTable" class="table table-hover text-center align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom complet</th>
                                    <th>Avatar</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @if($user->profile && $user->profile->avatar)
                                        <img class="rounded-circle user-avatar" src="{{ asset('storage/' . $user->profile->avatar) }}" alt="{{ $user->name }}">
                                        @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto" style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-secondary" aria-hidden="true"></i>
                                        </div>
                                        @endif
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role->name) }}</td>
                                    <td>
                                        <button class="badge border-0 bg-{{ $user->status == 'active' ? 'success' : 'danger' }} toggle-status-btn" 
                                                data-id="{{ $user->id }}" 
                                                data-name="{{ $user->name }}" 
                                                data-status="{{ $user->status }}">
                                            {{ $user->status == 'active' ? 'Actif' : 'Inactif' }}
                                        </button>
                                    </td>
                                    <td>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialisation de DataTables
        const usersTable = $('#usersTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json",
                search: "_INPUT_",
                searchPlaceholder: "Rechercher un utilisateur...",
                lengthMenu: "Afficher _MENU_ éléments",
                info: "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
                paginate: {
                    first: "Premier",
                    last: "Dernier",
                    next: "Suivant",
                    previous: "Précédent"
                }
            },
            initComplete: function() {
                $('.dataTables_filter input').attr('placeholder', 'Rechercher un utilisateur...');
            }
        });
        
        // Fonction pour créer et afficher une notification
        function showNotification(message, type = 'success') {
            // Supprimer les notifications existantes
            $('.notification-alert').remove();
            
            // Créer l'alerte
            const alertClass = `alert-${type}`;
            const alertIcon = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
            
            const alert = `
                <div class="alert ${alertClass} alert-dismissible fade show notification-alert">
                    <i class="${alertIcon} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            
            // Ajouter l'alerte au DOM
            $('body').append(alert);
            
            // Supprimer automatiquement après 4 secondes
            setTimeout(() => {
                $('.notification-alert').fadeOut(300, function() {
                    $(this).remove();
                });
            }, 5000);
        }
        
        // Gestion de la suppression d'utilisateur
        $(document).on('click', '.delete-user', function() {
            const userId = $(this).data('id');
            const userName = $(this).data('name');
            
            $('#userNameToDelete').text(userName);
            $('#confirmDeleteBtn').data('id', userId);
            $('#confirmDeleteBtn').data('name', userName);
            
            $('#confirmDeleteModal').modal('show');
        });
        
        // Confirmer la suppression
        $('#confirmDeleteBtn').on('click', function() {
            const userId = $(this).data('id');
            const userName = $(this).data('name');
            
            if (userId) {
                $.ajax({
                    url: `/admin/users/delete/${userId}`,
                    type: "DELETE",
                    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                    success: function(response) {
                        $('#confirmDeleteModal').modal('hide');
                        
                        // Trouver et supprimer la ligne du tableau
                        usersTable.row($(`button.delete-user[data-id="${userId}"]`).closest('tr')).remove().draw();
                        
                        // Afficher la notification
                        showNotification(`L'utilisateur <strong>${userName}</strong> a été supprimé avec succès`, 'success');
                    },
                    error: function(xhr) {
                        showNotification("Une erreur est survenue lors de la suppression", 'danger');
                    }
                });
            }
        });
        
        // Gestion du changement de statut
        let userIdToToggle = null;
        let toggleButtonElement = null;
        
        $(document).on('click', '.toggle-status-btn', function() {
            userIdToToggle = $(this).data('id');
            toggleButtonElement = this;
            
            const userName = $(this).data('name');
            const currentStatus = $(this).data('status');
            const newStatus = currentStatus === 'active' ? 'inactif' : 'actif';
            
            $('#statusModalMessage').html(`Voulez-vous vraiment changer le statut de <strong>${userName}</strong> à <strong>${newStatus}</strong> ?`);
            
            $('#statusConfirmModal').modal('show');
        });
        
        // Confirmer le changement de statut
        $('#confirmStatusChangeBtn').on('click', function() {
            if (userIdToToggle && toggleButtonElement) {
                $.ajax({
                    url: "{{ route('users.toggleStatus') }}",
                    type: "POST",
                    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                    contentType: "application/json",
                    data: JSON.stringify({ id: userIdToToggle }),
                    success: function(data) {
                        if (data.success) {
                            // Mise à jour du bouton
                            $(toggleButtonElement).text(data.label);
                            $(toggleButtonElement).removeClass('bg-success bg-danger');
                            $(toggleButtonElement).addClass(`bg-${data.badge_class}`);
                            $(toggleButtonElement).data('status', data.new_status);
                            
                            // Fermer le modal
                            $('#statusConfirmModal').modal('hide');
                            
                            // Afficher la notification
                            showNotification(`Le statut de l'utilisateur <strong>${$(toggleButtonElement).data('name')}</strong> a été modifié avec succès`, 'success');
                        }
                    },
                    error: function(xhr) {
                        showNotification("Une erreur est survenue lors du changement de statut", 'danger');
                    }
                });
            }
        });
    });
</script>
@endpush


@extends('layouts.dashboard')

@section('title', 'Liste utilisateurs')

@push('styles')
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        /* Style général */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .card-header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            border-bottom: none;
            padding: 1rem 1.25rem;
        }
        
        .card-body {
            padding: 1.25rem;
        }
        
        /* Style du tableau */
        .table-container {
            overflow-x: auto;
            border-radius: 0.5rem;
            scrollbar-width: thin;
        }
        
        #usersTable {
            min-width: 600px;
            width: 100% !important;
            margin-bottom: 0;
        }
        
        #usersTable thead th {
            background-color: #f8f9fa;
            color: #5a5c69;
            font-weight: 600;
            padding: 0.75rem;
            border-bottom: 2px solid #e3e6f0;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
        }
        
        #usersTable tbody td {
            vertical-align: middle;
            padding: 0.75rem;
            border-bottom: 1px solid #f1f1f1;
            font-size: 0.9rem;
        }
        
        #usersTable tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }
        
        /* Style des badges */
        .badge {
            padding: 0.4em 0.65em;
            font-weight: 500;
            font-size: 0.75rem;
            border-radius: 30px;
        }
        
        /* Style des boutons d'action */
        .btn-action-group {
            display: flex;
            gap: 0.35rem;
            justify-content: flex-start;
            align-items: center;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 4px;
            font-weight: 500;
            white-space: nowrap;
        }
        
        .btn-action {
            width: auto;
            min-width: 2rem;
        }
        
        /* Style du champ de recherche */
        .dataTables_filter {
            position: relative;
            margin-bottom: 1rem;
        }
        
        .dataTables_filter label {
            width: 100%;
            margin-bottom: 0;
        }
        
        .dataTables_filter input {
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            border-radius: 30px;
            border: 1px solid #e3e6f0;
            width: 100% !important;
            max-width: 300px;
            font-size: 0.875rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: all 0.2s ease;
        }
        
        .dataTables_filter input:focus {
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
            border-color: #bac8f3;
            outline: 0;
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
            margin-bottom: 1rem;
        }
        
        .dataTables_length select {
            border-radius: 4px;
            padding: 0.25rem 1.5rem 0.25rem 0.5rem;
            margin: 0 0.5rem;
            border: 1px solid #e3e6f0;
            font-size: 0.875rem;
        }
        
        .dataTables_length label {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            font-size: 0.875rem;
        }
        
        /* Style pagination */
        .dataTables_paginate .pagination {
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.25rem;
        }
        
        /* Avatar */
        .user-avatar {
            width: 32px;
            height: 32px;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        /* Style responsive */
        @media (max-width: 768px) {
            .table-container {
                border: 1px solid #e9ecef;
                border-radius: 8px;
            }
            
            .dataTables_filter input {
                max-width: 100%;
            }
            
            .dataTables_length {
                text-align: center;
            }
            
            .dataTables_length label {
                justify-content: center;
            }
            
            .btn-sm {
                padding: 0.2rem 0.4rem;
                font-size: 0.7rem;
            }
        }
    </style>
@endpush

@section('contents')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Liste utilisateurs</h1>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h6 class="m-0 font-weight-bold">Liste des utilisateurs</h6>
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <table id="usersTable" class="table table-hover text-center align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">#</th>
                                    <th class="text-center align-middle">Nom complet</th>
                                    <th class="text-center align-middle">Avatar</th>
                                    <th class="text-center align-middle">Email</th>
                                    <th class="text-center align-middle">Rôle</th>
                                    <th class="text-center align-middle">Statut</th>
                                    <th class="text-center align-middle">Actions</th>
                                </tr>
                             </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td class="text-center align-middle">{{ $user->id }}</td>
                                        <td class="text-center align-middle">{{ $user->name }}</td>
                                        <td class="text-center align-middle">
                                            @if($user->profile && $user->profile->avatar)
                                            <img class="rounded-circle user-avatar" src="{{ asset('storage/' . $user->profile->avatar) }}" alt="{{ $user->name }}">
                                            @else
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                <i class="fas fa-user text-secondary fa-sm" aria-hidden="true"></i>
                                            </div>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">{{ $user->email }}</td>
                                        <td class="text-center align-middle">{{ ucfirst($user->role->name) }}</td>
                                        <td class="text-center align-middle">

                                            <button class="badge border-0 bg-{{ $user->status == 'active' ? 'success' : 'danger' }} toggle-status-btn" 
                                                    data-id="{{ $user->id }}" 
                                                    data-name="{{ $user->name }}" 
                                                    data-status="{{ $user->status }}">
                                                {{ $user->status == 'active' ? 'Actif' : 'Inactif' }}
                                            </button>
                                        </td>
                                        
                                        <td class="text-center align-middle">
                                            <div class="btn-action-group">
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#userModal-{{ $user->id }}">
                                                    <i class="fas fa-eye fa-xs" aria-hidden="true"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm delete-user" data-id="{{ $user->id }}">
                                                    <i class="fas fa-trash fa-xs" aria-hidden="true"></i>
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


    <!-- Modal Confirmation activation ces users-->
<div class="modal fade" id="statusConfirmModal" tabindex="-1" aria-labelledby="statusConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title" id="statusConfirmModalLabel">Confirmation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <p id="statusModalMessage"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-primary btn-sm" id="confirmStatusChangeBtn">Confirmer</button>
        </div>
      </div>
    </div>
  </div>
  
    
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>

    $(document).ready(function() {
        $('#usersTable').DataTable({
            responsive: false,
            scrollX: true,
            pageLength: 3, // Affiche 5 éléments par défaut
            lengthMenu: [3, 5, 10, 15, 20, 40, 100], // Options disponibles
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json",
                search: "_INPUT_",
                searchPlaceholder: "Rechercher...",
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
                $('.dataTables_filter input').attr('placeholder', 'Rechercher...');
            }
        });
        
        // Ouvrir le modal de confirmation de suppression
        $(document).on('click', '.delete-user', function(){
            let userId = $(this).data('id');
            $('#confirmDeleteModal').modal('show'); // Afficher le modal
            $('#confirmDeleteBtn').data('id', userId); // Enregistrer l'ID de l'utilisateur à supprimer
        });

        // Confirmer la suppression
        $('#confirmDeleteBtn').on('click', function() {
            let userId = $(this).data('id');
            if (userId !== null) {
                $.ajax({
                    url: "/admin/users/delete/" + userId,
                    type: "DELETE",
                    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                    success: function(response) {
                        $('#confirmDeleteModal').modal('hide');
                        location.reload();
                    }
                });
            }
        });
    });



    // --------------------------
// Ouvrir le modal de confirmation de changement de status
let userIdToToggle = null;
let toggleButtonElement = null;

document.querySelectorAll('.toggle-status-btn').forEach(button => {
    button.addEventListener('click', function () {
        userIdToToggle = this.dataset.id;
        toggleButtonElement = this;

        const userName = this.dataset.name;
        const currentStatus = this.dataset.status;
        const newStatus = currentStatus === 'active' ? 'inactif' : 'actif';

        document.getElementById('statusModalMessage').innerText =
            `Voulez-vous vraiment changer le statut de "${userName}" à "${newStatus}" ?`;

        const statusModal = new bootstrap.Modal(document.getElementById('statusConfirmModal'));
        statusModal.show();
    });
});

// --------- -----------------
// Confirmer le changement de status
document.getElementById('confirmStatusChangeBtn').addEventListener('click', function () {
    if (userIdToToggle && toggleButtonElement) {
        fetch("{{ route('users.toggleStatus') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: userIdToToggle })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Mise à jour du bouton
                toggleButtonElement.textContent = data.label;
                toggleButtonElement.classList.remove('bg-success', 'bg-danger');
                toggleButtonElement.classList.add(`bg-${data.badge_class}`);
                toggleButtonElement.dataset.status = data.new_status;

                // Fermer le modal
                const modalElement = document.getElementById('statusConfirmModal');
                const statusModal = bootstrap.Modal.getOrCreateInstance(modalElement);
                statusModal.hide();


                // Afficher une alerte Bootstrap
                const alertBox = document.createElement('div');
                alertBox.className = 'alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3';
                alertBox.setAttribute('role', 'alert');
                alertBox.style.zIndex = '1055';

                alertBox.innerHTML = `
                    <i class="fas fa-check-circle me-2"></i>
                    Statut de l'utilisateur <strong>${toggleButtonElement.dataset.name}</strong> changé avec succès !
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                `;

                document.body.appendChild(alertBox);

                //  Supprimer l'alerte après 3 secondes
                setTimeout(() => {
                    alertBox.classList.remove('show');
                    alertBox.classList.add('hide');
                    setTimeout(() => alertBox.remove(), 500);
                }, 3000);
            }
        })
        .catch(err => console.error(err));
    }
});


</script>
@endpush
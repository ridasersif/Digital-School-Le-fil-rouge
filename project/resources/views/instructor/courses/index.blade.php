@extends('layouts.dashboard')

@section('title', 'listes des cours')
@push('styles')
{{-- <link rel="stylesheet" href="{{ asset('assets/CSS/auth/auth.css') }}"> --}}
@endpush
@section('contents')

   <!-- Bouton pour ouvrir le modal -->
   
    @if(session('success'))
        <div class="alert alert-success" role="alert" id="successAlert">
            {{ session('success') }}
        </div>
    @endif
   
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0">Listes des cours</h1>
            <a href="{{route('instructor.course.create')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" >
                <i class="fas fa-plus-circle fa-sm text-white-50"></i> Créer un cours
            </a>
        </div>
        <div class="row">
            <!-- categories -->
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Toutes les cours</h6>
                            <div class="input-group w-50">
                                <span class="input-group-text border-end-0">
                                    <i class="fas fa-search text-primary"></i>
                                </span>
                                <input type="text" class="form-control t border-start-0" 
                                       placeholder="Rechercher un cours..." 
                                       aria-label="Rechercher" 
                                       id="searchInput">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped text-center" id="coursTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Titre</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Nombre de contenus</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $cours)
                                        <tr>
                                            <td>{{ $cours->id }}</td>
                                            <td>{{ $cours->titre }}</td>
                                           
                                            <td>{{ $cours->price }}</td>
                                            <td><img src="{{ asset('storage/' . $cours->image) }}" alt="Image" width="80" height="80"  class="rounded shadow-sm"></td>
                                            <!-- Modifiez la partie du badge de statut pour le rendre cliquable -->
                                            <td>
                                                @php
                                                    $statusClass = match($cours->status) {
                                                        'published' => 'bg-success',
                                                        'pending' => 'bg-warning text-dark',
                                                        'draft' => 'bg-secondary',
                                                    };
                                                
                                                    $statusText = match($cours->status) {
                                                        'published' => 'Publié',
                                                        'pending' => 'En attente',
                                                        'draft' => 'Brouillon',
                                                    };
                                                @endphp

                                                <!-- Badge cliquable seulement pour le statut brouillon -->
                                                    @if($cours->status == 'draft'|| $cours->status == 'pending')
                                                        <span class="badge {{ $statusClass }} rounded-pill px-3 py-2 status-badge" 
                                                            style="cursor: pointer;" 
                                                            data-course-id="{{ $cours->id }}" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#statusModal-{{ $cours->id }}">
                                                            {{ $statusText }}
                                                        </span>
                                                    @else
                                                        <span class="badge {{ $statusClass }} rounded-pill px-3 py-2 status-badge" >
                                                        {{ $statusText }}
                                                        </span>
                                                    @endif
                                                <!-- Modal pour confirmer le changement de statut -->
                                                <div class="modal fade" id="statusModal-{{ $cours->id }}" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="statusModalLabel">Confirmation de modification</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if($cours->status == 'draft')
                                                                    <p class="text-center">
                                                                        Voulez-vous soumettre ce cours pour examen ? Le statut sera changé de <strong>"Brouillon"</strong> à <strong>"En attente"</strong>.
                                                                    </p>
                                                                @else
                                                                    <p class="text-center">
                                                                        Voulez-vous annuler la soumission de ce cours ? Le statut sera changé de <strong>"En attente"</strong> à <strong>"Brouillon"</strong>.
                                                                    </p>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer justify-content-center border-top-0">
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                <!-- Formulaire pour changer le statut -->
                                                                <form method="POST" action="{{ route('instructor.course.updateStatus', $cours->id) }}">
                                                                    @csrf
                                                                    <input type="hidden" name="status" value="pending">
                                                                    <button type="submit" class="btn btn-primary">Confirmer</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>


                                            <td>{{ $cours->contents_count }}</td>
                                            
                                            <!-- Action Icons -->
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <!-- Voir -->
                                                    <a href="{{ route('instructor.course.show', $cours->id) }}" class="btn btn-sm btn-outline-info rounded-circle mx-1" data-bs-toggle="tooltip" title="Voir">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                        
                                                    <!-- Modifier -->
                                                    <a href="{{ route('instructor.course.edit', $cours->id) }}" class="btn btn-sm btn-outline-warning rounded-circle mx-1" data-bs-toggle="tooltip" title="Modifier">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                        
                                                    <!-- Supprimer -->
                                                                                                
                                                    <a href="#" class="btn btn-sm btn-outline-danger rounded-circle mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $cours->id }}" data-bs-toggle="tooltip" title="Supprimer">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>

                                                  
                                                  <!-- Modal de Confirmation -->
                                                <div class="modal fade" id="deleteModal-{{ $cours->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header ">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="text-center mb-3">
                                                                    <i class="bi bi-exclamation-triangle text-warning display-4"></i>
                                                                </div>
                                                                <p class="text-center">Êtes-vous sûr de vouloir supprimer ce cours ?<br>Cette action est irréversible.</p>
                                                            </div>
                                                            <div class="modal-footer justify-content-center border-top-0">
                                                                <form action="{{ route('instructor.course.destroy', $cours->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                    <button type="submit" class="btn btn-danger ms-2">Supprimer</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <!-- end Modal de Confirmation -->


                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $courses->links() }}
                        </div>
                    </div>
                </div>
                
                <!-- Script pour initialiser les tooltips et la fonctionnalité de recherche -->
              
            </div>
        </div>

    
 
<script>
    let selectedCourseId = null;

    document.querySelectorAll('.change-status').forEach(badge => {
        badge.addEventListener('click', () => {
            const status = badge.getAttribute('data-current-status');

            // Vérifie si c’est encore un brouillon
            if (status === 'draft') {
                selectedCourseId = badge.getAttribute('data-id');
                const modal = new bootstrap.Modal(document.getElementById('confirmStatusModal'));
                modal.show();
            }
        });
    });

    document.getElementById('confirmChangeBtn').addEventListener('click', () => {
        if (selectedCourseId) {
            fetch(`/instructor/course/change-status/${selectedCourseId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ status: 'pending' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mise à jour directe sans reload
                    const badge = document.querySelector(`.change-status[data-id='${selectedCourseId}']`);
                    badge.classList.remove('bg-secondary');
                    badge.classList.add('bg-warning', 'text-dark');
                    badge.innerText = 'En attente';
                    badge.setAttribute('data-current-status', 'pending');

                    const modal = bootstrap.Modal.getInstance(document.getElementById('confirmStatusModal'));
                    modal.hide();
                }
            });
        }
    });
</script>



  
        
  

   
@endsection

@push('scripts')
<script src="{{ asset('assets/JS/dashboard/admin/categories.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser les tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Fonction de recherche simple
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const table = document.getElementById('coursTable');
            const rows = table.getElementsByTagName('tr');
            
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;
                
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].textContent.toLowerCase().indexOf(searchValue) > -1) {
                        found = true;
                        break;
                    }
                }
                
                row.style.display = found ? '' : 'none';
            }
        });

        // Gestionnaire pour le changement de statut
        // document.querySelectorAll('.update-status').forEach(button => {
        //     button.addEventListener('click', function() {
        //         const courseId = this.getAttribute('data-course-id');
                
        //         // Requête fetch pour mettre à jour le statut
        //         fetch(`/instructor/course/${courseId}/update-status`, {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        //             },
        //             body: JSON.stringify({
        //                 status: 'pending'
        //             })
        //         })
        //         .then(response => {
        //             if (!response.ok) {
        //                 throw new Error('Erreur lors de la mise à jour');
        //             }
        //             return response.json();
        //         })
        //         .then(data => {
        //             if (data.success) {
        //                 // Mettre à jour l'affichage du badge sans rechargement
        //                 const badgeElement = document.querySelector(`span.status-badge[data-course-id="${courseId}"]`);
        //                 badgeElement.classList.remove('bg-secondary');
        //                 badgeElement.classList.add('bg-warning', 'text-dark');
        //                 badgeElement.textContent = 'En attente';
        //                 badgeElement.removeAttribute('data-bs-toggle');
        //                 badgeElement.removeAttribute('data-bs-target');
        //                 badgeElement.style.cursor = 'default';
                        
        //                 // Afficher un message de succès
        //                 const alertDiv = document.createElement('div');
        //                 alertDiv.className = 'alert alert-success';
        //                 alertDiv.role = 'alert';
        //                 alertDiv.id = 'successAlert';
        //                 alertDiv.textContent = 'Le statut du cours a été mis à jour avec succès.';
                        
        //                 const container = document.querySelector('.d-flex.align-items-center.justify-content-between.mb-4');
        //                 container.parentNode.insertBefore(alertDiv, container);
                        
        //                 // Faire disparaître l'alerte après 3 secondes
        //                 setTimeout(() => {
        //                     alertDiv.remove();
        //                 }, 3000);
        //             }
        //         })
        //         .catch(error => {
        //             console.error('Erreur:', error);
        //             alert('Une erreur est survenue lors de la mise à jour du statut.');
        //         });
        //     });
        // });
    });
</script>
@endpush
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
                                        <th>Formateur</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $cours)
                                        <tr>
                                            <td>{{ $cours->id }}</td>
                                            <td>{{ $cours->titre }}</td>
                                            <td>{{ $cours->formateur->user->name}}</td>
                                           
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
                                                        <span class="badge {{ $statusClass }} rounded-pill px-3 py-2 status-badge" 
                                                            style="cursor: pointer;" 
                                                            data-course-id="{{ $cours->id }}" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#statusModal-{{ $cours->id }}">
                                                            {{ $statusText }}
                                                        </span>
                                                   
                                                <!-- Modal pour confirmer le changement de statut -->
                                                <div class="modal fade" id="statusModal-{{ $cours->id }}" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="statusModalLabel">Confirmation de modification</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if($cours->status == 'pending')
                                                                    <p class="text-center">
                                                                        Voulez-vous soumettre ce cours pour examen ? Le statut sera changé de <strong>"En attente"</strong> à <strong>"Publié"</strong>.
                                                                    </p>
                                                                @else
                                                                    <p class="text-center">
                                                                        Voulez-vous annuler la soumission de ce cours ? Le statut sera changé de <strong>"Publié"</strong> à <strong>"En attente"</strong>.
                                                                    </p>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer justify-content-center border-top-0">
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                <!-- Formulaire pour changer le statut -->
                                                                <form method="POST" action="{{ route('course.updateStatus', $cours->id) }}">
                                                                    @csrf
                                                                    <input type="hidden" name="status" value="pending">
                                                                    <button type="submit" class="btn btn-primary">Confirmer</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>


                                          
                                            
                                            <!-- Action Icons -->
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <!-- Voir -->
                                                    <a href="{{ route('course.show', $cours->id) }}" class="btn btn-sm btn-outline-info rounded-circle mx-1" data-bs-toggle="tooltip" title="Voir">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
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

    
 




  
        
  

   
@endsection

@push('scripts')
{{-- <script src="{{ asset('assets/JS/dashboard/admin/categories.js') }}"></script> --}}

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
    });
</script>
@endpush
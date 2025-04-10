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
                                        {{-- <th>Description</th> --}}
                                        {{-- <th>Category</th> --}}
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
                                            {{-- <td>{{ $cours->description }}</td>
                                            <td>{{ $cours->category->nom }}</td> --}}
                                            <td>{{ $cours->price }}</td>
                                            <td><img src="{{ asset('storage/' . $cours->image) }}" alt="Image" width="80" height="80"  class="rounded shadow-sm"></td>
                                            <td>
                                                {{-- $table->enum('status', ['draft', 'pending', 'published'])->default('draft'); --}}
                                                {{-- <span class="badge {{ $cours->status == 'published' ? 'bg-success' : 'bg-secondary' }} rounded-pill px-3 py-2">
                                                    {{ $cours->status }}
                                                </span> --}}

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
                                        
                                                <span class="badge {{ $statusClass }} rounded-pill px-3 py-2">
                                                    {{ $statusText }}
                                                </span>

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
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Êtes-vous sûr de vouloir supprimer ce cours ? Cette action est irréversible.</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('instructor.course.destroy', $cours->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

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
    });
</script>
@endpush
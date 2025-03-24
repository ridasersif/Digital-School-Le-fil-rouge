@extends('layouts.dashboard')

@section('title', 'categories')
@push('styles')
{{-- <link rel="stylesheet" href="{{ asset('assets/CSS/auth/auth.css') }}"> --}}
@endpush
@section('contents')

   <!-- Bouton pour ouvrir le modal -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Catégories</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus-circle fa-sm text-white-50"></i> Ajouter catégorie
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success" role="alert" id="successAlert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Modal d'ajout de catégorie -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Ajouter une catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" id="categoryForm">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de la catégorie</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}">
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icône de la catégorie</label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" placeholder="Recherchez une icône..." autocomplete="off">
                            <div id="iconSuggestions" class="list-group position-absolute w-100 mt-1" style="z-index: 1000;"></div>
                        </div>
                            @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        <div class="text-center mt-3">
                            <i id="iconPreview" class="fs-2"></i>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                    <div id="message" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any()  && !session('is_update') )
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
            myModal.show();
        });
    </script>
    @endif

    @if ($errors->any() && session('is_update'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.querySelector('.updatecategoryModal'));
            myModal.show();
        });
    </script>
    @endif
   
        <!-- Top Courses & Students Row -->
        <div class="row">
            <!-- categories -->
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 text-center">
                        <h6 class="m-0 font-weight-bold text-primary">Toutes les catégories</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Titre</th>
                                        <th>Description</th>
                                        <th>Icon</th>
                                        <th>Voir</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr id="category-{{ $category->id }}">
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->nom }}</td>
                                        <td>{{ Str::limit($category->description, 30, '...') }}</td>
                                        <td>
                                            <iconify-icon icon="{{ $category->icon }}" width="24" height="24"></iconify-icon>
                                        </td>
                                        <!-- Voir Button -->
                                        <td>
                                            <button class="btn btn-info btn-xs" data-bs-toggle="modal" data-bs-target="#categoryModal-{{ $category->id }}">
                                                Voir
                                            </button>
                                        </td>
                                        <!-- Modifier Button -->
                                        <td>
                                            <button class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#updatecategoryModal-{{ $category->id }}">
                                                Modifier
                                            </button>
                                        </td>
                                        <!-- Supprimer Button -->
                                        <td>
                                            <button class="btn btn-danger btn-xs" data-id="{{ $category->id }}" onclick="deleteCategory(event)">
                                                Supprimer
                                            </button>
                                        </td>
                                    </tr>
        
                                    <!-- Modal pour chaque catégorie -->
                                    @include('admin.categories.show')
                                    <!-- end Modal pour chaque category -->
        
                                    <!-- Modal pour update catégorie -->
                                    @include('admin.categories.update')
                                    <!-- end Modal update category -->
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
@endsection

@push('scripts')
<script src="{{ asset('assets/JS/dashboard/admin/categories.js') }}"></script>
@endpush
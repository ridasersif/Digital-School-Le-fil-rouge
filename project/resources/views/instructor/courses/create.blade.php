@extends('instructor.courses.cours')

@section('title', 'Créer un cours')
@push('styles')
{{-- <link rel="stylesheet" href="{{ asset('assets/CSS/auth/auth.css') }}"> --}}
@endpush
@section('courses')

   <!-- Bouton pour ouvrir le modal -->
   
    @if(session('success'))
        <div class="alert alert-success" role="alert" id="successAlert">
            {{ session('success') }}
        </div>
    @endif
 
   
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0">Ajouter un cours</h1>
            <a href="{{route('instructor.courses.index')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class=" "></i> Router vers la liste des cours
            </a>
        </div>
        
                <div class="creation-card card">
                    <div class="card-body p-4">
                        <!-- Indicateur d'étapes amélioré -->
                        <div class="steps-progress">
                            <div class="step-item active" data-step="1">
                                <div class="step-circle">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="step-title">Informations de base</div>
                            </div>
                            <div class="step-item" data-step="2">
                                <div class="step-circle">
                                    <i class="fas fa-plus-circle"></i>
                                </div>
                                <div class="step-title">Ajouter du contenu</div>
                            </div>
                            <div class="step-item" data-step="3">
                                <div class="step-circle">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="step-title">Revue et publication</div>
                            </div>
                        </div>
                        
                        <h3 class="card-title">Créer un nouveau cours</h3>
                        
                        <!-- Étape 1: Informations de base -->
                        <div id="step1" class="step-content active">
                            <form id="createCourseForm" method="POST" action="{{ route('instructor.courses.store') }}" enctype="multipart/form-data">
                                @csrf
                            
                                <!-- Titre -->
                                <div class="mb-3">
                                    <label class="form-label">Titre du cours</label>
                                    <input type="text" name="titre" class="form-control @error('titre') is-invalid @enderror" placeholder="Entrez un titre attractif pour le cours">
                                    @error('titre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <!-- Description -->
                                <div class="mb-3">
                                    <label class="form-label">Description du cours</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Décrivez le contenu et les objectifs du cours"></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <!-- Category -->
                                
                                    <div class=" mb-3">
                                        <label class="form-label">Catégorie</label>
                                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                            <option value="">Choisir une catégorie</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->nom}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                       
                            
                                <!-- Prix -->
                                <div class="mb-3">
                                    <label class="form-label">Prix du cours (MAD)</label>
                                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Ex: 199" min="0">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <!-- Vidéo d’introduction -->
                                <div class="mb-3">
                                    <label class="form-label">Vidéo d’introduction</label>
                                    <input type="file" name="video_intro" class="form-control @error('video_intro') is-invalid @enderror" accept="video/*">
                                    @error('video_intro')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <!-- Image de couverture -->
                                <div class="mb-4">
                                    <label class="form-label">Image de couverture</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                    <div class="form-text">Taille recommandée : 1280×720 pixels</div>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <!-- Hidden Formateur ID -->
                                <input type="hidden" name="formateur_id" value="{{ auth()->user()->id }}">
                            
                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmationModal">
                                        Enregistrer <i class="fas fa-save ms-1"></i>
                                    </button>
                                </div>
                            
                                <!-- Modal -->
                                <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content border-0">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmationModalLabel">Enregistrement du cours</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                            </div>
                                            <div class="modal-body text-secondary">
                                                Ce cours sera <strong>enregistré comme brouillon</strong> dans la base de données. <br>
                                                Vous pourrez le modifier ou le compléter plus tard. <br><br>
                                                <small class="text-muted">Personne d’autre n’y aura accès pour l’instant.</small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            
                        </div>
                       
                    </div>
                </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
@endsection

@push('scripts')
<script src="{{ asset('assets/JS/dashboard/admin/categories.js') }}"></script>
@endpush
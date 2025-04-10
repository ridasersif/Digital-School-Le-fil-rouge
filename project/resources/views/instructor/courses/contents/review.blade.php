@extends('instructor.courses.cours')

@section('title', 'Publier un cours')
@push('styles')
{{-- <link rel="stylesheet" href="{{ asset('assets/CSS/auth/auth.css') }}"> --}}
@endpush
@section('courses')

   <!-- Bouton pour ouvrir le modal -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0">Publier un cours</h1>
           
        </div>
        
                <div class="creation-card card">
                    <div class="card-body p-4">
                        <!-- Indicateur d'étapes amélioré -->
                        <div class="steps-progress">
                            <div class="step-item " data-step="1">
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
                            <div class="step-item active" data-step="3">
                                <div class="step-circle">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="step-title">Revue et publication</div>
                            </div>
                        </div>
                        <!-- Étape 3: Revue finale -->
                        <div id="step3" class="step-content">
                            <div class="review-header">
                                <i class="fas fa-check-circle review-icon" style="color: green"></i>
                                <h3 style="color: var(--primary-color);">Prêt à publier !</h3>
                                <p class="text-muted">Revoyez les informations du cours avant publication</p>
                            </div>
                            
                            <div class="review-card">
                                <h5 class="review-title">Informations du cours</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="review-item">
                                            <div class="review-label">Titre :</div>
                                            <div class="review-value" id="reviewTitle">--</div>
                                        </div>
                                        <div class="review-item">
                                            <div class="review-label">Catégorie :</div>
                                            <div class="review-value" id="reviewCategory">--</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="review-item">
                                            <div class="review-label">Niveau :</div>
                                            <div class="review-value" id="reviewLevel">--</div>
                                        </div>
                                        <div class="review-item">
                                            <div class="review-label">Nombre d'éléments :</div>
                                            <div class="review-value" id="reviewItems">0</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Statut du cours</label>
                                <select class="form-select">
                                    <option value="draft">Enregistrer comme brouillon</option>
                                    <option value="publish">Publier maintenant</option>
                                </select>
                            </div>
                            
                            <div class="nav-buttons">
                                <a href="{{route('instructor.contents.index')}}" id="backToStep2" class="btn back-btn">
                                    <i class="fas fa-arrow-left me-2"></i> Précédent
                                </a>
                                <a href="" id="publishBtn" class="btn next-btn">
                                    <i class="fas fa-check me-2"></i> Finaliser le cours
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
@endsection

@push('scripts')
<script src="{{ asset('assets/JS/dashboard/admin/categories.js') }}"></script>
@endpush
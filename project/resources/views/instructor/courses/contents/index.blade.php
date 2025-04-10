{{-- @extends('instructor.courses.cours')

@section('title', 'Créer un contenu')
@push('styles')

@endpush
@section('courses')

   <!-- Bouton pour ouvrir le modal -->
   
    @if(session('success'))
        <div class="alert alert-success" role="alert" id="successAlert">
            {{ session('success') }}
        </div>
    @endif
 
   
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0">Ajouter un contenu</h1>
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
                            <div class="step-item active"  data-step="2">
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
                        
                        
                        <!-- Étape 2: Ajout de contenu -->
                        <div id="step2" class="step-content">
                            <div class="text-center mb-4">
                                <h4 style="color: var(--primary-color);">Choisissez le type de contenu à ajouter</h4>
                                <p class="text-muted">Vous pouvez ajouter des vidéos et des fichiers PDF au cours</p>
                            </div>
                            
                            <div class="content-cards">
                                <div class="content-type-btn video-btn" data-type="video" onclick="window.location.href='{{ route('instructor.contents.create') }}'">
                                    <i class="fas fa-video"></i>
                                    <h5>Vidéo</h5>
                                    <p class="text-muted">Ajouter une vidéo pédagogique</p>
                                </div>
                                <div class="content-type-btn pdf-btn" data-type="pdf" onclick="window.location.href='{{ route('instructor.contents.create') }}'">
                                    <i class="fas fa-file-pdf"></i>
                                    <h5>Fichier PDF</h5>
                                    <p class="text-muted">Ajouter un document PDF</p>
                                </div>
                                
                            </div>
                            
                            <!-- Contenu ajouté -->
                            <div id="addedContentSection" class="added-content-section">
                                <div class="added-content-header">
                                    <h5>Contenu ajouté</h5>
                                    <div class="added-count">
                                        <span id="contentCount">0</span> éléments
                                    </div>
                                </div>
                                
                                <div id="contentList">
                                    <div class="empty-content">
                                        <i class="fas fa-folder-open"></i>
                                        <p>Aucun contenu ajouté pour le moment</p>
                                        <p class="small">Choisissez un type de contenu ci-dessus pour l'ajouter au cours</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="nav-buttons">
                                <a href="{{route('instructor.courses.create')}}"id="backToStep1" class="btn back-btn">
                                    <i class="fas fa-arrow-left me-2"></i> Précédent
                                </a>
                                <a href="{{route('instructor.contents.review')}}" id="goToStep3" class="btn next-btn">
                                    Suivant <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@push('scripts')
<script src="{{ asset('assets/JS/dashboard/admin/categories.js') }}"></script>
@endpush --}}


@extends('instructor.courses.cours')

@section('title', 'Créer un contenu')
@push('styles')
<style>
    /* Styles pour les modals */
    .modal-content {
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .modal-header {
        background-color: var(--primary-color);
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 15px 20px;
    }
    
    .modal-header .btn-close {
        filter: invert(1);
    }
    
    .modal-body {
        padding: 25px;
    }
    
    .form-label {
        font-weight: 500;
        margin-bottom: 8px;
    }
    
    /* Styles pour les onglets */
    .nav-tabs {
        border-bottom: 2px solid #dee2e6;
        margin-bottom: 20px;
    }
    
    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 500;
        padding: 10px 20px;
    }
    
    .nav-tabs .nav-link.active {
        color: var(--primary-color);
        border-bottom: 3px solid var(--primary-color);
        background: transparent;
    }
    
    /* Bouton d'ajout */
    .btn-add {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-add:hover {
        background-color: #0d6efd;
        transform: translateY(-2px);
    }
    
    /* Style pour le champ fichier */
    .file-upload {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }
    
    .file-upload-input {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }
    
    .file-upload-label {
        display: block;
        padding: 40px 20px;
        border: 2px dashed #ddd;
        border-radius: 5px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .file-upload-label:hover {
        border-color: var(--primary-color);
        background-color: rgba(13, 110, 253, 0.05);
    }
    
    .file-upload-icon {
        font-size: 40px;
        color: var(--primary-color);
        margin-bottom: 10px;
    }
</style>
@endpush
@section('courses')

    @if(session('success'))
        <div class="alert alert-success" role="alert" id="successAlert">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Ajouter un contenu</h1>
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
                <div class="step-item active"  data-step="2">
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
            
            <!-- Étape 2: Ajout de contenu -->
            <div id="step2" class="step-content">
                <div class="text-center mb-4">
                    <h4 style="color: var(--primary-color);">Choisissez le type de contenu à ajouter</h4>
                    <p class="text-muted">Vous pouvez ajouter des vidéos et des fichiers PDF au cours</p>
                </div>
                
                <div class="content-cards">
                    <!-- Bouton pour ouvrir le modal Vidéo -->
                    <div class="content-type-btn video-btn" data-type="video" data-bs-toggle="modal" data-bs-target="#contentModal">
                        <i class="fas fa-video"></i>
                        <h5>Vidéo</h5>
                        <p class="text-muted">Ajouter une vidéo pédagogique</p>
                    </div>
                    
                    <!-- Bouton pour ouvrir le modal PDF -->
                    <div class="content-type-btn pdf-btn" data-type="pdf" data-bs-toggle="modal" data-bs-target="#contentModal">
                        <i class="fas fa-file-pdf"></i>
                        <h5>Fichier PDF</h5>
                        <p class="text-muted">Ajouter un document PDF</p>
                    </div>
                </div>
                
                <!-- Contenu ajouté -->
                <div id="addedContentSection" class="added-content-section">
                    <div class="added-content-header">
                        <h5>Contenu ajouté</h5>
                        <div class="added-count">
                            <span id="contentCount">0</span> éléments
                        </div>
                    </div>
                    
                    <div id="contentList">
                        <div class="empty-content">
                            <i class="fas fa-folder-open"></i>
                            <p>Aucun contenu ajouté pour le moment</p>
                            <p class="small">Choisissez un type de contenu ci-dessus pour l'ajouter au cours</p>
                        </div>
                    </div>
                </div>
                
                <div class="nav-buttons">
                    <a href="{{route('instructor.courses.create')}}"id="backToStep1" class="btn back-btn">
                        <i class="fas fa-arrow-left me-2"></i> Précédent
                    </a>
                    <a href="{{route('instructor.contents.review')}}" id="goToStep3" class="btn next-btn">
                        Suivant <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour ajouter du contenu -->
    <div class="modal fade" id="contentModal" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contentModalLabel">Ajouter un nouveau contenu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="contentTypeTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="video-tab" data-bs-toggle="tab" data-bs-target="#video-tab-pane" type="button" role="tab" aria-controls="video-tab-pane" aria-selected="true">
                                <i class="fas fa-video me-2"></i>Vidéo
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pdf-tab" data-bs-toggle="tab" data-bs-target="#pdf-tab-pane" type="button" role="tab" aria-controls="pdf-tab-pane" aria-selected="false">
                                <i class="fas fa-file-pdf me-2"></i>PDF
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="contentTypeTabsContent">
                        <!-- Formulaire pour les vidéos -->
                        <div class="tab-pane fade show active" id="video-tab-pane" role="tabpanel" aria-labelledby="video-tab" tabindex="0">
                            <form id="videoForm">
                                <div class="mb-3">
                                    <label for="videoTitle" class="form-label">Titre de la vidéo</label>
                                    <input type="text" class="form-control" id="videoTitle" placeholder="Ex: Introduction au cours" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="videoDescription" class="form-label">Description</label>
                                    <textarea class="form-control" id="videoDescription" rows="3" placeholder="Décrivez le contenu de cette vidéo"></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="videoDuration" class="form-label">Durée de la vidéo (minutes)</label>
                                    <input type="number" class="form-control" id="videoDuration" placeholder="Ex: 15" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Fichier vidéo</label>
                                    <div class="file-upload">
                                        <input type="file" id="videoFile" class="file-upload-input" accept="video/*" required>
                                        <label for="videoFile" class="file-upload-label">
                                            <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                            <p>Cliquez pour télécharger ou glissez-déposez votre vidéo</p>
                                            <small class="text-muted">Formats supportés: MP4, AVI, MOV (Max 500MB)</small>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-add">
                                        <i class="fas fa-plus me-2"></i>Ajouter la vidéo
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Formulaire pour les PDF -->
                        <div class="tab-pane fade" id="pdf-tab-pane" role="tabpanel" aria-labelledby="pdf-tab" tabindex="0">
                            <form id="pdfForm">
                                <div class="mb-3">
                                    <label for="pdfTitle" class="form-label">Titre du document</label>
                                    <input type="text" class="form-control" id="pdfTitle" placeholder="Ex: Support de cours" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="pdfDescription" class="form-label">Description</label>
                                    <textarea class="form-control" id="pdfDescription" rows="3" placeholder="Décrivez le contenu de ce document"></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="pdfPages" class="form-label">Nombre de pages</label>
                                    <input type="number" class="form-control" id="pdfPages" placeholder="Ex: 12" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Fichier PDF</label>
                                    <div class="file-upload">
                                        <input type="file" id="pdfFile" class="file-upload-input" accept=".pdf" required>
                                        <label for="pdfFile" class="file-upload-label">
                                            <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                            <p>Cliquez pour télécharger ou glissez-déposez votre PDF</p>
                                            <small class="text-muted">Format supporté: PDF (Max 20MB)</small>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-add">
                                        <i class="fas fa-plus me-2"></i>Ajouter le PDF
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion de l'affichage du modal avec le bon onglet selon le type de contenu
        document.querySelectorAll('.content-type-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const contentType = this.getAttribute('data-type');
                const tab = document.querySelector(`#${contentType}-tab`);
                
                if (tab) {
                    const tabInstance = new bootstrap.Tab(tab);
                    tabInstance.show();
                }
            });
        });
        
        // Gestion de la soumission des formulaires
        document.getElementById('videoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Ici tu peux ajouter la logique pour traiter l'ajout de vidéo
            alert('Vidéo ajoutée avec succès!');
            $('#contentModal').modal('hide');
            // Mettre à jour la liste des contenus
        });
        
        document.getElementById('pdfForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Ici tu peux ajouter la logique pour traiter l'ajout de PDF
            alert('PDF ajouté avec succès!');
            $('#contentModal').modal('hide');
            // Mettre à jour la liste des contenus
        });
    });
</script>
@endpush
@extends('layouts.dashboard')

@section('title', 'Categories')
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
   <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
        
        /* :root {
            --primary-color: #3a86ff;
            --secondary-color: #4361ee;
            --accent-color: #4cc9f0;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-color: #334155;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
        }
         */
      
        
        .creation-card {
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.07);
            border: none;
        }
        
        /* Design des étapes */
        .steps-progress {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            position: relative;
          
        }
        
        .steps-progress::before {
            content: "";
            position: absolute;
            top: 30%;
            left: 0;
            right: 0;
            height: 3px;
            background-color: var(--border-color);
            transform: translateY(-50%);
            z-index: 1;
         
          
        }
        
        .step-item {
            position: relative;
            z-index: 2;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
           
        }
        
        .step-circle {
            width: 45px;
            height: 45px;
            background-color: var(--bg-color);
            border: 2px solid var(--border-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 18px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            background-color: var(--primary-color);
           
        }
        
        .step-title {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
            transition: all 0.3s ease;
            
        }
        
        .step-item.active .step-circle {
            background-color: var(--primary-color);
            border-color: rgb(9, 150, 9);
            color: white;
            transform: scale(1.15);
            background: rgb(19, 232, 19);
        }
        
        .step-item.active .step-title {
            color:rgb(19, 232, 19);
            font-weight: 700;
        }
        
        .step-item.completed .step-circle {
            background: rgb(3, 105, 3);
            border-color: rgb(9, 150, 9);
            color: white;

        }
        
        .step-item.completed .step-title {
            color: rgb(3, 105, 3);
        }
        
        /* Design du contenu */
        .step-content {
            display: none;
            animation: fadeIn 0.5s ease;
            padding: 15px;
        }
        
        .step-content.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .card-title {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-weight: 600;
            text-align: center;
        }
        
        .form-label {
            color: var(--text-color);
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid var(--border-color);
            padding: 12px;
            color: var(--text-color);
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(58, 134, 255, 0.15);
        }
        
        /* Design des types de contenu */
        .content-cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
           
        }
        
        .content-type-btn {
            flex: 1;
            border-radius: 15px;
            padding: 25px 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.35s ease;
            border: 2px solid var(--border-color);
            background-color: var(--card-bg);
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            color: var(--text-color);
        }
        
        .content-type-btn:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: var(--primary-color);
        }
        
        .content-type-btn i {
            font-size: 40px;
            margin-bottom: 15px;
            display: block;
        }
        
        .content-type-btn h5 {
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .content-type-btn.video-btn {
            color: #3a86ff;
        }
        
        .content-type-btn.pdf-btn {
            color: #ff6b6b;
        }
        
        /* Boutons de navigation */
        .nav-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
           
        }
        
        .btn {
            transition: all 0.3s ease;
        }
        
        .next-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }
        
        .next-btn:hover {
            background-color:rgba(50, 80, 215, 0.3);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .back-btn {
            background-color: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
        }
        
        .back-btn:hover {
            color: var(--text-color); 
            transform: translateY(-3px);
            border: 1px solid var(--border-color);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);

        }
        
        /* Contenu ajouté */
        .added-content-section {
            margin-top: 35px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
        }
        
        .added-content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .added-content-header h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin: 0;
        }
        
        .added-content {
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            border-left: 4px solid var(--primary-color);
            border-top: 1px solid var(--primary-color);
            transition: all 0.3s ease;
        }
        
        .added-content:hover {
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        
        .content-badge {
            font-size: 13px;
            padding: 6px 12px;
            border-radius: 50px;
            font-weight: 500;
        }
        
        .video-badge {
            background-color: #e0f2fe;
            color: #3a86ff;
            
        }
        
        .pdf-badge {
            background-color: #ffebee;
            color: #ff6b6b;
        }
        
        .content-actions {
            display: flex;
            gap: 8px;
        }
        
        .action-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background-color: white;
            color: var(--text-muted);
            transition: all 0.3s ease;
        }
        
        .action-btn:hover {
            color: var(--text-color);
            background-color: #aacdef;
            border-color: #449fef;
            color: #449fef;
        }
        
        .delete-btn:hover {
            background-color: #fee2e2;
            color: #ef4444;
            border-color: #ef4444;
        }
        
        .empty-content {
            text-align: center;
            padding: 30px;
            color: var(--text-muted);
        }
        
        .empty-content i {
            font-size: 40px;
            margin-bottom: 15px;
            opacity: 0.7;
        }
        
        /* Design de la modale */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 15px 50px rgba(0,0,0,0.15);
        }
        
        .modal-header {
            border-bottom: 1px solid #f1f5f9;
            padding: 20px 25px;
        }
        
        .modal-title {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .modal-body {
            padding: 25px;
        }
        
        .modal-footer {
            border-top: 1px solid #f1f5f9;
            padding: 20px 25px;
        }
        
        /* Revue finale */
        .review-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .review-icon {
            font-size: 60px;
            color: var(--accent-color);
            margin-bottom: 15px;
        }
        
        .review-card {
            border-radius: 15px;
            border: 1px solid var(--border-color);
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .review-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 10px;
        }
        
        .review-item {
            display: flex;
            margin-bottom: 10px;
        }
        
        .review-label {
            font-weight: 600;
            width: 120px;
            color: var(--text-color);
        }
        
        .review-value {
            color: var(--text-muted);
        }
    </style>
   
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
                            <form id="basicInfoForm">
                                <div class="mb-3">
                                    <label class="form-label">Titre du cours</label>
                                    <input type="text" class="form-control" placeholder="Entrez un titre attractif pour le cours" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Description du cours</label>
                                    <textarea class="form-control" rows="4" placeholder="Décrivez le contenu et les objectifs du cours" required></textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Catégorie</label>
                                        <select class="form-select" required>
                                            <option value="">Choisir une catégorie</option>
                                            <option>Développement Web</option>
                                            <option>Programmation d'applications</option>
                                            <option>Design Graphique</option>
                                            <option>Marketing Digital</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Niveau</label>
                                        <select class="form-select" required>
                                            <option value="">Choisir un niveau</option>
                                            <option>Débutant</option>
                                            <option>Intermédiaire</option>
                                            <option>Avancé</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Image de couverture</label>
                                    <input type="file" class="form-control" accept="image/*">
                                    <div class="form-text">Taille recommandée : 1280×720 pixels</div>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn next-btn">
                                        Suivant <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Étape 2: Ajout de contenu -->
                        <div id="step2" class="step-content">
                            <div class="text-center mb-4">
                                <h4 style="color: var(--primary-color);">Choisissez le type de contenu à ajouter</h4>
                                <p class="text-muted">Vous pouvez ajouter des vidéos et des fichiers PDF au cours</p>
                            </div>
                            
                            <div class="content-cards">
                                <div class="content-type-btn video-btn" data-type="video">
                                    <i class="fas fa-video"></i>
                                    <h5>Vidéo</h5>
                                    <p class="text-muted">Ajouter une vidéo pédagogique</p>
                                </div>
                                <div class="content-type-btn pdf-btn" data-type="pdf">
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
                                <button id="backToStep1" class="btn back-btn">
                                    <i class="fas fa-arrow-left me-2"></i> Précédent
                                </button>
                                <button id="goToStep3" class="btn next-btn">
                                    Suivant <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Étape 3: Revue finale -->
                        <div id="step3" class="step-content">
                            <div class="review-header">
                                <i class="fas fa-check-circle review-icon"></i>
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
                                <button id="backToStep2" class="btn back-btn">
                                    <i class="fas fa-arrow-left me-2"></i> Précédent
                                </button>
                                <button id="publishBtn" class="btn next-btn">
                                    <i class="fas fa-check me-2"></i> Finaliser le cours
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- Modale pour ajouter du contenu -->
    <div class="modal fade" id="contentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Ajouter du nouveau contenu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <form id="contentForm">
                        <input type="hidden" id="contentType">
                        
                        <div class="mb-3">
                            <label class="form-label">Titre du contenu</label>
                            <input type="text" class="form-control" id="contentTitle" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Description (optionnelle)</label>
                            <textarea class="form-control" id="contentDescription" rows="3"></textarea>
                        </div>
                        
                        <!-- Champs pour les vidéos -->
                        <div id="videoFields">
                            <div class="mb-3">
                                <label class="form-label">Lien de la vidéo</label>
                                <input type="url" class="form-control" placeholder="https://..." id="videoUrl">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Durée de la vidéo (minutes)</label>
                                    <input type="number" class="form-control" min="1" id="videoDuration">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Miniature (optionnelle)</label>
                                    <input type="file" class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Champs pour les fichiers -->
                        <div id="fileFields" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label">Téléverser le fichier</label>
                                <input type="file" class="form-control" id="pdfFile" accept=".pdf">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description du fichier (optionnelle)</label>
                                <textarea class="form-control" rows="2" placeholder="Décrivez brièvement le contenu du fichier"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn back-btn" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn next-btn" id="saveContent">Enregistrer le contenu</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contentModal = new bootstrap.Modal('#contentModal');
            let currentStep = 1;
            let courseData = {
                basicInfo: {},
                content: []
            };
            
            // Navigation entre les étapes
            function goToStep(step) {
                currentStep = step;
                
                // Mise à jour de l'indicateur d'étapes
                document.querySelectorAll('.step-item').forEach((item, index) => {
                    item.classList.remove('active', 'completed');
                    
                    if (index + 1 < step) {
                        item.classList.add('completed');
                    } else if (index + 1 === step) {
                        item.classList.add('active');
                    }
                });
                
                // Affichage du contenu de l'étape actuelle
                document.querySelectorAll('.step-content').forEach(content => {
                    content.classList.remove('active');
                });
                document.getElementById(`step${step}`).classList.add('active');
                
                // Si c'est l'étape 3, on affiche les données de revue
                if (step === 3) {
                    updateReviewData();
                }
            }
            
            // Mise à jour des données de revue
            function updateReviewData() {
                document.getElementById('reviewTitle').textContent = courseData.basicInfo.title || '--';
                document.getElementById('reviewCategory').textContent = courseData.basicInfo.category || '--';
                document.getElementById('reviewLevel').textContent = courseData.basicInfo.level || '--';
                document.getElementById('reviewItems').textContent = courseData.content.length;
            }
            
            // Mise à jour du compteur de contenu
            function updateContentCount() {
                const count = courseData.content.length;
                document.getElementById('contentCount').textContent = count;
                
                // Masquer la section de contenu si vide
                const contentList = document.getElementById('contentList');
                if (count === 0 && !contentList.querySelector('.empty-content')) {
                    contentList.innerHTML = `
                        <div class="empty-content">
                            <i class="fas fa-folder-open"></i>
                            <p>Aucun contenu ajouté pour le moment</p>
                            <p class="small">Choisissez un type de contenu ci-dessus pour l'ajouter au cours</p>
                        </div>
                    `;
                }
            }
            
            // Étape 1: Enregistrement des informations de base
            document.getElementById('basicInfoForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                courseData.basicInfo = {
                    title: this.querySelector('input[type="text"]').value,
                    description: this.querySelector('textarea').value,
                    category: this.querySelector('select').value,
                    level: this.querySelectorAll('select')[1].value,
                    image: this.querySelector('input[type="file"]').files[0]?.name
                };
                
                goToStep(2);
            });
            
            // Retour à l'étape 1
            document.getElementById('backToStep1').addEventListener('click', function() {
                goToStep(1);
            });
            
            // Retour à l'étape 2
            document.getElementById('backToStep2').addEventListener('click', function() {
                goToStep(2);
            });
            
            // Aller à l'étape 3
            document.getElementById('goToStep3').addEventListener('click', function() {
                if (courseData.content.length === 0) {
                    if (!confirm("Vous n'avez ajouté aucun contenu au cours. Voulez-vous continuer sans ajouter de contenu ?")) {
                        return;
                    }
                }
                goToStep(3);
            });
            
            // Ouverture de la modale pour ajouter du contenu
            document.querySelectorAll('.content-type-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const type = this.getAttribute('data-type');
                    document.getElementById('contentType').value = type;
                    
                    // Réinitialisation du formulaire
                    document.getElementById('contentForm').reset();
                    
                    // Détermination des champs selon le type
                    document.getElementById('videoFields').style.display = 'none';
                    document.getElementById('fileFields').style.display = 'none';
                    
                    // Configuration de la modale selon le type
                    let modalTitle = '';
                    switch(type) {
                        case 'video':
                            modalTitle = 'Ajouter une nouvelle vidéo';
                            document.getElementById('videoFields').style.display = 'block';
                            break;
                        case 'pdf':
                            modalTitle = 'Ajouter un nouveau fichier PDF';
                            document.getElementById('fileFields').style.display = 'block';
                            break;
                    }
                    
                    document.getElementById('modalTitle').textContent = modalTitle;
                    contentModal.show();
                });
            });
            
            // Enregistrement du contenu
            document.getElementById('saveContent').addEventListener('click', function() {
                const type = document.getElementById('contentType').value;
                const title = document.getElementById('contentTitle').value;
                const description = document.getElementById('contentDescription').value;
                
                if (!title) {
                    alert('Veuillez entrer un titre pour le contenu');
                    return;
                }
                
                let contentItem = {
                    id: Date.now(),
                    type: type,
                    title: title,
                    description: description,
                    addedAt: new Date().toLocaleString('fr-FR')
                };
                
                // Ajout de données supplémentaires selon le type
                if (type === 'video') {
                    const videoUrl = document.getElementById('videoUrl').value;
                    const duration = document.getElementById('videoDuration').value;
                    
                    if (!videoUrl) {
                        alert('Veuillez entrer un lien vidéo');
                        return;
                    }
                    
                    if (!duration || duration < 1) {
                        alert('Veuillez entrer une durée de vidéo (au moins 1 minute)');
                        return;
                    }
                    
                    contentItem.videoUrl = videoUrl;
                    contentItem.duration = duration + ' minutes';
                } else if (type === 'pdf') {
                    const fileInput = document.getElementById('pdfFile');
                    if (!fileInput.files || fileInput.files.length === 0) {
                        alert('Veuillez sélectionner un fichier PDF');
                        return;
                    }
                    
                    contentItem.fileName = fileInput.files[0].name;
                    contentItem.fileSize = (fileInput.files[0].size / 1024).toFixed(2) + ' KB';
                }
                
                // Ajout du contenu aux données
                courseData.content.push(contentItem);
                
                // Affichage du contenu ajouté
                displayContentItem(contentItem);
                
                // Mise à jour du compteur
                updateContentCount();
                
                // Fermeture de la modale
                contentModal.hide();
            });
            
            // Affichage du contenu ajouté
            function displayContentItem(item) {
                const contentList = document.getElementById('contentList');
                
                // Suppression du message "Aucun contenu" s'il existe
                if (contentList.querySelector('.empty-content')) {
                    contentList.innerHTML = '';
                }
                
                // Création d'un nouvel élément
                const itemEl = document.createElement('div');
                itemEl.className = 'added-content';
                itemEl.dataset.id = item.id;
                
                // Détermination du badge selon le type
                let badgeClass = '';
                let badgeText = '';
                let icon = '';
                let extraInfo = '';
                
                switch(item.type) {
                    case 'video':
                        badgeClass = 'video-badge';
                        badgeText = 'Vidéo';
                        icon = 'fa-video';
                        extraInfo = `<small class="text-muted"><i class="fas fa-clock me-1"></i> ${item.duration}</small>`;
                        break;
                    case 'pdf':
                        badgeClass = 'pdf-badge';
                        badgeText = 'Fichier PDF';
                        icon = 'fa-file-pdf';
                        extraInfo = `<small class="text-muted"><i class="fas fa-file me-1"></i> ${item.fileSize}</small>`;
                        break;
                }
                
                // Construction du HTML de l'élément
                itemEl.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <span class="content-badge ${badgeClass}">
                                <i class="fas ${icon} me-1"></i> ${badgeText}
                            </span>
                            <h5 class="d-inline-block mb-0 ms-2">${item.title}</h5>
                        </div>
                        <div class="content-actions">
                            <button class="action-btn edit-btn">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="action-btn delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    ${item.description ? `<p class="mb-2">${item.description}</p>` : ''}
                    ${extraInfo}
                    <div class="text-end mt-2">
                        <small class="text-muted">${item.addedAt}</small>
                    </div>
                `;
                
                contentList.appendChild(itemEl);
                
                // Ajout des écouteurs d'événements pour les boutons
                itemEl.querySelector('.delete-btn').addEventListener('click', function() {
                    if (confirm('Êtes-vous sûr de vouloir supprimer ce contenu ?')) {
                        // Suppression des données
                        courseData.content = courseData.content.filter(c => c.id !== item.id);
                        // Suppression de l'interface
                        itemEl.remove();
                        
                        // Mise à jour du compteur
                        updateContentCount();
                    }
                });
                
                itemEl.querySelector('.edit-btn').addEventListener('click', function() {
                    editContentItem(item);
                });
            }
            
            // Modification d'un élément de contenu
            function editContentItem(item) {
                document.getElementById('contentType').value = item.type;
                document.getElementById('contentTitle').value = item.title;
                document.getElementById('contentDescription').value = item.description || '';
                
                // Détermination des champs selon le type
                document.getElementById('videoFields').style.display = 'none';
                document.getElementById('fileFields').style.display = 'none';
                
                // Configuration de la modale selon le type
                let modalTitle = '';
                switch(item.type) {
                    case 'video':
                        modalTitle = 'Modifier la vidéo';
                        document.getElementById('videoFields').style.display = 'block';
                        document.getElementById('videoUrl').value = item.videoUrl || '';
                        document.getElementById('videoDuration').value = parseInt(item.duration) || '';
                        break;
                    case 'pdf':
                        modalTitle = 'Modifier le fichier PDF';
                        document.getElementById('fileFields').style.display = 'block';
                        // Impossible de modifier directement le fichier, on affiche un message
                        break;
                }
                
                document.getElementById('modalTitle').textContent = modalTitle;
                
                // Changement du texte du bouton d'enregistrement
                const saveBtn = document.getElementById('saveContent');
                saveBtn.textContent = 'Enregistrer les modifications';
                saveBtn.dataset.editingId = item.id;
                
                // Suppression de l'ancien écouteur d'événements s'il existe
                saveBtn.replaceWith(saveBtn.cloneNode(true));
                
                // Ajout du nouvel écouteur d'événements
                document.getElementById('saveContent').addEventListener('click', function saveEditHandler() {
                    const editingId = this.dataset.editingId;
                    const type = document.getElementById('contentType').value;
                    const title = document.getElementById('contentTitle').value;
                    const description = document.getElementById('contentDescription').value;
                    
                    if (!title) {
                        alert('Veuillez entrer un titre pour le contenu');
                        return;
                    }
                    
                    // Recherche de l'élément dans les données et mise à jour
                    const contentItem = courseData.content.find(c => c.id == editingId);
                    if (contentItem) {
                        contentItem.title = title;
                        contentItem.description = description;
                        contentItem.addedAt = new Date().toLocaleString('fr-FR');
                        
                        if (type === 'video') {
                            const videoUrl = document.getElementById('videoUrl').value;
                            const duration = document.getElementById('videoDuration').value;
                            
                            if (!videoUrl) {
                                alert('Veuillez entrer un lien vidéo');
                                return;
                            }
                            
                            if (!duration || duration < 1) {
                                alert('Veuillez entrer une durée de vidéo (au moins 1 minute)');
                                return;
                            }
                            
                            contentItem.videoUrl = videoUrl;
                            contentItem.duration = duration + ' minutes';
                        } else if (type === 'pdf') {
                            const fileInput = document.getElementById('pdfFile');
                            if (fileInput.files && fileInput.files.length > 0) {
                                contentItem.fileName = fileInput.files[0].name;
                                contentItem.fileSize = (fileInput.files[0].size / 1024).toFixed(2) + ' KB';
                            }
                        }
                        
                        // Réaffichage du contenu mis à jour
                        const contentList = document.getElementById('contentList');
                        const itemEl = contentList.querySelector(`[data-id="${editingId}"]`);
                        if (itemEl) {
                            itemEl.remove();
                        }
                        displayContentItem(contentItem);
                        
                        // Fermeture de la modale
                        contentModal.hide();
                        
                        // Réinitialisation du bouton d'enregistrement
                        this.textContent = 'Enregistrer le contenu';
                        this.removeAttribute('data-editing-id');
                        this.removeEventListener('click', saveEditHandler);
                    }
                });
                
                contentModal.show();
            }
            
            // Publication du cours
            document.getElementById('publishBtn').addEventListener('click', function() {
                if (!courseData.basicInfo.title || !courseData.basicInfo.category || !courseData.basicInfo.level) {
                    alert('Veuillez compléter les informations de base du cours');
                    goToStep(1);
                    return;
                }
                
                // Ici vous pouvez envoyer les données au serveur
                console.log('Données du cours prêtes pour publication:', courseData);
                
                // Affichage du message de succès
                const successMsg = `
                    <div class="text-center py-4">
                        <i class="fas fa-check-circle fa-4x mb-3" style="color: var(--accent-color);"></i>
                        <h3 style="color: var(--primary-color);">Cours créé avec succès !</h3>
                        <p class="text-muted">Le cours sera revu par l'administrateur avant publication</p>
                        <button class="btn next-btn mt-3" onclick="window.location.reload()">
                            <i class="fas fa-plus me-2"></i> Créer un nouveau cours
                        </button>
                    </div>
                `;
                
                document.querySelector('.creation-card .card-body').innerHTML = successMsg;
            });
        });
    </script>   
@endsection

@push('scripts')
<script src="{{ asset('assets/JS/dashboard/admin/categories.js') }}"></script>
@endpush
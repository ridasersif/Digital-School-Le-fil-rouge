
 @extends('layouts.dashboard')

@section('title', 'Détails du cours')

@push('styles')
<style>
    /* Variables de couleurs modernes */
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --light-color: #f8f9fa;
        --dark-color: #212529;
        --success-color: #4cc9f0;
        --warning-color: #f8961e;
        --danger-color: #f72585;
        
        --card-bg: #ffffff;
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --text-primary: #2b2d42;
        --text-secondary: #6c757d;
        --text-muted: #adb5bd;
        --border-color: #e9ecef;
        --hover-bg: #f1f3f9;
    }

    /* Styles généraux */
    .page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* En-tête de page */
    .page-header {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

   
    .page-subtitle {
        color: var(--text-secondary);
        font-size: 0.95rem;
    }

    /* Bouton de retour */
    .back-button {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1.25rem;
        background-color: var(--light-color);
        color: var(--text-primary);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .back-button:hover {
        background-color: var(--hover-bg);
        border-color: var(--primary-color);
        color: var(--primary-color);
        text-decoration: none;
        transform: translateY(-1px);
    }

    .back-button i {
        margin-right: 0.5rem;
    }

    /* Carte d'information */
    .info-card {
        background-color: var(--card-bg);
        
        background-color: ;

        border-radius: 12px;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    /* En-tête de carte */
    .card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        background-color: var(--light-color);
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--primary-color);
        margin: 0;
    }

    /* Corps de carte */
    .card-body {
        padding: 1.5rem;
    }

    /* Images */
    .course-image-wrapper {
        position: relative;
        height: 260px;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .course-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .course-image:hover {
        transform: scale(1.05);
    }

    /* Vidéo */
    .video-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        background-color: #000;
    }

    .video-container video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Titre du cours */
    .course-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 1rem 0 0.5rem;
        line-height: 1.3;
    }

    /* Prix */
    .price-badge {
        display: inline-block;
        padding: 0.4rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .price-badge.free {
        background-color: rgba(72, 149, 239, 0.1);
        color: var(--accent-color);
        border: 1px solid rgba(72, 149, 239, 0.3);
    }

    .price-badge.paid {
        background-color: rgba(33, 37, 41, 0.1);
        color: var(--dark-color);
        border: 1px solid rgba(33, 37, 41, 0.3);
    }

    /* Description */
    .course-description {
        color: var(--text-secondary);
        line-height: 1.7;
        font-size: 1rem;
    }

    /* Métadonnées */
    .meta-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .meta-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding: 0.75rem;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .meta-item:hover {
        background-color: var(--hover-bg);
    }

    .meta-icon {
        width: 40px;
        height: 40px;
        background-color: rgba(67, 97, 238, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: var(--primary-color);
        font-size: 1rem;
    }

    .meta-content {
        flex: 1;
    }

    .meta-label {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 0.2rem;
    }

    .meta-value {
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--text-primary);
    }

    /* États vides */
    .empty-state {
        text-align: center;
        padding: 2rem;
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        opacity: 0.5;
        color: var(--primary-color);
    }

    .empty-state p {
        margin: 0;
        font-size: 1rem;
    }

    /* Badges de statut */
    .status-badge {
        display: inline-block;
        padding: 0.3rem 0.9rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-badge.published {
        background-color: rgba(76, 201, 240, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(76, 201, 240, 0.3);
    }

    .status-badge.pending {
        background-color: rgba(248, 150, 30, 0.1);
        color: var(--warning-color);
        border: 1px solid rgba(248, 150, 30, 0.3);
    }

    .status-badge.draft {
        background-color: rgba(108, 117, 125, 0.1);
        color: var(--text-secondary);
        border: 1px solid rgba(108, 117, 125, 0.3);
    }

    /* Bouton d'édition */
    .edit-button  {
        display: block;
        width: 100%;
        padding: 0.85rem;
        text-align: center;
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
        border: 1px solid rgba(67, 97, 238, 0.3);
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
   
    .edit-button:hover {
        background-color: rgba(67, 97, 238, 0.2);
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.1);
    }

    .edit-button i {
        margin-right: 0.5rem;
    }

    .create-button{
        display: block;
        padding: 0.85rem;
        text-align: center;
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
        border: 1px solid rgba(67, 97, 238, 0.3);
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .create-button:hover {
        background-color: rgba(67, 97, 238, 0.2);
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.1);
    }

    /* Section des ressources (PDF/Vidéos) */
    .resources-section {
        margin-top: 2rem;
    }

    .resource-tabs {
        display: flex;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 1.5rem;
    }

    .resource-tab {
        padding: 0.75rem 1.5rem;
        cursor: pointer;
        font-weight: 500;
        color: var(--text-secondary);
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .resource-tab.active {
        color: var(--primary-color);
        border-bottom-color: var(--primary-color);
    }

    .resource-tab:hover:not(.active) {
        color: var(--text-primary);
    }

    .resource-content {
        display: none;
    }

    .resource-content.active {
        display: block;
    }

    .resource-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .resource-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 0.75rem;
        background-color: var(--light-color);
        transition: all 0.3s ease;
    }

    .resource-item:hover {
        background-color: var(--hover-bg);
        transform: translateX(5px);
    }

    .resource-icon {
        width: 40px;
        height: 40px;
        background-color: rgba(67, 97, 238, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: var(--primary-color);
    }

    .resource-details {
        flex: 1;
    }

    .resource-title {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .resource-meta {
        display: flex;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .resource-meta span {
        margin-right: 1rem;
        display: flex;
        align-items: center;
    }

    .resource-meta i {
        margin-right: 0.3rem;
        font-size: 0.8rem;
    }

    .resource-actions {
        display: flex;
    }

    .resource-action {
        padding: 0.5rem;
        color: var(--text-secondary);
        transition: all 0.2s ease;
        border-radius: 4px;
    }

    .resource-action:hover {
        color: var(--primary-color);
        background-color: rgba(67, 97, 238, 0.1);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .back-button {
            margin-top: 1rem;
        }
        
        .course-title {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 768px) {
        .meta-item {
            padding: 0.5rem;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .resource-tab {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@section('contents')
<div class="page-container">
    <!-- En-tête de page -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Détails du cours</h1>
            <p class="page-subtitle">Visualisez toutes les informations de votre cours</p>
        </div>
        <a href="{{ route('instructor.course.index') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <div class="row">
        <!-- Colonne de droite (informations du cours) -->
        <div class="col-lg-4 order-lg-2 mb-4">
            <div class="info-card">
                <!-- Image du cours -->
                @if($course->image)
                    <div class="course-image-wrapper">
                        <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->titre }}" class="course-image">
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-image"></i>
                        <p>Aucune image disponible</p>
                    </div>
                @endif

                <div class="card-body">
                    <!-- Titre du cours -->
                    <h2 class="course-title">{{ $course->titre }}</h2>
                    
                    <!-- Prix -->
                    @if($course->price > 0)
                        <div class="price-badge paid">{{ $course->price }} DH</div>
                    @else
                        <div class="price-badge free">Gratuit</div>
                    @endif

                    <!-- Métadonnées -->
                    <ul class="meta-list mt-4">
                        <!-- Catégorie -->
                        <li class="meta-item">
                            <div class="meta-icon">
                                <i class="fas fa-folder"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Catégorie</div>
                                <div class="meta-value">
                                    @if($course->category)
                                        {{ $course->category->nom }}
                                    @else
                                        Non catégorisé
                                    @endif
                                </div>
                            </div>
                        </li>
                        
                        <!-- Statut -->
                        <li class="meta-item">
                            <div class="meta-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Statut</div>
                                <div class="meta-value">
                                    @php
                                        $statusClass = match($course->status) {
                                            'published' => 'published',
                                            'pending' => 'pending',
                                            'draft' => 'draft',
                                        };
                                        
                                        $statusText = match($course->status) {
                                            'published' => 'Publié',
                                            'pending' => 'En attente',
                                            'draft' => 'Brouillon',
                                        };
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">{{ $statusText }}</span>
                                </div>
                            </div>
                        </li>
                        
                        <!-- Date de création -->
                        <li class="meta-item">
                            <div class="meta-icon">
                                <i class="far fa-calendar"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Date de création</div>
                                <div class="meta-value">{{ $course->created_at->format('d/m/Y') }}</div>
                            </div>
                        </li>
                        
                        <!-- Dernière mise à jour -->
                        <li class="meta-item">
                            <div class="meta-icon">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Dernière mise à jour</div>
                                <div class="meta-value">{{ $course->updated_at->format('d/m/Y') }}</div>
                            </div>
                        </li>
                    </ul>
                    
                    <!-- Bouton d'édition -->
                    <div class="mt-4">
                        <a href="{{ route('instructor.course.edit', $course->id) }}" class="edit-button">
                            <i class="fas fa-edit"></i> Modifier ce cours
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne de gauche (contenu principal) -->
        <div class="col-lg-8 order-lg-1">
            <!-- Vidéo d'introduction -->
            @if($course->video_intro)
                <div class="info-card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Vidéo d'introduction</h3>
                    </div>
                    <div class="card-body">
                        <div class="video-container">
                            <video controls poster="{{ $course->image ? asset('storage/' . $course->image) : '' }}">
                                <source src="{{ asset('storage/' . $course->video_intro) }}" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture de vidéos.
                            </video>
                        </div>
                    </div>
                </div>
            @else
                <div class="info-card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Vidéo d'introduction</h3>
                    </div>
                    <div class="card-body">

                                <div class="empty-state">
                                    <i class="fas fa-video-slash fa-2x"></i>
                                    <p>Aucune vidéo disponible</p>
                                </div>
                    </div>
                
                </div>
            
            @endif
        

            <!-- Description du cours -->
            <div class="info-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">À propos de ce cours</h3>
                </div>
                <div class="card-body">
                    
                    <div class="course-description">
                            {!! nl2br(e($course->description)) !!}
                    </div>
                  
                </div>
            </div>
        </div>
    </div>

    <!-- Section des ressources (PDF/Vidéos) -->
    <hr>
    <div class="mt-4">
        <div class="info-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Contenu du cours</h3>
                
                <a href="#" class="create-button btn  d-flex align-items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Ajouter un contenu</span>
                </a>
            </div>
            
            <div class="card-body">
                <div class="resources-section">
                    <!-- Onglets -->
                    <div class="resource-tabs">
                        <div class="resource-tab active" data-tab="videos">
                            <i class="fas fa-video mr-2"></i> Vidéos
                        </div>
                        <div class="resource-tab" data-tab="pdfs">
                            <i class="fas fa-file-pdf mr-2"></i> Documents PDF
                        </div>
                    </div>
                    
                    <!-- Contenu des vidéos -->
                    <div class="resource-content active" id="videos-content">
                        @if($course->videos && $course->videos->count() > 0)
                            <ul class="resource-list">
                                @foreach($course->videos as $video)
                                    <li class="resource-item">
                                        <div class="resource-icon">
                                            <i class="fas fa-video"></i>
                                        </div>
                                        <div class="resource-details">
                                            <div class="resource-title">{{ $video->title }}</div>
                                            <div class="resource-meta">
                                                <span><i class="far fa-clock"></i> {{ $video->duration }} min</span>
                                                <span><i class="far fa-calendar-alt"></i> {{ $video->created_at->format('d/m/Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="resource-actions">
                                            <a href="{{ asset('storage/' . $video->file_path) }}" class="resource-action" target="_blank" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-video-slash"></i>
                                <p>Aucune vidéo disponible pour ce cours</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Contenu des PDF -->
                    <div class="resource-content" id="pdfs-content">
                        @if($course->pdfs && $course->pdfs->count() > 0)
                            <ul class="resource-list">
                                @foreach($cours->pdfs as $pdf)
                                    <li class="resource-item">
                                        <div class="resource-icon">
                                            <i class="fas fa-file-pdf"></i>
                                        </div>
                                        <div class="resource-details">
                                            <div class="resource-title">{{ $pdf->title }}</div>
                                            <div class="resource-meta">
                                                <span><i class="fas fa-file-alt"></i> {{ $pdf->page_count }} pages</span>
                                                <span><i class="far fa-calendar-alt"></i> {{ $pdf->created_at->format('d/m/Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="resource-actions">
                                            <a href="{{ asset('storage/' . $pdf->file_path) }}" class="resource-action" target="_blank" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ asset('storage/' . $pdf->file_path) }}" class="resource-action" download title="Télécharger">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-file-pdf"></i>
                                <p>Aucun document PDF disponible pour ce cours</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Espace pour ajouter du contenu supplémentaire -->
                <div class="mt-4" id="additional-content-space">
                    <!-- Vous pouvez ajouter ici des formulaires pour ajouter de nouveaux PDF ou vidéos -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des onglets
        const tabs = document.querySelectorAll('.resource-tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Désactiver tous les onglets et contenus
                document.querySelectorAll('.resource-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.resource-content').forEach(c => c.classList.remove('active'));
                
                // Activer l'onglet cliqué
                this.classList.add('active');
                
                // Afficher le contenu correspondant
                const tabId = this.getAttribute('data-tab');
                document.getElementById(`${tabId}-content`).classList.add('active');
            });
        });
    });
</script>
@endpush
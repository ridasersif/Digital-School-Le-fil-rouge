<div class="mt-4">
    <div class="info-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Contenu du cours</h3>
            
            <a href="{{ route('instructor.content.create', ['cours_id' => $course->id]) }}" class="create-button btn d-flex align-items-center gap-2">
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
                <!-- contenus vidéo -->
                <div class="resource-content active" id="videos-content">
                    @if($course->contents->where('type', 'video')->count() > 0 || $course->contents->where('type', 'link')->count() > 0)
                        @foreach($course->contents as $content)
                            @if(($content->type == 'video' || $content->type == 'link') && $content->type != 'pdf')
                                <div class="content-card">
                                    <!-- Image ou icône -->
                                    <div class="content-image">
                                        @if($content->image)
                                            <img src="{{ asset('storage/' . $content->image) }}" alt="{{ $content->titre }}">
                                        @else
                                            <div class="content-icon">
                                                <i class="fas fa-video"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Contenu principal -->
                                    <div class="content-main">
                                        <!-- En-tête avec titre et statut -->
                                        <div class="content-header">
                                            <h4 class="content-title">{{ $content->titre }}</h4>
                                            @php
                                                $statusClass = match($content->status) {
                                                    'published' => 'status-published',
                                                    'pending' => 'status-pending',
                                                    'draft' => 'status-draft',
                                                    default => 'status-draft'
                                                };
                                                
                                                $statusText = match($content->status) {
                                                    'published' => 'Publié',
                                                    'pending' => 'En attente',
                                                    'draft' => 'Brouillon',
                                                    default => 'Brouillon'
                                                };
                                            @endphp
                                            <span class="content-status {{ $statusClass }}">{{ $statusText }}</span>
                                        </div>
                                        
                                        <!-- Description -->
                                        <div class="content-description">
                                            {{ $content->description }}
                                        </div>
                                        
                                        <!-- Métadonnées -->
                                        <div class="content-meta">

                                            <!-- Durée -->
                                            <div class="meta-group">
                                                <div class="meta-icon">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                                <div class="meta-text">
                                                    <span class="meta-label">Durée</span>
                                                    <span class="meta-value"> {{ $content->duree ? $content->duree . ' minutes' : 'Non spécifiée' }}</span>
                                                    
                                                </div>
                                            </div>
                                            
                                        
                                            
                                            <!-- Date d'ajout -->
                                            <div class="meta-group">
                                                <div class="meta-icon">
                                                    <i class="far fa-calendar-alt"></i>
                                                </div>
                                                <div class="meta-text">
                                                    <span class="meta-label">Ajouté le</span>
                                                    <span class="meta-value">{{ $content->created_at->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                            
                                            <!-- Dernière mise à jour -->
                                            <div class="meta-group">
                                                <div class="meta-icon">
                                                    <i class="fas fa-sync-alt"></i>
                                                </div>
                                                <div class="meta-text">
                                                    <span class="meta-label">Mis à jour le</span>
                                                    <span class="meta-value">{{ $content->updated_at->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        <!-- Actions -->
                                        <div class="content-actions">
                                            <a href="{{ asset('storage/' . $content->chemin) }}" class="action-btn" target="_blank" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                           
                                            <a href="{{ route('instructor.contents.edit', $content->id) }}" class="action-btn" title="Éditer">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        
                                            <div class="action-btn">
                                                <button type="button"
                                                    class="btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal-{{ $content->id }}"
                                                    title="Supprimer">

                                                    <i class="fas fa-trash" data-bs-toggle="tooltip"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="empty-content">
                            <div class="empty-icon">
                                <i class="fas fa-video-slash"></i>
                            </div>
                            <p class="empty-text">Aucune vidéo disponible pour ce cours</p>
                            <a href="{{ route('instructor.content.create', ['cours_id' => $course->id, 'type' => 'video']) }}" class="create-button">
                                <i class="fas fa-plus-circle mr-2"></i>
                                Ajouter une vidéo
                            </a>
                        </div>
                    @endif
                </div>

                <!-- contenus PDF -->
                <div class="resource-content" id="pdfs-content">
                    @if($course->contents->where('type', 'pdf')->count() > 0)
                        @foreach($course->contents->where('type', 'pdf') as $content)
                            <div class="content-card">
                                <!-- Image ou icône -->
                                <div class="content-image">
                                    @if($content->image)
                                        <img src="{{ asset('storage/' . $content->image) }}" alt="{{ $content->titre }}">
                                    @else
                                        <div class="content-icon">
                                            <i class="fas fa-file-pdf"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Contenu principal -->
                                <div class="content-main">
                                    <!-- En-tête avec titre et statut -->
                                    <div class="content-header">
                                        <h4 class="content-title">{{ $content->titre }}</h4>
                                        @php
                                            $statusClass = match($content->status) {
                                                'published' => 'status-published',
                                                'pending' => 'status-pending',
                                                'draft' => 'status-draft',
                                                default => 'status-draft'
                                            };
                                            
                                            $statusText = match($content->status) {
                                                'published' => 'Publié',
                                                'pending' => 'En attente',
                                                'draft' => 'Brouillon',
                                                default => 'Brouillon'
                                            };
                                        @endphp
                                        <span class="content-status {{ $statusClass }}">{{ $statusText }}</span>
                                    </div>
                                    
                                    <!-- Description -->
                                    <div class="content-description">
                                        {{ $content->description }}
                                    </div>
                                    
                                    <!-- Métadonnées -->
                                    <div class="content-meta">
                                        <!-- Nombre de pages -->
                                        <div class="meta-group">
                                            <div class="meta-icon">
                                                <i class="fas fa-file-alt"></i>
                                            </div>
                                            <div class="meta-text">
                                                <span class="meta-label">Nombre de pages</span>
                                                <span class="meta-value">{{ $content->nombre_pages ?? 'Non spécifié' }}</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Date d'ajout -->
                                        <div class="meta-group">
                                            <div class="meta-icon">
                                                <i class="far fa-calendar-alt"></i>
                                            </div>
                                            <div class="meta-text">
                                                <span class="meta-label">Ajouté le</span>
                                                <span class="meta-value">{{ $content->created_at->format('d/m/Y') }}</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Dernière mise à jour -->
                                        <div class="meta-group">
                                            <div class="meta-icon">
                                                <i class="fas fa-sync-alt"></i>
                                            </div>
                                            <div class="meta-text">
                                                <span class="meta-label">Mis à jour le</span>
                                                <span class="meta-value">{{ $content->updated_at->format('d/m/Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Actions -->
                                    <div class="content-actions">
                                        <a href="{{ asset('storage/' . $content->chemin) }}" class="action-btn" target="_blank" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('instructor.contents.edit', $content->id) }}" class="action-btn" title="Éditer">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <div class="action-btn">
                                            <button type="button"
                                                class="btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal-{{ $content->id }}"
                                                title="Supprimer">
                                                <i class="fas fa-trash" data-bs-toggle="tooltip"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-content">
                            <div class="empty-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <p class="empty-text">Aucun document PDF disponible pour ce cours</p>
                            <a href="{{ route('instructor.content.create', ['cours_id' => $course->id, 'type' => 'pdf']) }}" class="create-button">
                                <i class="fas fa-plus-circle mr-2"></i>
                                Ajouter un document PDF
                            </a>
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
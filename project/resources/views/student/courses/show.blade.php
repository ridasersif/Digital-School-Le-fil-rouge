{{-- 
@extends('layouts.frontend')

@section('contents')

@if (session('success'))
<div class="custom-alert custom-alert-success" id="alert-message">
    <i class="fas fa-check-circle"></i>
    {{ session('success') }}
</div>
@endif

@if (session('info'))
<div class="custom-alert custom-alert-info" id="alert-message">
    <i class="fas fa-info-circle"></i>
    {{ session('info') }}
</div>
@endif

@if (session('error'))
<div class="custom-alert custom-alert-error" id="alert-message">
    <i class="fas fa-exclamation-triangle"></i>
    {{ session('error') }}
</div>
@endif
<div class="container-fluid py-4">
    <div class="row">
         <!-- Main Content Area -->
        <div class="col-lg-9">
            <!-- Course Header -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h2 class="mb-1">{{ $course->titre }}</h2>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary me-2">{{ $course->category->nom }}</span>
                                <span class="text-muted">{{ $course->contents_count }} lessons</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-end">
                            <div class="instructor-preview d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#instructorModal">
                                <img src="{{ asset('storage/' . $course->formateur->user->profile->avatar) }}" 
                                    class="rounded-circle me-2" alt="Instructor" style="width:40px; height:40px; object-fit:cover;">
                                <div>
                                    <small class="text-muted d-block">Instructor</small>
                                    <strong>{{ $course->formateur->user->name }}</strong>
                                </div>
                            </div>
                            <!-- Add Review Button -->
                            <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#addReviewModal">
                                <i class="bi bi-star-fill"></i> Add Review
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content Display Area -->
            <div class="card shadow-sm mb-4">
                <div class="card-body p-0">
                    <!-- Default Course Introduction Video -->
                    <div id="default-content" class="active-content">
                        <div class="ratio ratio-16x9">
                            <video id="intro-video" controls poster="{{ asset('storage/' .$course->image) }}">
                                <source src="{{ asset($course->video_intro) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        
                        <div class="p-4">
                            <h3>Course Introduction</h3>
                            <p>{{ $course->description }}</p>
                        </div>
                    </div>
                    
                    <!-- Dynamic Content will be loaded here -->
                    @foreach($course->contents as $content)
                    <div id="content-{{ $content->id }}" class="content-container" style="display: none;">
                        @if($content->type == 'video')
                        <div class="ratio ratio-16x9">
                            <video id="video-{{ $content->id }}" controls>
                                <source src="{{ asset('storage/' . $content->chemin) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        @elseif($content->type == 'pdf')
                        <div class="ratio ratio-16x9">
                            <embed src="{{ asset('storage/' . $content->chemin) }}" type="application/pdf" width="100%" height="100%">
                        </div>
                        @elseif($content->type == 'link')
                     
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $content->chemin }}" width="100%" height="100%"></iframe>
                        </div>
                        @endif
                        
                        <div class="p-4">
                            <h3>{{ $content->titre }}</h3>
                            <p>{{ $content->description }}</p>
                            
                            @if($content->type == 'pdf')
                            <a href="{{ asset('storage/' . $content->chemin) }}" target="_blank" class="btn btn-primary mt-3">
                                <i class="bi bi-download"></i> Download PDF
                            </a>
                            @endif
                            
                            <div class="mt-4 pt-3 border-top">
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-outline-secondary btn-sm" onclick="showDefaultContent()">
                                        <i class="bi bi-arrow-left"></i> Back to Course Overview
                                    </button>

                                    @php
                                        $isContentViewed = auth()->user()->etudiant->contents->contains($content->id);
                                    @endphp
                                    @if($isContentViewed)
                                        <span class="badge bg-success p-2">
                                            <i class="bi bi-check-circle"></i> Contenu déjà consulté
                                        </span>
                                    @else
                                        <span class="badge bg-secondary p-2" id="viewing-status-{{ $content->id }}">
                                            <i class="bi bi-eye"></i> En cours de visionnage
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Course Content Sidebar -->
        <div class="col-lg-3">
            <div class="card shadow-sm sidebar-course">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Course Content</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($course->contents as $index => $content)
                        <div class="list-group-item py-3 px-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="content-icon me-3">
                                    @if($content->type == 'video')
                                    <i class="bi bi-play-circle-fill text-danger fs-4"></i>
                                    @elseif($content->type == 'link')
                                    <i class="bi bi-link-45deg text-info fs-4"></i>
                                    @else
                                    <i class="bi bi-file-pdf-fill text-primary fs-4"></i>
                                    @endif
                                </div>
                                <div class="content-info flex-grow-1">
                                    <a href="#" class="content-item text-decoration-none text-dark" 
                                       data-content-id="{{ $content->id }}" 
                                       onclick="loadContent({{ $content->id }})">
                                        <div>
                                            <strong>
                                                {{ $index + 1 }}. {{ $content->titre }}
                                                @php
                                                    $isViewed = auth()->user()->etudiant->contents->contains($content->id);
                                                @endphp
                                                <span class="status-icon ms-2">
                                                    @if($isViewed)
                                                        <i class="bi bi-check-circle-fill text-success"></i>
                                                    @else
                                                        <i class="bi bi-circle text-secondary"></i>
                                                    @endif
                                                </span>
                                            </strong>
                                        </div>
                                        <div class="text-muted small">
                                            @if($content->type == 'video')
                                            <i class="bi bi-clock"></i> {{ $content->duree }} minutes
                                            @else
                                            <i class="bi bi-file-text"></i> {{ $content->nombre_pages ?? 'N/A' }} pages
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                <div class="content-actions">
                                    <button class="btn btn-sm btn-outline-info" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#contentInfoModal{{ $content->id }}">
                                        <i class="bi bi-info-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @php
                            $etudiant = auth()->user()->etudiant;
                            $totalContents = $course->contents->count();
                            $viewedContents = $etudiant->contents()->where('cours_id', $course->id)->count();
                        @endphp

                        @if($totalContents > 0 && $totalContents == $viewedContents)
                            <div class="text-center my-4">
                                <a href="{{ route('certificat.download', ['cours' => $course->id]) }}" class="btn btn-primary">
                                     Télécharger votre certificat
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        
       
    </div>
</div>

<!-- Instructor Modal -->
<div class="modal fade" id="instructorModal" tabindex="-1" aria-labelledby="instructorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="instructorModalLabel">Instructor Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $course->formateur->user->profile->avatar) }}" 
                        class="rounded-circle" alt="Instructor" style="width:120px; height:120px; object-fit:cover;">
                    <h4 class="mt-3">{{ $course->formateur->user->name }}</h4>
                    <p class="text-muted">{{ $course->formateur->user->profile->titre ?? 'Instructor' }}</p>
                </div>
                
                <div class="instructor-bio mb-3">
                    <h6>About</h6>
                    <p>{{ $course->formateur->user->profile->bio ?? 'No biography available.' }}</p>
                </div>
                
                <div class="instructor-details">
                    <h6>Contact</h6>
                    <p><i class="bi bi-envelope"></i> {{ $course->formateur->user->email }}</p>
                    @if($course->formateur->user->profile->website)
                    <p><i class="bi bi-globe"></i> {{ $course->formateur->user->profile->website }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Info Modals -->
@foreach($course->contents as $content)
<div class="modal fade" id="contentInfoModal{{ $content->id }}" tabindex="-1" aria-labelledby="contentInfoModalLabel{{ $content->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contentInfoModalLabel{{ $content->id }}">{{ $content->titre }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="content-info-card">
                    @if($content->image)
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/' . $content->image) }}" alt="{{ $content->titre }}" class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                    @endif
                    
                    <div class="content-details">
                        <div class="mb-3">
                            <h6 class="fw-bold">Description</h6>
                            <p>{{ $content->description }}</p>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <h6 class="fw-bold">Type</h6>
                                <p>
                                    @if($content->type == 'video')
                                    <i class="bi bi-play-circle-fill text-danger"></i> Video
                                    @else
                                    <i class="bi bi-file-pdf-fill text-primary"></i> PDF
                                    @endif
                                </p>
                            </div>
                            <div class="col-6">
                                <h6 class="fw-bold">Status</h6>
                                <p>
                                    <span class="badge bg-{{ $content->status == 'pending' ? 'warning' : 'success' }}">
                                        {{ ucfirst($content->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <h6 class="fw-bold">Duration</h6>
                                <p>
                                    @if($content->type == 'video')
                                    <i class="bi bi-clock"></i> {{ $content->duree }} minutes
                                    @else
                                    <i class="bi bi-file-text"></i> {{ $content->nombre_pages ?? 'N/A' }} pages
                                    @endif
                                </p>
                            </div>
                            <div class="col-6">
                                <h6 class="fw-bold">Created</h6>
                                <p>{{ \Carbon\Carbon::parse($content->created_at)->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="loadContent({{ $content->id }})" data-bs-dismiss="modal">
                    @if($content->type == 'video')
                    <i class="bi bi-play-fill"></i> View Video
                    @else
                    <i class="bi bi-eye-fill"></i> View PDF
                    @endif
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal d'ajout d'avis -->
<div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        
            <div class="modal-header">
                <h5 class="modal-title" id="addReviewModalLabel">Ajouter un avis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>

            <form method="POST" action="{{ route('avis.store', $course->id) }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="cours_id" value="{{ $course->id }}">

                    <!-- Notation par étoiles -->
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <div class="star-rating d-flex flex-row-reverse justify-content-start">

                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="note" value="{{ $i }}" class="d-none">
                                <label for="star{{ $i }}" class="star-label fs-3 mx-1" style="cursor: pointer;">
                                    <i class="bi bi-star-fill text-warning"></i>
                                </label>
                            @endfor

                        </div>
                    </div>

                    <!-- Commentaire -->
                    <div class="mb-3">
                        <label for="commentaire" class="form-label">Votre commentaire</label>
                        <textarea class="form-control" id="commentaire" name="commentaire" rows="4" placeholder="Partagez votre expérience avec ce cours..."></textarea>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Envoyer l'avis</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('style')
<style>
      .custom-alert {
            position: fixed;
            top: 50px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
            max-width: 400px;
            padding: 15px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            font-size: 15px;
            opacity: 0.95;
            transition: opacity 0.3s ease-in-out;
        }
        .custom-alert i {
            font-size: 18px;
        }
        .custom-alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        .custom-alert-info {
            background-color: #cff4fc;
            color: #055160;
        }
        .custom-alert-error {
            background-color: #f8d7da;
            color: #842029;
        }
    .sidebar-course {
        height: calc(100vh - 100px);
        overflow-y: auto;
    }
    
    .content-item {
        transition: all 0.2s;
        display: block;
    }
    
    .content-item:hover {
        background-color: transparent;
        color: #0d6efd !important;
    }
    
    .list-group-item.active-item {
        background-color: #e9f5ff;
        border-left: 4px solid #0d6efd;
    }
    
    .instructor-preview {
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    
    .instructor-preview:hover {
        background-color: #f8f9fa;
    }
    
    .content-actions {
        visibility: visible;
        opacity: 0.7;
        transition: all 0.2s;
    }
    
    .list-group-item:hover .content-actions {
        visibility: visible;
        opacity: 1;
    }
    /* Star Rating Styles */
.star-label {
    cursor: pointer;
    color: #ccc;
    transition: all 0.2s;
}

.star-label:hover i,
.star-label:hover ~ .star-container .star-label i {
    color: #ffc107;
    transform: scale(1.2);
}

input[type="radio"]:checked + .star-label i,
input[type="radio"]:checked + .star-label ~ .star-container .star-label i {
    color: #ffc107;
}

.star-container {
    display: inline-block;
    direction: rtl;
}

/* Ajout pour les icônes de statut */
.status-icon {
    font-size: 14px;
    display: inline-block;
    vertical-align: middle;
}

.text-success.bi-check-circle-fill {
    animation: pulse 1s ease-in-out;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}
</style>
@endpush

@push('script')
<script>
 
    function loadContent(contentId) {
     
        document.querySelectorAll('.content-container').forEach(function(elem) {
            elem.style.display = 'none';
        });
        
     
        document.getElementById('default-content').style.display = 'none';
        
      
        document.getElementById('content-' + contentId).style.display = 'block';
        
      
        document.querySelectorAll('.list-group-item').forEach(function(elem) {
            elem.classList.remove('active-item');
        });
        
      
        const selectedItem = document.querySelector(`.content-item[data-content-id="${contentId}"]`)
            .closest('.list-group-item');
        if (selectedItem) {
            selectedItem.classList.add('active-item');
          
            selectedItem.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        
       
        const introVideo = document.getElementById('intro-video');
        if (introVideo) {
            introVideo.pause();
        }
        
      
        markContentAsViewed(contentId);
    }
    
  
    function showDefaultContent() {
     
        document.querySelectorAll('.content-container').forEach(function(elem) {
            elem.style.display = 'none';
        });
        
       
        document.getElementById('default-content').style.display = 'block';
        
      
        document.querySelectorAll('.list-group-item').forEach(function(elem) {
            elem.classList.remove('active-item');
        });
    }
    
    
    function markContentAsViewed(contentId) {
        fetch(`/contents/${contentId}/viewed`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
          
            updateContentStatusIcon(contentId, true);
            
          
            const viewingStatus = document.getElementById(`viewing-status-${contentId}`);
            if (viewingStatus) {
                viewingStatus.classList.remove('bg-secondary');
                viewingStatus.classList.add('bg-success');
                viewingStatus.innerHTML = '<i class="bi bi-check-circle"></i> Contenu déjà consulté';
            }
            
           
            checkAllContentsViewed();
        })
        .catch(error => {
            console.error("Erreur lors du marquage du contenu:", error);
        });
    }
    
  
    function updateContentStatusIcon(contentId, isViewed) {
        const contentItem = document.querySelector(`.content-item[data-content-id="${contentId}"]`);
        if (contentItem) {
         
            let statusIcon = contentItem.querySelector('.status-icon');
            if (statusIcon) {
            
                if (isViewed) {
                    statusIcon.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i>';
                } else {
                    statusIcon.innerHTML = '<i class="bi bi-circle text-secondary"></i>';
                }
            }
        }
    }
    
   
    function checkAllContentsViewed() {
        fetch(`/courses/{{ $course->id }}/checkContents`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.allViewed && !document.querySelector('.certificate-button')) {
                const sidebar = document.querySelector('.list-group-flush');
                if (sidebar) {
                    const certDiv = document.createElement('div');
                    certDiv.className = 'text-center my-4';
                    certDiv.innerHTML = `
                        <a href="{{ route('certificat.download', ['cours' => $course->id]) }}" class="btn btn-primary certificate-button">
                            Télécharger votre certificat
                        </a>
                    `;
                    sidebar.appendChild(certDiv);
                }
            }
        })
        .catch(error => {
            console.error("Erreur lors de la vérification des contenus:", error);
        });
    }
    
   
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const contentId = urlParams.get('content_id');
        
        if (contentId) {
            loadContent(contentId);
        }
        
        
        const viewedContentIds = [
            @foreach(auth()->user()->etudiant->contents as $viewedContent)
                {{ $viewedContent->id }},
            @endforeach
        ];
        
        
        viewedContentIds.forEach(function(id) {
            updateContentStatusIcon(id, true);
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('.star-label');
        stars.forEach(star => {
            star.addEventListener('click', function () {
                const inputId = this.getAttribute('for');
                const input = document.getElementById(inputId);
                if (input) {
                    input.checked = true;

                   
                    stars.forEach(s => s.querySelector('i').classList.remove('text-warning'));
                    for (let i = 1; i <= input.value; i++) {
                        let activeStar = document.querySelector(`#star${i} + label i`);
                        if (activeStar) activeStar.classList.add('text-warning');
                    }
                }
            });
        });
    });
</script>
@endpush --}}





@extends('layouts.frontend')

@section('contents')

@if (session('success'))
<div class="custom-alert custom-alert-success" id="alert-message">
    <i class="fas fa-check-circle"></i>
    {{ session('success') }}
</div>
@endif

@if (session('info'))
<div class="custom-alert custom-alert-info" id="alert-message">
    <i class="fas fa-info-circle"></i>
    {{ session('info') }}
</div>
@endif

@if (session('error'))
<div class="custom-alert custom-alert-error" id="alert-message">
    <i class="fas fa-exclamation-triangle"></i>
    {{ session('error') }}
</div>
@endif
<div class="container-fluid py-4">
    <div class="row">
         <!-- Main Content Area -->
        <div class="col-lg-9">
            <!-- Course Header -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h2 class="mb-1">{{ $course->titre }}</h2>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary me-2">{{ $course->category->nom }}</span>
                                <span class="text-muted">{{ $course->contents_count }} lessons</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-end">
                            <div class="instructor-preview d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#instructorModal">
                                <img src="{{ asset('storage/' . $course->formateur->user->profile->avatar) }}" 
                                    class="rounded-circle me-2" alt="Instructor" style="width:40px; height:40px; object-fit:cover;">
                                <div>
                                    <small class="text-muted d-block">Instructor</small>
                                    <strong>{{ $course->formateur->user->name }}</strong>
                                </div>
                            </div>
                            <!-- Add Review Button -->
                            <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#addReviewModal">
                                <i class="bi bi-star-fill"></i> Add Review
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content Display Area -->
            <div class="card shadow-sm mb-4">
                <div class="card-body p-0">
                    <!-- Default Course Introduction Video -->
                    <div id="default-content" class="active-content">
                        <div class="ratio ratio-16x9">
                            <video id="intro-video" controls poster="{{ asset('storage/' .$course->image) }}">
                                <source src="{{ asset($course->video_intro) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        
                        <div class="p-4">
                            <h3>Course Introduction</h3>
                            <p>{{ $course->description }}</p>
                        </div>
                    </div>
                    <!-- Dynamic Content will be loaded here -->
                    @foreach($course->contents as $content)
                    <div id="content-{{ $content->id }}" class="content-container" style="display: none;">
                        @if($content->type == 'video')
                        <div class="ratio ratio-16x9">
                            <video id="video-{{ $content->id }}" controls>
                                <source src="{{ asset('storage/' . $content->chemin) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        @elseif($content->type == 'pdf')
                        <div class="ratio ratio-16x9">
                            <embed src="{{ asset('storage/' . $content->chemin) }}" type="application/pdf" width="100%" height="100%">
                        </div>
                        @elseif($content->type == 'link')
                        <div class="ratio ratio-16x9">
                            <iframe src="{{$content->chemin}}" frameborder="0" allowfullscreen width="100%" height="100%"></iframe>
                        </div>
                        @endif
                        
                        <div class="p-4">
                            <h3>{{ $content->titre }}</h3>
                            <p>{{ $content->description }}</p>
                            
                            @if($content->type == 'pdf')
                            <a href="{{ asset('storage/' . $content->chemin) }}" target="_blank" class="btn btn-primary mt-3">
                                <i class="bi bi-download"></i> Download PDF
                            </a>
                            @endif
                            
                            <div class="mt-4 pt-3 border-top">
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-outline-secondary btn-sm" onclick="showDefaultContent()">
                                        <i class="bi bi-arrow-left"></i> Back to Course Overview
                                    </button>

                                    @php
                                        $isContentViewed = auth()->user()->etudiant->contents->contains($content->id);
                                    @endphp
                                    @if($isContentViewed)
                                        <span class="badge bg-success p-2">
                                            <i class="bi bi-check-circle"></i> Contenu déjà consulté
                                        </span>
                                    @else
                                        <span class="badge bg-secondary p-2" id="viewing-status-{{ $content->id }}">
                                            <i class="bi bi-eye"></i> En cours de visionnage
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Course Content Sidebar -->
        <div class="col-lg-3">
            <div class="card shadow-sm sidebar-course">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Course Content</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($course->contents as $index => $content)
                        <div class="list-group-item py-3 px-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="content-icon me-3">
                                    @if($content->type == 'video')
                                    <i class="bi bi-play-circle-fill text-danger fs-4"></i>
                                    @elseif($content->type == 'link')
                                    <i class="bi bi-link-45deg text-info fs-4"></i>
                                    @else
                                    <i class="bi bi-file-pdf-fill text-primary fs-4"></i>
                                    @endif
                                </div>
                                <div class="content-info flex-grow-1">
                                    <a href="#" class="content-item text-decoration-none text-dark" 
                                       data-content-id="{{ $content->id }}" 
                                       onclick="loadContent({{ $content->id }})">
                                        <div>
                                            <strong>
                                                {{ $index + 1 }}. {{ $content->titre }}
                                                @php
                                                    $isViewed = auth()->user()->etudiant->contents->contains($content->id);
                                                @endphp
                                                <span class="status-icon ms-2">
                                                    @if($isViewed)
                                                        <i class="bi bi-check-circle-fill text-success"></i>
                                                    @else
                                                        <i class="bi bi-circle text-secondary"></i>
                                                    @endif
                                                </span>
                                            </strong>
                                        </div>
                                        <div class="text-muted small">
                                            @if($content->type == 'video' || $content->type == 'link')
                                            <i class="bi bi-clock"></i> {{ $content->duree ?? 'N/A' }} minutes
                                            @elseif($content->type == 'link')
                                            <i class="bi bi-file-text"></i> {{ $content->nombre_pages ?? 'N/A' }} pages
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                <div class="content-actions">
                                    <button class="btn btn-sm btn-outline-info" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#contentInfoModal{{ $content->id }}">
                                        <i class="bi bi-info-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @php
                            $etudiant = auth()->user()->etudiant;
                            $totalContents = $course->contents->count();
                            $viewedContents = $etudiant->contents()->where('cours_id', $course->id)->count();
                        @endphp

                        @if($totalContents > 0 && $totalContents == $viewedContents)
                            <div class="text-center my-4">
                                <a href="{{ route('certificat.download', ['cours' => $course->id]) }}" class="btn btn-primary">
                                     Télécharger votre certificat
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        
       
    </div>
</div>

<!-- Instructor Modal -->
<div class="modal fade" id="instructorModal" tabindex="-1" aria-labelledby="instructorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="instructorModalLabel">Instructor Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $course->formateur->user->profile->avatar) }}" 
                        class="rounded-circle" alt="Instructor" style="width:120px; height:120px; object-fit:cover;">
                    <h4 class="mt-3">{{ $course->formateur->user->name }}</h4>
                    <p class="text-muted">{{ $course->formateur->user->profile->titre ?? 'Instructor' }}</p>
                </div>
                
                <div class="instructor-bio mb-3">
                    <h6>About</h6>
                    <p>{{ $course->formateur->user->profile->bio ?? 'No biography available.' }}</p>
                </div>
                
                <div class="instructor-details">
                    <h6>Contact</h6>
                    <p><i class="bi bi-envelope"></i> {{ $course->formateur->user->email }}</p>
                    @if($course->formateur->user->profile->website)
                    <p><i class="bi bi-globe"></i> {{ $course->formateur->user->profile->website }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Info Modals -->
@foreach($course->contents as $content)
<div class="modal fade" id="contentInfoModal{{ $content->id }}" tabindex="-1" aria-labelledby="contentInfoModalLabel{{ $content->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contentInfoModalLabel{{ $content->id }}">{{ $content->titre }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="content-info-card">
                    @if($content->image)
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/' . $content->image) }}" alt="{{ $content->titre }}" class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                    @endif
                    
                    <div class="content-details">
                        <div class="mb-3">
                            <h6 class="fw-bold">Description</h6>
                            <p>{{ $content->description }}</p>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <h6 class="fw-bold">Type</h6>
                                <p>
                                    @if($content->type == 'video')
                                    <i class="bi bi-play-circle-fill text-danger"></i> Video
                                    @elseif($content->type == 'link')
                                    <i class="bi bi-link-45deg text-info"></i> Link
                                    @else
                                    <i class="bi bi-file-pdf-fill text-primary"></i> PDF
                                    @endif
                                </p>
                            </div>
                            
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <h6 class="fw-bold">Duration</h6>
                                <p>
                                    @if($content->type == 'video')
                                    <i class="bi bi-clock"></i> {{ $content->duree }} minutes
                                    @else
                                    <i class="bi bi-file-text"></i> {{ $content->nombre_pages ?? 'N/A' }} pages
                                    @endif
                                </p>
                            </div>
                            <div class="col-6">
                                <h6 class="fw-bold">Created</h6>
                                <p>{{ \Carbon\Carbon::parse($content->created_at)->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="loadContent({{ $content->id }})" data-bs-dismiss="modal">
                    @if($content->type == 'video')
                    <i class="bi bi-play-fill"></i> View Video
                    @elseif($content->type == 'link')
                    <i class="bi bi-box-arrow-up-right"></i> View Link
                    @else
                    <i class="bi bi-eye-fill"></i> View PDF
                    @endif
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal d'ajout d'avis -->
<div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        
            <div class="modal-header">
                <h5 class="modal-title" id="addReviewModalLabel">Ajouter un avis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>

            <form method="POST" action="{{ route('avis.store', $course->id) }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="cours_id" value="{{ $course->id }}">

                    <!-- Notation par étoiles -->
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <div class="star-rating d-flex flex-row-reverse justify-content-start">

                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="note" value="{{ $i }}" class="d-none">
                                <label for="star{{ $i }}" class="star-label fs-3 mx-1" style="cursor: pointer;">
                                    <i class="bi bi-star-fill text-warning"></i>
                                </label>
                            @endfor

                        </div>
                    </div>

                    <!-- Commentaire -->
                    <div class="mb-3">
                        <label for="commentaire" class="form-label">Votre commentaire</label>
                        <textarea class="form-control" id="commentaire" name="commentaire" rows="4" placeholder="Partagez votre expérience avec ce cours..."></textarea>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Envoyer l'avis</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('style')
<style>
      .custom-alert {
            position: fixed;
            top: 50px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
            max-width: 400px;
            padding: 15px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            font-size: 15px;
            opacity: 0.95;
            transition: opacity 0.3s ease-in-out;
        }
        .custom-alert i {
            font-size: 18px;
        }
        .custom-alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        .custom-alert-info {
            background-color: #cff4fc;
            color: #055160;
        }
        .custom-alert-error {
            background-color: #f8d7da;
            color: #842029;
        }
    .sidebar-course {
        height: calc(100vh - 100px);
        overflow-y: auto;
    }
    
    .content-item {
        transition: all 0.2s;
        display: block;
    }
    
    .content-item:hover {
        background-color: transparent;
        color: #0d6efd !important;
    }
    
    .list-group-item.active-item {
        background-color: #e9f5ff;
        border-left: 4px solid #0d6efd;
    }
    
    .instructor-preview {
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    
    .instructor-preview:hover {
        background-color: #f8f9fa;
    }
    
    .content-actions {
        visibility: visible;
        opacity: 0.7;
        transition: all 0.2s;
    }
    
    .list-group-item:hover .content-actions {
        visibility: visible;
        opacity: 1;
    }
    /* Star Rating Styles */
.star-label {
    cursor: pointer;
    color: #ccc;
    transition: all 0.2s;
}

.star-label:hover i,
.star-label:hover ~ .star-container .star-label i {
    color: #ffc107;
    transform: scale(1.2);
}

input[type="radio"]:checked + .star-label i,
input[type="radio"]:checked + .star-label ~ .star-container .star-label i {
    color: #ffc107;
}

.star-container {
    display: inline-block;
    direction: rtl;
}

/* Ajout pour les icônes de statut */
.status-icon {
    font-size: 14px;
    display: inline-block;
    vertical-align: middle;
}

.text-success.bi-check-circle-fill {
    animation: pulse 1s ease-in-out;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}
</style>
@endpush

@push('script')
<script>
    // Fonction pour charger le contenu
    function loadContent(contentId) {
        // Cacher tous les contenus
        document.querySelectorAll('.content-container').forEach(function(elem) {
            elem.style.display = 'none';
        });
        
        // Cacher le contenu par défaut
        document.getElementById('default-content').style.display = 'none';
        
        // Afficher le contenu sélectionné
        document.getElementById('content-' + contentId).style.display = 'block';
        
        // Mettre à jour la classe active
        document.querySelectorAll('.list-group-item').forEach(function(elem) {
            elem.classList.remove('active-item');
        });
        
        // Ajouter la classe active à l'élément sélectionné
        const selectedItem = document.querySelector(`.content-item[data-content-id="${contentId}"]`)
            .closest('.list-group-item');
        if (selectedItem) {
            selectedItem.classList.add('active-item');
            // Faire défiler vers l'élément sélectionné
            selectedItem.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        
        // Mettre en pause la vidéo d'intro si elle existe
        const introVideo = document.getElementById('intro-video');
        if (introVideo) {
            introVideo.pause();
        }
        
        // Marquer le contenu comme vu
        markContentAsViewed(contentId);
    }
    
    // Fonction pour revenir au contenu par défaut
    function showDefaultContent() {
        // Cacher tous les contenus
        document.querySelectorAll('.content-container').forEach(function(elem) {
            elem.style.display = 'none';
        });
        
        // Afficher le contenu par défaut
        document.getElementById('default-content').style.display = 'block';
        
        // Supprimer toutes les classes active
        document.querySelectorAll('.list-group-item').forEach(function(elem) {
            elem.classList.remove('active-item');
        });
    }
    
    // Fonction pour marquer un contenu comme vu
    function markContentAsViewed(contentId) {
        fetch(`/contents/${contentId}/viewed`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Mettre à jour l'icône de statut
            updateContentStatusIcon(contentId, true);
            
            // Mettre à jour l'élément de statut
            const viewingStatus = document.getElementById(`viewing-status-${contentId}`);
            if (viewingStatus) {
                viewingStatus.classList.remove('bg-secondary');
                viewingStatus.classList.add('bg-success');
                viewingStatus.innerHTML = '<i class="bi bi-check-circle"></i> Contenu déjà consulté';
            }
            
            // Vérifier si tous les contenus ont été vus
            checkAllContentsViewed();
        })
        .catch(error => {
            console.error("Erreur lors du marquage du contenu:", error);
        });
    }
    
    // Fonction pour mettre à jour l'icône de statut d'un contenu
    function updateContentStatusIcon(contentId, isViewed) {
        const contentItem = document.querySelector(`.content-item[data-content-id="${contentId}"]`);
        if (contentItem) {
            // Trouver l'icône de statut
            let statusIcon = contentItem.querySelector('.status-icon');
            if (statusIcon) {
                // Mettre à jour l'icône en fonction du statut
                if (isViewed) {
                    statusIcon.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i>';
                } else {
                    statusIcon.innerHTML = '<i class="bi bi-circle text-secondary"></i>';
                }
            }
        }
    }
    
    // Fonction pour vérifier si tous les contenus ont été vus
    function checkAllContentsViewed() {
        fetch(`/courses/{{ $course->id }}/checkContents`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.allViewed && !document.querySelector('.certificate-button')) {
                const sidebar = document.querySelector('.list-group-flush');
                if (sidebar) {
                    const certDiv = document.createElement('div');
                    certDiv.className = 'text-center my-4';
                    certDiv.innerHTML = `
                        <a href="{{ route('certificat.download', ['cours' => $course->id]) }}" class="btn btn-primary certificate-button">
                            Télécharger votre certificat
                        </a>
                    `;
                    sidebar.appendChild(certDiv);
                }
            }
        })
        .catch(error => {
            console.error("Erreur lors de la vérification des contenus:", error);
        });
    }
    
    // Initialisation lors du chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const contentId = urlParams.get('content_id');
        
        if (contentId) {
            loadContent(contentId);
        }
        
        // Mise à jour des icônes pour les contenus déjà vus
        const viewedContentIds = [
            @foreach(auth()->user()->etudiant->contents as $viewedContent)
                {{ $viewedContent->id }},
            @endforeach
        ];
        
        // Mettre à jour chaque icône
        viewedContentIds.forEach(function(id) {
            updateContentStatusIcon(id, true);
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('.star-label');
        stars.forEach(star => {
            star.addEventListener('click', function () {
                const inputId = this.getAttribute('for');
                const input = document.getElementById(inputId);
                if (input) {
                    input.checked = true;

                    // Mettre à jour l'affichage des étoiles
                    stars.forEach(s => s.querySelector('i').classList.remove('text-warning'));
                    for (let i = 1; i <= input.value; i++) {
                        let activeStar = document.querySelector(`#star${i} + label i`);
                        if (activeStar) activeStar.classList.add('text-warning');
                    }
                }
            });
        });
    });

    // Auto-hide alert messages after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alertMessage = document.getElementById('alert-message');
        if (alertMessage) {
            setTimeout(function() {
                alertMessage.style.opacity = '0';
                setTimeout(function() {
                    alertMessage.style.display = 'none';
                }, 300);
            }, 5000);
        }
    });
</script>
@endpush

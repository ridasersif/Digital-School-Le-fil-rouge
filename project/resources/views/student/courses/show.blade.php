{{-- 
  

@extends('layouts.frontend')
@section('title', 'Détails du Cours - ' . $course->titre)
@section('contents')
<style>
    :root {
        --primary-color: #3498db;
        --secondary-color: #2c3e50;
        --accent-color: #e74c3c;
        --bg-light: #f8f9fa;
        --text-dark: #333;
    }
    
    .navbar {
        background-color: var(--secondary-color);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .navbar-brand {
        font-weight: 700;
        color: white !important;
    }
    
    .main-container {
        padding: 20px;
        min-height: calc(100vh - 76px);
    }
    
    .video-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        background-color: white;
        height: 450px;
    }
    
    .playlist-container {
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        height: 450px;
        overflow-y: auto;
    }
    
    .playlist-item {
        padding: 10px 15px;
        border-bottom: 1px solid #f1f1f1;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .playlist-item:hover {
        background-color: var(--bg-light);
    }
    
    .playlist-item.active {
        background-color: var(--primary-color);
        color: white;
    }
    
    .video-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .course-info {
        margin-top: 20px;
        padding: 20px;
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .instructor-info {
        display: flex;
        align-items: center;
        margin: 20px 0;
    }
    
    .instructor-pic {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary-color);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .instructor-pic:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(52, 152, 219, 0.5);
    }
    
    .instructor-name {
        font-weight: 600;
        font-size: 1.2rem;
        margin-left: 15px;
    }
    
    .progress-container {
        margin-top: 20px;
    }
    
    .modal-header {
        background-color: var(--primary-color);
        color: white;
    }
    
    .instructor-modal-pic {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid var(--primary-color);
        margin: 0 auto 20px;
        display: block;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }
    
    .course-description {
        line-height: 1.6;
    }
    
    /* Video controls */
    .video-controls {
        margin-top: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .control-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .control-btn:hover {
        background-color: #2980b9;
        transform: scale(1.05);
    }
    
    .category-badge {
        background-color: var(--secondary-color);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.85rem;
        display: inline-block;
        margin-bottom: 10px;
    }
    
    .price-info {
        display: flex;
        align-items: baseline;
        gap: 10px;
        margin-top: 10px;
    }
    
    .current-price {
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--accent-color);
    }
    
    .old-price {
        text-decoration: line-through;
        color: #6c757d;
    }
</style>


    <!-- Main Content -->
    <div class="container main-container">
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="video-container p-3">
                    <h2 class="video-title">{{ $course->titre }}</h2>
                    <div class="ratio ratio-16x9">
                        <video id="currentVideo" controls>
                            <source src="{{ asset('storage/' . $course->video_intro) }}" type="video/mp4">
                            Votre navigateur ne prend pas en charge la lecture de vidéos.
                        </video>
                    </div>
                    <div class="video-controls">
                        <button class="control-btn" id="prevBtn">
                            <i class="fas fa-step-backward"></i>
                        </button>
                        <button class="control-btn" id="playBtn">
                            <i class="fas fa-play"></i>
                        </button>
                        <button class="control-btn" id="nextBtn">
                            <i class="fas fa-step-forward"></i>
                        </button>
                        <div class="progress w-100" style="height: 8px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 0%"></div>
                        </div>
                        <span id="videoTime">00:00 / 00:00</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="playlist-container">
                    <div class="p-3 bg-primary text-white">
                        <h5 class="mb-0">Liste des vidéos ({{ $course->contents_count }})</h5>
                    </div>
                    
                    <!-- Introduction video -->
                    <div class="playlist-item active" data-video="{{ asset('storage/' . $course->video_intro) }}" data-title="{{ $course->titre }} - Introduction">
                        <div class="d-flex justify-content-between">
                            <span>Introduction: {{ $course->titre }}</span>
                            <span><i class="fas fa-play-circle"></i></span>
                        </div>
                        <small class="text-muted">Introduction</small>
                    </div>
                    
                    <!-- Course content videos -->
                    @foreach($course->contents as $index => $content)
                    <div class="playlist-item" data-video="{{ asset('storage/' . $content->chemin) }}" data-title="{{ $content->titre }}">
                        <div class="d-flex justify-content-between">
                            <span>{{ $index + 1 }}. {{ $content->titre }}</span>
                            <span><i class="far fa-play-circle"></i></span>
                        </div>
                        <small class="text-muted">{{ $content->duree }} min</small>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="course-info">
            <div class="category-badge">
                <i class="fas fa-tag me-1"></i> {{ $course->category->nom }}
            </div>
            <h3>{{ $course->titre }}</h3>
            <div class="price-info mb-3">
                <span class="current-price">{{ $course->price }} DH</span>
                @if($course->old_price)
                <span class="old-price">{{ $course->old_price }} DH</span>
                @endif
            </div>
            <div class="instructor-info">
                @if($course->formateur->user->profile->photo ?? false)
                <img src="{{ asset('storage/' . $course->formateur->user->profile->photo) }}" alt="Formateur" class="instructor-pic" data-bs-toggle="modal" data-bs-target="#instructorModal">
                @else
                <img src="/api/placeholder/150/150" alt="Formateur" class="instructor-pic" data-bs-toggle="modal" data-bs-target="#instructorModal">
                @endif
                <div class="instructor-name">
                    {{ $course->formateur->user->name ?? 'Formateur' }}
                    <p class="text-muted mb-0">{{ $course->formateur->user->profile->bio ?? 'Expert' }}</p>
                </div>
            </div>
            <div class="course-description">
                <p>{{ $course->description }}</p>
            </div>
            <div class="progress-container">
                <div class="d-flex justify-content-between mb-2">
                    <span>Progression du cours</span>
                    <span>0% complété</span>
                </div>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Instructor Modal -->
    <div class="modal fade" id="instructorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Profil du formateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($course->formateur->user->profile->photo ?? false)
                    <img src="{{ asset('storage/' . $course->formateur->user->profile->photo) }}" alt="Photo du formateur" class="instructor-modal-pic">
                    @else
                    <img src="/api/placeholder/150/150" alt="Photo du formateur" class="instructor-modal-pic">
                    @endif
                    <h4 class="text-center mb-3">{{ $course->formateur->user->name ?? 'Formateur' }}</h4>
                    
                    <div class="mb-3">
                        <h5>Spécialité</h5>
                        <p>{{ $course->formateur->user->profile->specialite ?? 'Formateur professionnel' }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <h5>Biographie</h5>
                        <p>{{ $course->formateur->user->profile->bio ?? 'Information non disponible' }}</p>
                    </div>
                    
                    @if($course->formateur->user->profile->education ?? false)
                    <div class="mb-3">
                        <h5>Formation</h5>
                        <p>{{ $course->formateur->user->profile->education }}</p>
                    </div>
                    @endif
                    
                    <div class="mb-3">
                        <h5>Contact</h5>
                        <p><i class="fas fa-envelope me-2"></i>{{ $course->formateur->user->email ?? 'Email non disponible' }}</p>
                        @if($course->formateur->user->profile->website ?? false)
                        <p><i class="fas fa-globe me-2"></i>{{ $course->formateur->user->profile->website }}</p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary">Voir tous les cours</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videoPlayer = document.getElementById('currentVideo');
            const playBtn = document.getElementById('playBtn');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const progressBar = document.querySelector('.progress-bar');
            const videoTime = document.getElementById('videoTime');
            const playlistItems = document.querySelectorAll('.playlist-item');
            let currentIndex = 0;
            
            // Gestion des événements du lecteur vidéo
            videoPlayer.addEventListener('timeupdate', updateProgress);
            videoPlayer.addEventListener('ended', function() {
                if (currentIndex < playlistItems.length - 1) {
                    playNext();
                }
            });
            
            playBtn.addEventListener('click', togglePlay);
            prevBtn.addEventListener('click', playPrevious);
            nextBtn.addEventListener('click', playNext);
            
            // Gestion des clics sur les éléments de la playlist
            playlistItems.forEach((item, index) => {
                item.addEventListener('click', function() {
                    currentIndex = index;
                    changeVideo(this.getAttribute('data-video'), this.getAttribute('data-title'));
                    updateActiveItem();
                });
            });
            
            function togglePlay() {
                if (videoPlayer.paused) {
                    videoPlayer.play();
                    playBtn.innerHTML = '<i class="fas fa-pause"></i>';
                } else {
                    videoPlayer.pause();
                    playBtn.innerHTML = '<i class="fas fa-play"></i>';
                }
            }
            
            function updateProgress() {
                const value = (videoPlayer.currentTime / videoPlayer.duration) * 100;
                progressBar.style.width = value + '%';
                
                // Format time
                const currentMinutes = Math.floor(videoPlayer.currentTime / 60);
                const currentSeconds = Math.floor(videoPlayer.currentTime % 60);
                const durationMinutes = Math.floor(videoPlayer.duration / 60) || 0;
                const durationSeconds = Math.floor(videoPlayer.duration % 60) || 0;
                
                videoTime.textContent = `${currentMinutes.toString().padStart(2, '0')}:${currentSeconds.toString().padStart(2, '0')} / ${durationMinutes.toString().padStart(2, '0')}:${durationSeconds.toString().padStart(2, '0')}`;
            }
            
            function playPrevious() {
                if (currentIndex > 0) {
                    currentIndex--;
                    const item = playlistItems[currentIndex];
                    changeVideo(item.getAttribute('data-video'), item.getAttribute('data-title'));
                    updateActiveItem();
                }
            }
            
            function playNext() {
                if (currentIndex < playlistItems.length - 1) {
                    currentIndex++;
                    const item = playlistItems[currentIndex];
                    changeVideo(item.getAttribute('data-video'), item.getAttribute('data-title'));
                    updateActiveItem();
                }
            }
            
            function changeVideo(src, title) {
                videoPlayer.src = src;
                videoPlayer.load();
                videoPlayer.play();
                playBtn.innerHTML = '<i class="fas fa-pause"></i>';
                document.querySelector('.video-title').textContent = title;
            }
            
            function updateActiveItem() {
                // Supprimer la classe active de tous les éléments
                playlistItems.forEach(el => {
                    el.classList.remove('active');
                    el.querySelector('span i').className = 'far fa-play-circle';
                });
                
                // Ajouter la classe active à l'élément actuel
                playlistItems[currentIndex].classList.add('active');
                playlistItems[currentIndex].querySelector('span i').className = 'fas fa-play-circle';
            }
        });
    </script>
@endsection --}}

{{-- 
@extends('layouts.frontend')
@section('title', 'Détails du Cours - ' . $course->titre)
@section('contents')
<style>
    :root {
        --primary-color: #3498db;
        --secondary-color: #2c3e50;
        --accent-color: #e74c3c;
        --bg-light: #f8f9fa;
        --text-dark: #333;
    }
    
    .navbar {
        background-color: var(--secondary-color);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .navbar-brand {
        font-weight: 700;
        color: white !important;
    }
    
    .main-container {
        padding: 20px;
        min-height: calc(100vh - 76px);
    }
    
    .video-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        background-color: white;
        height: 500px;
    }
    
    .playlist-container {
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        height: 500px;
        overflow-y: auto;
    }
    
    .playlist-item {
        padding: 12px 15px;
        border-bottom: 1px solid #f1f1f1;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
    }
    
    .playlist-item:hover {
        background-color: var(--bg-light);
    }
    
    .playlist-item.active {
        background-color: var(--primary-color);
        color: white;
    }
    
    .playlist-item.viewed .item-icon {
        color: #2ecc71;
    }
    
    .item-order {
        font-weight: bold;
        margin-right: 10px;
        min-width: 25px;
        text-align: center;
    }
    
    .item-content {
        flex: 1;
    }
    
    .item-title {
        font-weight: 500;
        margin-bottom: 3px;
    }
    
    .item-meta {
        font-size: 0.8rem;
        color: #6c757d;
    }
    
    .playlist-item.active .item-meta,
    .playlist-item.active .item-icon {
        color: rgba(255,255,255,0.8);
    }
    
    .item-icon {
        margin-left: 10px;
        font-size: 1.2rem;
        color: #6c757d;
    }
    
    .section-title {
        padding: 12px 15px;
        background-color: var(--secondary-color);
        color: white;
        font-weight: 600;
        margin: 0;
        position: sticky;
        top: 0;
        z-index: 1;
    }
    
    .pdf-section {
        border-top: 2px solid #f1f1f1;
    }
    
    .video-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .course-info {
        margin-top: 20px;
        padding: 20px;
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .instructor-info {
        display: flex;
        align-items: center;
        margin: 20px 0;
    }
    
    .instructor-pic {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary-color);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .instructor-pic:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(52, 152, 219, 0.5);
    }
    
    .instructor-name {
        font-weight: 600;
        font-size: 1.2rem;
        margin-left: 15px;
    }
    
    .progress-container {
        margin-top: 20px;
    }
    
    .modal-header {
        background-color: var(--primary-color);
        color: white;
    }
    
    .instructor-modal-pic {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid var(--primary-color);
        margin: 0 auto 20px;
        display: block;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }
    
    .course-description {
        line-height: 1.6;
    }
    
    /* Video controls */
    .video-controls {
        margin-top: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .control-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .control-btn:hover {
        background-color: #2980b9;
        transform: scale(1.05);
    }
    
    .category-badge {
        background-color: var(--secondary-color);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.85rem;
        display: inline-block;
        margin-bottom: 10px;
    }
    
    .price-info {
        display: flex;
        align-items: baseline;
        gap: 10px;
        margin-top: 10px;
    }
    
    .current-price {
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--accent-color);
    }
    
    .old-price {
        text-decoration: line-through;
        color: #6c757d;
    }
    
    .pdf-viewer {
        width: 100%;
        height: 450px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    
    .content-empty {
        padding: 20px;
        text-align: center;
        color: #6c757d;
    }
</style>

<div class="container main-container">
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="video-container p-3">
                <h2 class="video-title" id="contentTitle">{{ $course->titre }} - Introduction</h2>
                <div id="mediaContainer">
                    <div class="ratio ratio-16x9">
                        <video id="currentVideo" controls>
                            <source src="{{ asset('storage/' . $course->video_intro) }}" type="video/mp4">
                            Votre navigateur ne prend pas en charge la lecture de vidéos.
                        </video>
                    </div>
                </div>
                <div class="video-controls">
                    <button class="control-btn" id="prevBtn" title="Précédent">
                        <i class="fas fa-step-backward"></i>
                    </button>
                    <button class="control-btn" id="playBtn" title="Lecture/Pause">
                        <i class="fas fa-play"></i>
                    </button>
                    <button class="control-btn" id="nextBtn" title="Suivant">
                        <i class="fas fa-step-forward"></i>
                    </button>
                    <div class="progress w-100" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: %"></div>
                    </div>
                    <span id="videoTime">00:00 / 00:00</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="playlist-container">
                <h5 class="section-title">Contenu du cours ({{ $course->contents->count() + 1 }})</h5>
                
                <!-- Introduction video -->
                <div class="playlist-item active" 
                     data-media="{{ asset('storage/' . $course->video_intro) }}" 
                     data-title="{{ $course->titre }} - Introduction"
                     data-type="video"
                     data-order="0">
                    <div class="item-order">0</div>
                    <div class="item-content">
                        <div class="item-title">Introduction</div>
                        <div class="item-meta">Vidéo d'introduction</div>
                    </div>
                    <div class="item-icon">
                        <i class="fas fa-play-circle"></i>
                    </div>
                </div>
                
                <!-- Course contents -->
                @php
                    $videoCount = 1;
                    $pdfCount = 1;
                @endphp
                
                @foreach($course->contents->sortBy('created_at') as $content)
                    @if($content->type == 'video')
                        <div class="playlist-item {{ $content->is_viewed ? 'viewed' : '' }}" 
                             data-media="{{ asset('storage/' . $content->chemin) }}" 
                             data-title="{{ $content->titre }}"
                             data-type="video"
                             data-order="{{ $videoCount }}"
                             data-content-id="{{ $content->id }}">
                            <div class="item-order">{{ $videoCount }}</div>
                            <div class="item-content">
                                <div class="item-title">{{ $content->titre }}</div>
                                <div class="item-meta">Vidéo • {{ $content->duree }} min</div>
                            </div>
                            <div class="item-icon">
                                <i class="fas fa-play-circle"></i>
                            </div>
                        </div>
                        @php $videoCount++; @endphp
                    @elseif($content->type == 'pdf')
                        <div class="playlist-item {{ $content->is_viewed ? 'viewed' : '' }}" 
                             data-media="{{ asset('storage/' . $content->chemin) }}" 
                             data-title="{{ $content->titre }}"
                             data-type="pdf"
                             data-order="{{ $pdfCount }}"
                             data-content-id="{{ $content->id }}">
                            <div class="item-order">{{ $pdfCount }}</div>
                            <div class="item-content">
                                <div class="item-title">{{ $content->titre }}</div>
                                <div class="item-meta">PDF • {{ $content->nombre_pages }} pages</div>
                            </div>
                            <div class="item-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                        </div>
                        @php $pdfCount++; @endphp
                    @endif
                @endforeach
                
                @if($course->contents->count() == 0)
                    <div class="content-empty">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <p>Aucun contenu disponible pour ce cours pour le moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="course-info">
        <div class="category-badge">
            <i class="fas fa-tag me-1"></i> {{ $course->category->nom }}
        </div>
        <h3>{{ $course->titre }}</h3>
        <div class="price-info mb-3">
            <span class="current-price">{{ $course->price }} DH</span>
            @if($course->old_price)
            <span class="old-price">{{ $course->old_price }} DH</span>
            @endif
        </div>
        <div class="instructor-info">
            @if($course->formateur->user->profile->photo ?? false)
            <img src="{{ asset('storage/' . $course->formateur->user->profile->photo) }}" alt="Formateur" class="instructor-pic" data-bs-toggle="modal" data-bs-target="#instructorModal">
            @else
            <img src="/api/placeholder/150/150" alt="Formateur" class="instructor-pic" data-bs-toggle="modal" data-bs-target="#instructorModal">
            @endif
            <div class="instructor-name">
                {{ $course->formateur->user->name ?? 'Formateur' }}
                <p class="text-muted mb-0">{{ $course->formateur->user->profile->bio ?? 'Expert' }}</p>
            </div>
        </div>
        <div class="course-description">
            <p>{{ $course->description }}</p>
        </div>
        <div class="progress-container">
            <div class="d-flex justify-content-between mb-2">
                <span>Progression du cours</span>
                <span>% complété</span>
            </div>
            <div class="progress" style="height: 10px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: %"></div>
            </div>
        </div>
    </div>
</div>

<!-- Instructor Modal -->
<div class="modal fade" id="instructorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Profil du formateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($course->formateur->user->profile->photo ?? false)
                <img src="{{ asset('storage/' . $course->formateur->user->profile->photo) }}" alt="Photo du formateur" class="instructor-modal-pic">
                @else
                <img src="/api/placeholder/150/150" alt="Photo du formateur" class="instructor-modal-pic">
                @endif
                <h4 class="text-center mb-3">{{ $course->formateur->user->name ?? 'Formateur' }}</h4>
                
                <div class="mb-3">
                    <h5>Spécialité</h5>
                    <p>{{ $course->formateur->user->profile->specialite ?? 'Formateur professionnel' }}</p>
                </div>
                
                <div class="mb-3">
                    <h5>Biographie</h5>
                    <p>{{ $course->formateur->user->profile->bio ?? 'Information non disponible' }}</p>
                </div>
                
                @if($course->formateur->user->profile->education ?? false)
                <div class="mb-3">
                    <h5>Formation</h5>
                    <p>{{ $course->formateur->user->profile->education }}</p>
                </div>
                @endif
                
                <div class="mb-3">
                    <h5>Contact</h5>
                    <p><i class="fas fa-envelope me-2"></i>{{ $course->formateur->user->email ?? 'Email non disponible' }}</p>
                    @if($course->formateur->user->profile->website ?? false)
                    <p><i class="fas fa-globe me-2"></i>{{ $course->formateur->user->profile->website }}</p>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Voir tous les cours</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<script>
    // Configure PDF.js worker path
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';
    
    document.addEventListener('DOMContentLoaded', function() {
        const mediaContainer = document.getElementById('mediaContainer');
        const contentTitle = document.getElementById('contentTitle');
        const playBtn = document.getElementById('playBtn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const progressBar = document.querySelector('.progress-bar');
        const videoTime = document.getElementById('videoTime');
        const playlistItems = document.querySelectorAll('.playlist-item');
        const courseId = {{ $course->id }};
        
        let currentIndex = 0;
        let currentVideo = document.getElementById('currentVideo');
        let currentPdfViewer = null;
        
        // Initialize the first item as active
        updateActiveItem();
        
        // Event listeners
        playBtn.addEventListener('click', togglePlay);
        prevBtn.addEventListener('click', playPrevious);
        nextBtn.addEventListener('click', playNext);
        
        // Handle playlist item clicks
        playlistItems.forEach((item, index) => {
            item.addEventListener('click', function() {
                currentIndex = index;
                loadMedia(this);
                updateActiveItem();
            });
        });
        
        // Handle video events
        if (currentVideo) {
            currentVideo.addEventListener('timeupdate', updateProgress);
            currentVideo.addEventListener('ended', function() {
                markAsViewed(playlistItems[currentIndex]);
                if (currentIndex < playlistItems.length - 1) {
                    playNext();
                }
            });
        }
        
        function loadMedia(item) {
            const mediaUrl = item.getAttribute('data-media');
            const mediaType = item.getAttribute('data-type');
            const title = item.getAttribute('data-title');
            
            contentTitle.textContent = title;
            
            if (mediaType === 'video') {
                // Load video
                mediaContainer.innerHTML = `
                    <div class="ratio ratio-16x9">
                        <video id="currentVideo" controls>
                            <source src="${mediaUrl}" type="video/mp4">
                            Votre navigateur ne prend pas en charge la lecture de vidéos.
                        </video>
                    </div>
                `;
                
                currentVideo = document.getElementById('currentVideo');
                currentVideo.addEventListener('timeupdate', updateProgress);
                currentVideo.addEventListener('ended', function() {
                    markAsViewed(item);
                    if (currentIndex < playlistItems.length - 1) {
                        playNext();
                    }
                });
                
                // Update play button state
                playBtn.innerHTML = '<i class="fas fa-pause"></i>';
                playBtn.onclick = togglePlay;
                
            } else if (mediaType === 'pdf') {
                // Load PDF
                mediaContainer.innerHTML = `
                    <div class="pdf-viewer-container">
                        <canvas id="pdfViewer" class="pdf-viewer"></canvas>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <button class="btn btn-sm btn-primary" id="prevPage">Précédent</button>
                        <span id="pageInfo">Page 1 sur 1</span>
                        <button class="btn btn-sm btn-primary" id="nextPage">Suivant</button>
                    </div>
                `;
                
                // Initialize PDF viewer
                const pdfViewer = document.getElementById('pdfViewer');
                const pageInfo = document.getElementById('pageInfo');
                const prevPageBtn = document.getElementById('prevPage');
                const nextPageBtn = document.getElementById('nextPage');
                
                let pdfDoc = null,
                    pageNum = 1,
                    pageRendering = false,
                    pageNumPending = null;
                
                // Render the PDF page
                function renderPage(num) {
                    pageRendering = true;
                    pdfDoc.getPage(num).then(function(page) {
                        const viewport = page.getViewport({ scale: 1.5 });
                        const canvas = document.getElementById('pdfViewer');
                        const context = canvas.getContext('2d');
                        
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        
                        const renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        
                        const renderTask = page.render(renderContext);
                        
                        renderTask.promise.then(function() {
                            pageRendering = false;
                            if (pageNumPending !== null) {
                                renderPage(pageNumPending);
                                pageNumPending = null;
                            }
                        });
                    });
                    
                    pageInfo.textContent = `Page ${num} sur ${pdfDoc.numPages}`;
                }
                
                // Go to previous page
                function onPrevPage() {
                    if (pageNum <= 1) return;
                    pageNum--;
                    queueRenderPage(pageNum);
                }
                
                // Go to next page
                function onNextPage() {
                    if (pageNum >= pdfDoc.numPages) return;
                    pageNum++;
                    queueRenderPage(pageNum);
                }
                
                function queueRenderPage(num) {
                    if (pageRendering) {
                        pageNumPending = num;
                    } else {
                        renderPage(num);
                    }
                }
                
                // Load the PDF document
                pdfjsLib.getDocument(mediaUrl).promise.then(function(pdfDoc_) {
                    pdfDoc = pdfDoc_;
                    renderPage(pageNum);
                    
                    // Mark as viewed after 5 seconds of viewing
                    setTimeout(() => {
                        markAsViewed(item);
                    }, 5000);
                });
                
                // Add event listeners for buttons
                prevPageBtn.addEventListener('click', onPrevPage);
                nextPageBtn.addEventListener('click', onNextPage);
                
                // Update play button state (disabled for PDF)
                playBtn.innerHTML = '<i class="fas fa-play"></i>';
                playBtn.onclick = null;
            }
        }
        
        function togglePlay() {
            if (currentVideo.paused) {
                currentVideo.play();
                playBtn.innerHTML = '<i class="fas fa-pause"></i>';
            } else {
                currentVideo.pause();
                playBtn.innerHTML = '<i class="fas fa-play"></i>';
            }
        }
        
        function updateProgress() {
            if (!currentVideo) return;
            
            const value = (currentVideo.currentTime / currentVideo.duration) * 100;
            progressBar.style.width = value + '%';
            
            // Format time
            const currentMinutes = Math.floor(currentVideo.currentTime / 60);
            const currentSeconds = Math.floor(currentVideo.currentTime % 60);
            const durationMinutes = Math.floor(currentVideo.duration / 60) || 0;
            const durationSeconds = Math.floor(currentVideo.duration % 60) || 0;
            
            videoTime.textContent = `${currentMinutes.toString().padStart(2, '0')}:${currentSeconds.toString().padStart(2, '0')} / ${durationMinutes.toString().padStart(2, '0')}:${durationSeconds.toString().padStart(2, '0')}`;
        }
        
        function playPrevious() {
            if (currentIndex > 0) {
                currentIndex--;
                loadMedia(playlistItems[currentIndex]);
                updateActiveItem();
            }
        }
        
        function playNext() {
            if (currentIndex < playlistItems.length - 1) {
                currentIndex++;
                loadMedia(playlistItems[currentIndex]);
                updateActiveItem();
            }
        }
        
        function updateActiveItem() {
            // Remove active class from all items
            playlistItems.forEach(el => {
                el.classList.remove('active');
            });
            
            // Add active class to current item
            playlistItems[currentIndex].classList.add('active');
        }
        
        function markAsViewed(item) {
            if (item.classList.contains('viewed')) return;
            
            item.classList.add('viewed');
            updateCourseProgress();
            
            const contentId = item.getAttribute('data-content-id');
            if (!contentId) return; // Skip for introduction
            
            // Send AJAX request to mark as viewed
            fetch(`/courses/${courseId}/contents/${contentId}/viewed`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
        }
        
        function updateCourseProgress() {
            const totalItems = playlistItems.length;
            const viewedItems = document.querySelectorAll('.playlist-item.viewed').length;
            const progress = Math.round((viewedItems / totalItems) * 100);
            
            document.querySelectorAll('.progress-bar').forEach(bar => {
                bar.style.width = progress + '%';
            });
            
            document.querySelectorAll('.progress-container span:last-child').forEach(el => {
                el.textContent = progress + '% complété';
            });
        }
    });
</script>
@endsection --}}














{{-- 


@extends('layouts.frontend')
@section('title', 'Détails du Cours - ' . $course->titre)
@section('contents')
<style>
    :root {
        --primary-color: #3498db;
        --secondary-color: #2c3e50;
        --accent-color: #e74c3c;
        --bg-light: #f8f9fa;
        --text-dark: #333;
    }
    
    .navbar {
        background-color: var(--secondary-color);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .navbar-brand {
        font-weight: 700;
        color: white !important;
    }
    
    .main-container {
        padding: 20px;
        min-height: calc(100vh - 76px);
    }
    
    .video-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        background-color: white;
        height: 500px;
        position: relative;
    }
    
    .playlist-container {
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        height: 500px;
        overflow-y: auto;
    }
    
    .playlist-item {
        padding: 12px 15px;
        border-bottom: 1px solid #f1f1f1;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
    }
    
    .playlist-item:hover {
        background-color: var(--bg-light);
    }
    
    .playlist-item.active {
        background-color: var(--primary-color);
        color: white;
    }
    
    .playlist-item.viewed .item-icon {
        color: #2ecc71;
    }
    
    .item-order {
        font-weight: bold;
        margin-right: 10px;
        min-width: 25px;
        text-align: center;
    }
    
    .item-content {
        flex: 1;
    }
    
    .item-title {
        font-weight: 500;
        margin-bottom: 3px;
    }
    
    .item-meta {
        font-size: 0.8rem;
        color: #6c757d;
    }
    
    .playlist-item.active .item-meta,
    .playlist-item.active .item-icon {
        color: rgba(255,255,255,0.8);
    }
    
    .item-icon {
        margin-left: 10px;
        font-size: 1.2rem;
        color: #6c757d;
    }
    
    .section-title {
        padding: 12px 15px;
        background-color: var(--secondary-color);
        color: white;
        font-weight: 600;
        margin: 0;
        position: sticky;
        top: 0;
        z-index: 1;
    }
    
    .pdf-section {
        border-top: 2px solid #f1f1f1;
    }
    
    .video-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .course-info {
        margin-top: 20px;
        padding: 20px;
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .instructor-info {
        display: flex;
        align-items: center;
        margin: 20px 0;
    }
    
    .instructor-pic {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary-color);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .instructor-pic:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(52, 152, 219, 0.5);
    }
    
    .instructor-name {
        font-weight: 600;
        font-size: 1.2rem;
        margin-left: 15px;
    }
    
    .progress-container {
        margin-top: 20px;
    }
    
    .modal-header {
        background-color: var(--primary-color);
        color: white;
    }
    
    .instructor-modal-pic {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid var(--primary-color);
        margin: 0 auto 20px;
        display: block;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }
    
    .course-description {
        line-height: 1.6;
    }
    
    /* Video controls */
    .video-controls {
        margin-top: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .control-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .control-btn:hover {
        background-color: #2980b9;
        transform: scale(1.05);
    }
    
    .control-btn:disabled {
        background-color: #95a5a6;
        cursor: not-allowed;
    }
    
    .category-badge {
        background-color: var(--secondary-color);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.85rem;
        display: inline-block;
        margin-bottom: 10px;
    }
    
    .price-info {
        display: flex;
        align-items: baseline;
        gap: 10px;
        margin-top: 10px;
    }
    
    .current-price {
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--accent-color);
    }
    
    .old-price {
        text-decoration: line-through;
        color: #6c757d;
    }
    
    .pdf-viewer {
        width: 100%;
        height: 450px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    
    .content-empty {
        padding: 20px;
        text-align: center;
        color: #6c757d;
    }
    
    .content-details-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0,0,0,0.7);
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
    }
    
    .content-details-btn:hover {
        background: rgba(0,0,0,0.9);
    }
</style>

<div class="container main-container">
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="video-container p-3">
                <button class="content-details-btn" id="contentDetailsBtn" title="Détails du contenu">
                    <i class="fas fa-info"></i>
                </button>
                <h2 class="video-title" id="contentTitle">{{ $course->titre }} - Introduction</h2>
                <div id="mediaContainer">
                    <div class="ratio ratio-16x9">
                        <video id="currentVideo" controls>
                            <source src="{{ asset('storage/' . $course->video_intro) }}" type="video/mp4">
                            Votre navigateur ne prend pas en charge la lecture de vidéos.
                        </video>
                    </div>
                </div>
                <div class="video-controls">
                    <button class="control-btn" id="prevBtn" title="Précédent" disabled>
                        <i class="fas fa-step-backward"></i>
                    </button>
                    <button class="control-btn" id="playBtn" title="Lecture/Pause">
                        <i class="fas fa-play"></i>
                    </button>
                    <button class="control-btn" id="nextBtn" title="Suivant" disabled>
                        <i class="fas fa-step-forward"></i>
                    </button>
                    <div class="progress w-100" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: %"></div>
                    </div>
                    <span id="videoTime">00:00 / 00:00</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="playlist-container">
                <h5 class="section-title">Contenu du cours ({{ $course->contents->count() + 1 }})</h5>
                
                <!-- Introduction video -->
                <div class="playlist-item active" 
                     data-media="{{ asset('storage/' . $course->video_intro) }}" 
                     data-title="{{ $course->titre }} - Introduction"
                     data-type="video"
                     data-order="0"
                     data-description="Vidéo d'introduction du cours">
                    <div class="item-order">0</div>
                    <div class="item-content">
                        <div class="item-title">Introduction</div>
                        <div class="item-meta">Vidéo d'introduction</div>
                    </div>
                    <div class="item-icon">
                        <i class="fas fa-play-circle"></i>
                    </div>
                </div>
                
                <!-- Course contents -->
                @php
                    $videoCount = 1;
                    $pdfCount = 1;
                @endphp
                
                @foreach($course->contents->sortBy('created_at') as $content)
                    @if($content->type == 'video')
                        <div class="playlist-item {{ $content->is_viewed ? 'viewed' : '' }}" 
                             data-media="{{ asset('storage/' . $content->chemin) }}" 
                             data-title="{{ $content->titre }}"
                             data-type="video"
                             data-order="{{ $videoCount }}"
                             data-content-id="{{ $content->id }}"
                             data-description="{{ $content->description }}"
                             data-duration="{{ $content->duree }} min"
                             data-created="{{ $content->created_at->format('d/m/Y') }}">
                            <div class="item-order">{{ $videoCount }}</div>
                            <div class="item-content">
                                <div class="item-title">{{ $content->titre }}</div>
                                <div class="item-meta">Vidéo • {{ $content->duree }} min</div>
                            </div>
                            <div class="item-icon">
                                <i class="fas fa-play-circle"></i>
                            </div>
                        </div>
                        @php $videoCount++; @endphp
                    @elseif($content->type == 'pdf')
                        <div class="playlist-item {{ $content->is_viewed ? 'viewed' : '' }}" 
                             data-media="{{ asset('storage/' . $content->chemin) }}" 
                             data-title="{{ $content->titre }}"
                             data-type="pdf"
                             data-order="{{ $pdfCount }}"
                             data-content-id="{{ $content->id }}"
                             data-description="{{ $content->description }}"
                             data-pages="{{ $content->nombre_pages }} pages"
                             data-created="{{ $content->created_at->format('d/m/Y') }}">
                            <div class="item-order">{{ $pdfCount }}</div>
                            <div class="item-content">
                                <div class="item-title">{{ $content->titre }}</div>
                                <div class="item-meta">PDF • {{ $content->nombre_pages }} pages</div>
                            </div>
                            <div class="item-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                        </div>
                        @php $pdfCount++; @endphp
                    @endif
                @endforeach
                
                @if($course->contents->count() == 0)
                    <div class="content-empty">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <p>Aucun contenu disponible pour ce cours pour le moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="course-info">
        <div class="category-badge">
            <i class="fas fa-tag me-1"></i> {{ $course->category->nom }}
        </div>
        <h3>{{ $course->titre }}</h3>
        <div class="price-info mb-3">
            <span class="current-price">{{ $course->price }} DH</span>
            @if($course->old_price)
            <span class="old-price">{{ $course->old_price }} DH</span>
            @endif
        </div>
        <div class="instructor-info">
            @if($course->formateur->user->profile->photo ?? false)
            <img src="{{ asset('storage/' . $course->formateur->user->profile->photo) }}" alt="Formateur" class="instructor-pic" data-bs-toggle="modal" data-bs-target="#instructorModal">
            @else
            <img src="/api/placeholder/150/150" alt="Formateur" class="instructor-pic" data-bs-toggle="modal" data-bs-target="#instructorModal">
            @endif
            <div class="instructor-name">
                {{ $course->formateur->user->name ?? 'Formateur' }}
                <p class="text-muted mb-0">{{ $course->formateur->user->profile->bio ?? 'Expert' }}</p>
            </div>
        </div>
        <div class="course-description">
            <p>{{ $course->description }}</p>
        </div>
        <div class="progress-container">
            <div class="d-flex justify-content-between mb-2">
                <span>Progression du cours</span>
                <span>% complété</span>
            </div>
            <div class="progress" style="height: 10px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: %"></div>
            </div>
        </div>
    </div>
</div>

<!-- Instructor Modal -->
<div class="modal fade" id="instructorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Profil du formateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($course->formateur->user->profile->photo ?? false)
                <img src="{{ asset('storage/' . $course->formateur->user->profile->photo) }}" alt="Photo du formateur" class="instructor-modal-pic">
                @else
                <img src="/api/placeholder/150/150" alt="Photo du formateur" class="instructor-modal-pic">
                @endif
                <h4 class="text-center mb-3">{{ $course->formateur->user->name ?? 'Formateur' }}</h4>
                
                <div class="mb-3">
                    <h5>Spécialité</h5>
                    <p>{{ $course->formateur->user->profile->specialite ?? 'Formateur professionnel' }}</p>
                </div>
                
                <div class="mb-3">
                    <h5>Biographie</h5>
                    <p>{{ $course->formateur->user->profile->bio ?? 'Information non disponible' }}</p>
                </div>
                
                @if($course->formateur->user->profile->education ?? false)
                <div class="mb-3">
                    <h5>Formation</h5>
                    <p>{{ $course->formateur->user->profile->education }}</p>
                </div>
                @endif
                
                <div class="mb-3">
                    <h5>Contact</h5>
                    <p><i class="fas fa-envelope me-2"></i>{{ $course->formateur->user->email ?? 'Email non disponible' }}</p>
                    @if($course->formateur->user->profile->website ?? false)
                    <p><i class="fas fa-globe me-2"></i>{{ $course->formateur->user->profile->website }}</p>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Voir tous les cours</button>
            </div>
        </div>
    </div>
</div>

<!-- Content Details Modal -->
<div class="modal fade" id="contentDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contentModalTitle">Détails du contenu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h6>Description</h6>
                    <p id="contentModalDescription"></p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Type</h6>
                        <p id="contentModalType"></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Durée/Pages</h6>
                        <p id="contentModalDuration"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Date d'ajout</h6>
                        <p id="contentModalCreated"></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Statut</h6>
                        <p id="contentModalStatus"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<script>
    // Configure PDF.js worker path
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';
    
    document.addEventListener('DOMContentLoaded', function() {
        const mediaContainer = document.getElementById('mediaContainer');
        const contentTitle = document.getElementById('contentTitle');
        const playBtn = document.getElementById('playBtn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const progressBar = document.querySelector('.progress-bar');
        const videoTime = document.getElementById('videoTime');
        const playlistItems = document.querySelectorAll('.playlist-item');
        const contentDetailsBtn = document.getElementById('contentDetailsBtn');
        const contentDetailsModal = new bootstrap.Modal(document.getElementById('contentDetailsModal'));
        const courseId = {{ $course->id }};
        
        let currentIndex = 0;
        let currentVideo = document.getElementById('currentVideo');
        let currentPdfViewer = null;
        
        // Initialize the first item as active
        updateActiveItem();
        updateNavButtons();
        
        // Event listeners
        playBtn.addEventListener('click', togglePlay);
        prevBtn.addEventListener('click', playPrevious);
        nextBtn.addEventListener('click', playNext);
        contentDetailsBtn.addEventListener('click', showContentDetails);
        
        // Handle playlist item clicks
        playlistItems.forEach((item, index) => {
            item.addEventListener('click', function() {
                currentIndex = index;
                loadMedia(this);
                updateActiveItem();
                updateNavButtons();
            });
        });
        
        // Handle video events
        if (currentVideo) {
            currentVideo.addEventListener('timeupdate', updateProgress);
            currentVideo.addEventListener('ended', function() {
                markAsViewed(playlistItems[currentIndex]);
                if (currentIndex < playlistItems.length - 1) {
                    playNext();
                }
            });
        }
        
        function loadMedia(item) {
            const mediaUrl = item.getAttribute('data-media');
            const mediaType = item.getAttribute('data-type');
            const title = item.getAttribute('data-title');
            
            contentTitle.textContent = title;
            
            if (mediaType === 'video') {
                // Load video
                mediaContainer.innerHTML = `
                    <div class="ratio ratio-16x9">
                        <video id="currentVideo" controls>
                            <source src="${mediaUrl}" type="video/mp4">
                            Votre navigateur ne prend pas en charge la lecture de vidéos.
                        </video>
                    </div>
                `;
                
                currentVideo = document.getElementById('currentVideo');
                currentVideo.addEventListener('timeupdate', updateProgress);
                currentVideo.addEventListener('ended', function() {
                    markAsViewed(item);
                    if (currentIndex < playlistItems.length - 1) {
                        playNext();
                    }
                });
                
                // Update play button state
                playBtn.innerHTML = '<i class="fas fa-pause"></i>';
                playBtn.onclick = togglePlay;
                
            } else if (mediaType === 'pdf') {
                // Load PDF
                mediaContainer.innerHTML = `
                    <div class="pdf-viewer-container">
                        <canvas id="pdfViewer" class="pdf-viewer"></canvas>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <button class="btn btn-sm btn-primary" id="prevPage">Précédent</button>
                        <span id="pageInfo">Page 1 sur 1</span>
                        <button class="btn btn-sm btn-primary" id="nextPage">Suivant</button>
                    </div>
                `;
                
                // Initialize PDF viewer
                const pdfViewer = document.getElementById('pdfViewer');
                const pageInfo = document.getElementById('pageInfo');
                const prevPageBtn = document.getElementById('prevPage');
                const nextPageBtn = document.getElementById('nextPage');
                
                let pdfDoc = null,
                    pageNum = 1,
                    pageRendering = false,
                    pageNumPending = null;
                
                // Render the PDF page
                function renderPage(num) {
                    pageRendering = true;
                    pdfDoc.getPage(num).then(function(page) {
                        const viewport = page.getViewport({ scale: 1.5 });
                        const canvas = document.getElementById('pdfViewer');
                        const context = canvas.getContext('2d');
                        
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        
                        const renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        
                        const renderTask = page.render(renderContext);
                        
                        renderTask.promise.then(function() {
                            pageRendering = false;
                            if (pageNumPending !== null) {
                                renderPage(pageNumPending);
                                pageNumPending = null;
                            }
                        });
                    });
                    
                    pageInfo.textContent = `Page ${num} sur ${pdfDoc.numPages}`;
                }
                
                // Go to previous page
                function onPrevPage() {
                    if (pageNum <= 1) return;
                    pageNum--;
                    queueRenderPage(pageNum);
                }
                
                // Go to next page
                function onNextPage() {
                    if (pageNum >= pdfDoc.numPages) return;
                    pageNum++;
                    queueRenderPage(pageNum);
                }
                
                function queueRenderPage(num) {
                    if (pageRendering) {
                        pageNumPending = num;
                    } else {
                        renderPage(num);
                    }
                }
                
                // Load the PDF document
                pdfjsLib.getDocument(mediaUrl).promise.then(function(pdfDoc_) {
                    pdfDoc = pdfDoc_;
                    renderPage(pageNum);
                    
                    // Mark as viewed after 5 seconds of viewing
                    setTimeout(() => {
                        markAsViewed(item);
                    }, 5000);
                });
                
                // Add event listeners for buttons
                prevPageBtn.addEventListener('click', onPrevPage);
                nextPageBtn.addEventListener('click', onNextPage);
                
                // Update play button state (disabled for PDF)
                playBtn.innerHTML = '<i class="fas fa-play"></i>';
                playBtn.onclick = null;
            }
        }
        
        function togglePlay() {
            if (currentVideo.paused) {
                currentVideo.play();
                playBtn.innerHTML = '<i class="fas fa-pause"></i>';
            } else {
                currentVideo.pause();
                playBtn.innerHTML = '<i class="fas fa-play"></i>';
            }
        }
        
        function updateProgress() {
            if (!currentVideo) return;
            
            const value = (currentVideo.currentTime / currentVideo.duration) * 100;
            progressBar.style.width = value + '%';
            
            // Format time
            const currentMinutes = Math.floor(currentVideo.currentTime / 60);
            const currentSeconds = Math.floor(currentVideo.currentTime % 60);
            const durationMinutes = Math.floor(currentVideo.duration / 60) || 0;
            const durationSeconds = Math.floor(currentVideo.duration % 60) || 0;
            
            videoTime.textContent = `${currentMinutes.toString().padStart(2, '0')}:${currentSeconds.toString().padStart(2, '0')} / ${durationMinutes.toString().padStart(2, '0')}:${durationSeconds.toString().padStart(2, '0')}`;
        }
        
        function playPrevious() {
            if (currentIndex > 0) {
                currentIndex--;
                loadMedia(playlistItems[currentIndex]);
                updateActiveItem();
                updateNavButtons();
            }
        }
        
        function playNext() {
            if (currentIndex < playlistItems.length - 1) {
                currentIndex++;
                loadMedia(playlistItems[currentIndex]);
                updateActiveItem();
                updateNavButtons();
            }
        }
        
        function updateActiveItem() {
            // Remove active class from all items
            playlistItems.forEach(el => {
                el.classList.remove('active');
            });
            
            // Add active class to current item
            playlistItems[currentIndex].classList.add('active');
        }
        
        function updateNavButtons() {
            // Update previous button
            if (currentIndex <= 0) {
                prevBtn.disabled = true;
            } else {
                prevBtn.disabled = false;
            }
            
            // Update next button
            if (currentIndex >= playlistItems.length - 1) {
                nextBtn.disabled = true;
            } else {
                nextBtn.disabled = false;
            }
        }
        
        function markAsViewed(item) {
            if (item.classList.contains('viewed')) return;
            
            item.classList.add('viewed');
            updateCourseProgress();
            
            const contentId = item.getAttribute('data-content-id');
            if (!contentId) return; // Skip for introduction
            
            // Send AJAX request to mark as viewed
            fetch(`/courses/${courseId}/contents/${contentId}/viewed`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCourseProgress();
                }
            });
        }
        
        function updateCourseProgress() {
            // Calculate progress locally first
            const totalItems = playlistItems.length;
            const viewedItems = document.querySelectorAll('.playlist-item.viewed').length;
            const progress = Math.round((viewedItems / totalItems) * 100);
            
            document.querySelectorAll('.progress-bar').forEach(bar => {
                bar.style.width = progress + '%';
            });
            
            document.querySelectorAll('.progress-container span:last-child').forEach(el => {
                el.textContent = progress + '% complété';
            });
            
            // Get updated progress from server
            fetch(`/courses/${courseId}/progress`)
                .then(response => response.json())
                .then(data => {
                    if (data.progress) {
                        document.querySelectorAll('.progress-bar').forEach(bar => {
                            bar.style.width = data.progress + '%';
                        });
                        
                        document.querySelectorAll('.progress-container span:last-child').forEach(el => {
                            el.textContent = data.progress + '% complété';
                        });
                    }
                });
        }
        
        function showContentDetails() {
            const currentItem = playlistItems[currentIndex];
            const modalTitle = document.getElementById('contentModalTitle');
            const modalDescription = document.getElementById('contentModalDescription');
            const modalType = document.getElementById('contentModalType');
            const modalDuration = document.getElementById('contentModalDuration');
            const modalCreated = document.getElementById('contentModalCreated');
            const modalStatus = document.getElementById('contentModalStatus');
            
            modalTitle.textContent = currentItem.getAttribute('data-title');
            modalDescription.textContent = currentItem.getAttribute('data-description') || 'Pas de description disponible';
            
            if (currentItem.getAttribute('data-type') === 'video') {
                modalType.textContent = 'Vidéo';
                modalDuration.textContent = currentItem.getAttribute('data-duration') || 'Durée non spécifiée';
            } else {
                modalType.textContent = 'Document PDF';
                modalDuration.textContent = currentItem.getAttribute('data-pages') || 'Pages non spécifiées';
            }
            
            modalCreated.textContent = currentItem.getAttribute('data-created') || 'Date inconnue';
            modalStatus.textContent = currentItem.classList.contains('viewed') ? 'Déjà vu' : 'Non vu';
            
            contentDetailsModal.show();
        }
    });
</script>
@endsection --}}



@extends('layouts.frontend')
@section('title', 'Détails du Cours - ' . $course->titre)
@section('contents')
<style>
    :root {
        --primary-color: #3498db;
        --secondary-color: #2c3e50;
        --accent-color: #e74c3c;
        --bg-light: #f8f9fa;
        --text-dark: #333;
    }
    
    .navbar {
        background-color: var(--secondary-color);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .navbar-brand {
        font-weight: 700;
        color: white !important;
    }
    
    .main-container {
        padding: 20px;
        min-height: calc(100vh - 76px);
    }
    
    .video-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        background-color: white;
        height: 500px;
        position: relative;
    }
    
    .playlist-container {
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        height: 500px;
        overflow-y: auto;
    }
    
    .playlist-item {
        padding: 12px 15px;
        border-bottom: 1px solid #f1f1f1;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
    }
    
    .playlist-item:hover {
        background-color: var(--bg-light);
    }
    
    .playlist-item.active {
        background-color: var(--primary-color);
        color: white;
    }
    
    .item-order {
        font-weight: bold;
        margin-right: 10px;
        min-width: 25px;
        text-align: center;
    }
    
    .item-content {
        flex: 1;
    }
    
    .item-title {
        font-weight: 500;
        margin-bottom: 3px;
    }
    
    .item-meta {
        font-size: 0.8rem;
        color: #6c757d;
    }
    
    .playlist-item.active .item-meta,
    .playlist-item.active .item-icon {
        color: rgba(255,255,255,0.8);
    }
    
    .item-icon {
        margin-left: 10px;
        font-size: 1.2rem;
        color: #6c757d;
    }
    
    .section-title {
        padding: 12px 15px;
        background-color: var(--secondary-color);
        color: white;
        font-weight: 600;
        margin: 0;
        position: sticky;
        top: 0;
        z-index: 1;
    }
    
    .pdf-section {
        border-top: 2px solid #f1f1f1;
    }
    
    .video-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .course-info {
        margin-top: 20px;
        padding: 20px;
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .instructor-info {
        display: flex;
        align-items: center;
        margin: 20px 0;
    }
    
    .instructor-pic {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary-color);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .instructor-pic:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(52, 152, 219, 0.5);
    }
    
    .instructor-name {
        font-weight: 600;
        font-size: 1.2rem;
        margin-left: 15px;
    }
    
    .modal-header {
        background-color: var(--primary-color);
        color: white;
    }
    
    .instructor-modal-pic {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid var(--primary-color);
        margin: 0 auto 20px;
        display: block;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }
    
    .course-description {
        line-height: 1.6;
    }
    
    /* Video controls */
    .video-controls {
        margin-top: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .control-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .control-btn:hover {
        background-color: #2980b9;
        transform: scale(1.05);
    }
    
    .control-btn:disabled {
        background-color: #95a5a6;
        cursor: not-allowed;
    }
    
    .category-badge {
        background-color: var(--secondary-color);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.85rem;
        display: inline-block;
        margin-bottom: 10px;
    }
    
    .price-info {
        display: flex;
        align-items: baseline;
        gap: 10px;
        margin-top: 10px;
    }
    
    .current-price {
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--accent-color);
    }
    
    .old-price {
        text-decoration: line-through;
        color: #6c757d;
    }
    
    .pdf-viewer {
        width: 100%;
        height: 450px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    
    .content-empty {
        padding: 20px;
        text-align: center;
        color: #6c757d;
    }
    
    .content-details-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0,0,0,0.7);
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
    }
    
    .content-details-btn:hover {
        background: rgba(0,0,0,0.9);
    }
</style>

<div class="container main-container">
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="video-container p-3">
                <button class="content-details-btn" id="contentDetailsBtn" title="Détails du contenu">
                    <i class="fas fa-info"></i>
                </button>
                <h2 class="video-title" id="contentTitle">{{ $course->titre }} - Introduction</h2>
                <div id="mediaContainer">
                    <div class="ratio ratio-16x9">
                        <video id="currentVideo" controls>
                            <source src="{{ asset('storage/' . $course->video_intro) }}" type="video/mp4">
                            Votre navigateur ne prend pas en charge la lecture de vidéos.
                        </video>
                    </div>
                </div>
                <div class="video-controls">
                    <button class="control-btn" id="prevBtn" title="Précédent" disabled>
                        <i class="fas fa-step-backward"></i>
                    </button>
                    <button class="control-btn" id="playBtn" title="Lecture/Pause">
                        <i class="fas fa-play"></i>
                    </button>
                    <button class="control-btn" id="nextBtn" title="Suivant" disabled>
                        <i class="fas fa-step-forward"></i>
                    </button>
                    <span id="videoTime">00:00 / 00:00</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="playlist-container">
                <h5 class="section-title">Contenu du cours ({{ $course->contents->count() + 1 }})</h5>
                
                <!-- Introduction video -->
                <div class="playlist-item active" 
                     data-media="{{ asset('storage/' . $course->video_intro) }}" 
                     data-title="{{ $course->titre }} - Introduction"
                     data-type="video"
                     data-order="0"
                     data-description="Vidéo d'introduction du cours">
                    <div class="item-order">0</div>
                    <div class="item-content">
                        <div class="item-title">Introduction</div>
                        <div class="item-meta">Vidéo d'introduction</div>
                    </div>
                    <div class="item-icon">
                        <i class="fas fa-play-circle"></i>
                    </div>
                </div>
                
                <!-- Course contents -->
                @php
                    $videoCount = 1;
                    $pdfCount = 1;
                @endphp
                
                @foreach($course->contents->sortBy('created_at') as $content)
                    @if($content->type == 'video')
                        <div class="playlist-item" 
                             data-media="{{ asset('storage/' . $content->chemin) }}" 
                             data-title="{{ $content->titre }}"
                             data-type="video"
                             data-order="{{ $videoCount }}"
                             data-content-id="{{ $content->id }}"
                             data-description="{{ $content->description }}"
                             data-duration="{{ $content->duree }} min"
                             data-created="{{ $content->created_at->format('d/m/Y') }}">
                            <div class="item-order">{{ $videoCount }}</div>
                            <div class="item-content">
                                <div class="item-title">{{ $content->titre }}</div>
                                <div class="item-meta">Vidéo • {{ $content->duree }} min</div>
                            </div>
                            <div class="item-icon">
                                <i class="fas fa-play-circle"></i>
                            </div>
                        </div>
                        @php $videoCount++; @endphp
                    @elseif($content->type == 'pdf')
                        <div class="playlist-item" 
                             data-media="{{ asset('storage/' . $content->chemin) }}" 
                             data-title="{{ $content->titre }}"
                             data-type="pdf"
                             data-order="{{ $pdfCount }}"
                             data-content-id="{{ $content->id }}"
                             data-description="{{ $content->description }}"
                             data-pages="{{ $content->nombre_pages }} pages"
                             data-created="{{ $content->created_at->format('d/m/Y') }}">
                            <div class="item-order">{{ $pdfCount }}</div>
                            <div class="item-content">
                                <div class="item-title">{{ $content->titre }}</div>
                                <div class="item-meta">PDF • {{ $content->nombre_pages }} pages</div>
                            </div>
                            <div class="item-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                        </div>
                        @php $pdfCount++; @endphp
                    @endif
                @endforeach
                
                @if($course->contents->count() == 0)
                    <div class="content-empty">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <p>Aucun contenu disponible pour ce cours pour le moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="course-info">
        <div class="category-badge">
            <i class="fas fa-tag me-1"></i> {{ $course->category->nom }}
        </div>
        <h3>{{ $course->titre }}</h3>
        <div class="price-info mb-3">
            <span class="current-price">{{ $course->price }} DH</span>
            @if($course->old_price)
            <span class="old-price">{{ $course->old_price }} DH</span>
            @endif
        </div>
        <div class="instructor-info">
            @if($course->formateur->user->profile->photo ?? false)
            <img src="{{ asset('storage/' . $course->formateur->user->profile->photo) }}" alt="Formateur" class="instructor-pic" data-bs-toggle="modal" data-bs-target="#instructorModal">
            @else
            <img src="/api/placeholder/150/150" alt="Formateur" class="instructor-pic" data-bs-toggle="modal" data-bs-target="#instructorModal">
            @endif
            <div class="instructor-name">
                {{ $course->formateur->user->name ?? 'Formateur' }}
                <p class="text-muted mb-0">{{ $course->formateur->user->profile->bio ?? 'Expert' }}</p>
            </div>
        </div>
        <div class="course-description">
            <p>{{ $course->description }}</p>
        </div>
    </div>
</div>

<!-- Instructor Modal -->
<div class="modal fade" id="instructorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Profil du formateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($course->formateur->user->profile->photo ?? false)
                <img src="{{ asset('storage/' . $course->formateur->user->profile->photo) }}" alt="Photo du formateur" class="instructor-modal-pic">
                @else
                <img src="/api/placeholder/150/150" alt="Photo du formateur" class="instructor-modal-pic">
                @endif
                <h4 class="text-center mb-3">{{ $course->formateur->user->name ?? 'Formateur' }}</h4>
                
                <div class="mb-3">
                    <h5>Spécialité</h5>
                    <p>{{ $course->formateur->user->profile->specialite ?? 'Formateur professionnel' }}</p>
                </div>
                
                <div class="mb-3">
                    <h5>Biographie</h5>
                    <p>{{ $course->formateur->user->profile->bio ?? 'Information non disponible' }}</p>
                </div>
                
                @if($course->formateur->user->profile->education ?? false)
                <div class="mb-3">
                    <h5>Formation</h5>
                    <p>{{ $course->formateur->user->profile->education }}</p>
                </div>
                @endif
                
                <div class="mb-3">
                    <h5>Contact</h5>
                    <p><i class="fas fa-envelope me-2"></i>{{ $course->formateur->user->email ?? 'Email non disponible' }}</p>
                    @if($course->formateur->user->profile->website ?? false)
                    <p><i class="fas fa-globe me-2"></i>{{ $course->formateur->user->profile->website }}</p>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Voir tous les cours</button>
            </div>
        </div>
    </div>
</div>

<!-- Content Details Modal -->
<div class="modal fade" id="contentDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contentModalTitle">Détails du contenu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h6>Description</h6>
                    <p id="contentModalDescription"></p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Type</h6>
                        <p id="contentModalType"></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Durée/Pages</h6>
                        <p id="contentModalDuration"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Date d'ajout</h6>
                        <p id="contentModalCreated"></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Statut</h6>
                        <p id="contentModalStatus">Non vu</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<script>
    // Configure PDF.js worker path
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';
    
    document.addEventListener('DOMContentLoaded', function() {
        const mediaContainer = document.getElementById('mediaContainer');
        const contentTitle = document.getElementById('contentTitle');
        const playBtn = document.getElementById('playBtn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const videoTime = document.getElementById('videoTime');
        const playlistItems = document.querySelectorAll('.playlist-item');
        const contentDetailsBtn = document.getElementById('contentDetailsBtn');
        const contentDetailsModal = new bootstrap.Modal(document.getElementById('contentDetailsModal'));
        const courseId = {{ $course->id }};
        
        let currentIndex = 0;
        let currentVideo = document.getElementById('currentVideo');
        let currentPdfViewer = null;
        
        // Initialize the first item as active
        updateActiveItem();
        updateNavButtons();
        
        // Event listeners
        playBtn.addEventListener('click', togglePlay);
        prevBtn.addEventListener('click', playPrevious);
        nextBtn.addEventListener('click', playNext);
        contentDetailsBtn.addEventListener('click', showContentDetails);
        
        // Handle playlist item clicks
        playlistItems.forEach((item, index) => {
            item.addEventListener('click', function() {
                currentIndex = index;
                loadMedia(this);
                updateActiveItem();
                updateNavButtons();
            });
        });
        
        // Handle video events
        if (currentVideo) {
            currentVideo.addEventListener('timeupdate', updateVideoTime);
            currentVideo.addEventListener('ended', function() {
                if (currentIndex < playlistItems.length - 1) {
                    playNext();
                }
            });
        }
        
        function loadMedia(item) {
            const mediaUrl = item.getAttribute('data-media');
            const mediaType = item.getAttribute('data-type');
            const title = item.getAttribute('data-title');
            
            contentTitle.textContent = title;
            
            if (mediaType === 'video') {
                // Load video
                mediaContainer.innerHTML = `
                    <div class="ratio ratio-16x9">
                        <video id="currentVideo" controls>
                            <source src="${mediaUrl}" type="video/mp4">
                            Votre navigateur ne prend pas en charge la lecture de vidéos.
                        </video>
                    </div>
                `;
                
                currentVideo = document.getElementById('currentVideo');
                currentVideo.addEventListener('timeupdate', updateVideoTime);
                currentVideo.addEventListener('ended', function() {
                    if (currentIndex < playlistItems.length - 1) {
                        playNext();
                    }
                });
                
                // Update play button state
                playBtn.innerHTML = '<i class="fas fa-pause"></i>';
                playBtn.onclick = togglePlay;
                
            } else if (mediaType === 'pdf') {
                // Load PDF
                mediaContainer.innerHTML = `
                    <div class="pdf-viewer-container">
                        <canvas id="pdfViewer" class="pdf-viewer"></canvas>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <button class="btn btn-sm btn-primary" id="prevPage">Précédent</button>
                        <span id="pageInfo">Page 1 sur 1</span>
                        <button class="btn btn-sm btn-primary" id="nextPage">Suivant</button>
                    </div>
                `;
                
                // Initialize PDF viewer
                const pdfViewer = document.getElementById('pdfViewer');
                const pageInfo = document.getElementById('pageInfo');
                const prevPageBtn = document.getElementById('prevPage');
                const nextPageBtn = document.getElementById('nextPage');
                
                let pdfDoc = null,
                    pageNum = 1,
                    pageRendering = false,
                    pageNumPending = null;
                
                // Render the PDF page
                function renderPage(num) {
                    pageRendering = true;
                    pdfDoc.getPage(num).then(function(page) {
                        const viewport = page.getViewport({ scale: 1.5 });
                        const canvas = document.getElementById('pdfViewer');
                        const context = canvas.getContext('2d');
                        
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        
                        const renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        
                        const renderTask = page.render(renderContext);
                        
                        renderTask.promise.then(function() {
                            pageRendering = false;
                            if (pageNumPending !== null) {
                                renderPage(pageNumPending);
                                pageNumPending = null;
                            }
                        });
                    });
                    
                    pageInfo.textContent = `Page ${num} sur ${pdfDoc.numPages}`;
                }
                
                // Go to previous page
                function onPrevPage() {
                    if (pageNum <= 1) return;
                    pageNum--;
                    queueRenderPage(pageNum);
                }
                
                // Go to next page
                function onNextPage() {
                    if (pageNum >= pdfDoc.numPages) return;
                    pageNum++;
                    queueRenderPage(pageNum);
                }
                
                function queueRenderPage(num) {
                    if (pageRendering) {
                        pageNumPending = num;
                    } else {
                        renderPage(num);
                    }
                }
                
                // Load the PDF document
                pdfjsLib.getDocument(mediaUrl).promise.then(function(pdfDoc_) {
                    pdfDoc = pdfDoc_;
                    renderPage(pageNum);
                });
                
                // Add event listeners for buttons
                prevPageBtn.addEventListener('click', onPrevPage);
                nextPageBtn.addEventListener('click', onNextPage);
                
                // Update play button state (disabled for PDF)
                playBtn.innerHTML = '<i class="fas fa-play"></i>';
                playBtn.onclick = null;
            }
        }
        
        function togglePlay() {
            if (currentVideo.paused) {
                currentVideo.play();
                playBtn.innerHTML = '<i class="fas fa-pause"></i>';
            } else {
                currentVideo.pause();
                playBtn.innerHTML = '<i class="fas fa-play"></i>';
            }
        }
        
        function updateVideoTime() {
            if (!currentVideo) return;
            
            // Format time
            const currentMinutes = Math.floor(currentVideo.currentTime / 60);
            const currentSeconds = Math.floor(currentVideo.currentTime % 60);
            const durationMinutes = Math.floor(currentVideo.duration / 60) || 0;
            const durationSeconds = Math.floor(currentVideo.duration % 60) || 0;
            
            videoTime.textContent = `${currentMinutes.toString().padStart(2, '0')}:${currentSeconds.toString().padStart(2, '0')} / ${durationMinutes.toString().padStart(2, '0')}:${durationSeconds.toString().padStart(2, '0')}`;
        }
        
        function playPrevious() {
            if (currentIndex > 0) {
                currentIndex--;
                loadMedia(playlistItems[currentIndex]);
                updateActiveItem();
                updateNavButtons();
            }
        }
        
        function playNext() {
            if (currentIndex < playlistItems.length - 1) {
                currentIndex++;
                loadMedia(playlistItems[currentIndex]);
                updateActiveItem();
                updateNavButtons();
            }
        }
        
        function updateActiveItem() {
            // Remove active class from all items
            playlistItems.forEach(el => {
                el.classList.remove('active');
            });
            
            // Add active class to current item
            playlistItems[currentIndex].classList.add('active');
        }
        
        function updateNavButtons() {
            // Update previous button
            if (currentIndex <= 0) {
                prevBtn.disabled = true;
            } else {
                prevBtn.disabled = false;
            }
            
            // Update next button
            if (currentIndex >= playlistItems.length - 1) {
                nextBtn.disabled = true;
            } else {
                nextBtn.disabled = false;
            }
        }
        
        function showContentDetails() {
            const currentItem = playlistItems[currentIndex];
            const modalTitle = document.getElementById('contentModalTitle');
            const modalDescription = document.getElementById('contentModalDescription');
            const modalType = document.getElementById('contentModalType');
            const modalDuration = document.getElementById('contentModalDuration');
            const modalCreated = document.getElementById('contentModalCreated');
            
            modalTitle.textContent = currentItem.getAttribute('data-title');
            modalDescription.textContent = currentItem.getAttribute('data-description') || 'Pas de description disponible';
            
            if (currentItem.getAttribute('data-type') === 'video') {
                modalType.textContent = 'Vidéo';
                modalDuration.textContent = currentItem.getAttribute('data-duration') || 'Durée non spécifiée';
            } else {
                modalType.textContent = 'Document PDF';
                modalDuration.textContent = currentItem.getAttribute('data-pages') || 'Pages non spécifiées';
            }
            
            modalCreated.textContent = currentItem.getAttribute('data-created') || 'Date inconnue';
            document.getElementById('contentModalStatus').textContent = 'Non vu';
            
            contentDetailsModal.show();
        }
    });
</script>
@endsection
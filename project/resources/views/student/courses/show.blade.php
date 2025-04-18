{{-- 

<!-- student/courses/show.blade.php -->
@extends('layouts.frontend')

@section('contents')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Course Content Sidebar -->
        <div class="col-lg-3">
            <div class="card shadow-sm sidebar-course">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Course Content</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($course->contents as $index => $content)
                        <a href="#" class="list-group-item list-group-item-action content-item py-3 px-3 border-bottom 
                            {{ request()->get('content_id') == $content->id ? 'active' : '' }}"
                            data-content-id="{{ $content->id }}" onclick="loadContent({{ $content->id }})">
                            <div class="d-flex align-items-center">
                                <div class="content-icon me-3">
                                    @if($content->type == 'video')
                                    <i class="bi bi-play-circle-fill text-danger fs-4"></i>
                                    @else
                                    <i class="bi bi-file-pdf-fill text-primary fs-4"></i>
                                    @endif
                                </div>
                                <div class="content-info flex-grow-1">
                                    <div><strong>{{ $index + 1 }}. {{ $content->titre }}</strong></div>
                                    <div class="text-muted small">
                                        @if($content->type == 'video')
                                        <i class="bi bi-clock"></i> {{ $content->duree }} minutes
                                        @else
                                        <i class="bi bi-file-text"></i> {{ $content->nombre_pages ?? 'N/A' }} pages
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
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
                        <div>
                            <div class="instructor-preview d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#instructorModal">
                                <img src="{{ asset('storage/' . $course->formateur->user->profile->photo) }}" 
                                    class="rounded-circle me-2" alt="Instructor" style="width:40px; height:40px; object-fit:cover;">
                                <div>
                                    <small class="text-muted d-block">Instructor</small>
                                    <strong>{{ $course->formateur->user->name }}</strong>
                                </div>
                            </div>
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
                            
                            <!-- Course Progress -->
                            <div class="mt-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Your Progress</span>
                                    <span>25%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" 
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
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
                                    
                                    <div>
                                        <button class="btn btn-success btn-sm">
                                            <i class="bi bi-check-circle"></i> Mark as Complete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
                    <img src="{{ asset('storage/' . $course->formateur->user->profile->avatar) }} " 
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

@endsection

@push('style')
<style>
    .sidebar-course {
        height: calc(100vh - 100px);
        overflow-y: auto;
    }
    
    .content-item {
        transition: all 0.2s;
    }
    
    .content-item:hover {
        background-color: #f8f9fa;
    }
    
    .content-item.active {
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
    
    .progress {
        border-radius: 20px;
        background-color: #e9ecef;
    }
    
    .progress-bar {
        border-radius: 20px;
    }
</style>
@endpush

@push('script')
<script>
    // Function to load content
    function loadContent(contentId) {
        // Hide all content containers
        document.querySelectorAll('.content-container').forEach(function(elem) {
            elem.style.display = 'none';
        });
        
        // Hide default content
        document.getElementById('default-content').style.display = 'none';
        
        // Show selected content
        document.getElementById('content-' + contentId).style.display = 'block';
        
        // Update active class in sidebar
        document.querySelectorAll('.content-item').forEach(function(elem) {
            elem.classList.remove('active');
        });
        
        const selectedItem = document.querySelector(`.content-item[data-content-id="${contentId}"]`);
        if (selectedItem) {
            selectedItem.classList.add('active');
            // Scroll into view if needed
            selectedItem.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        
        // Pause intro video if playing
        const introVideo = document.getElementById('intro-video');
        if (introVideo) {
            introVideo.pause();
        }
    }
    
    // Function to show default content
    function showDefaultContent() {
        // Hide all content containers
        document.querySelectorAll('.content-container').forEach(function(elem) {
            elem.style.display = 'none';
        });
        
        // Show default content
        document.getElementById('default-content').style.display = 'block';
        
        // Remove active class from sidebar items
        document.querySelectorAll('.content-item').forEach(function(elem) {
            elem.classList.remove('active');
        });
    }
    
    // Check if there's a content ID in the URL and load it
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const contentId = urlParams.get('content_id');
        
        if (contentId) {
            loadContent(contentId);
        }
    });
</script>
@endpush --}}



<!-- student/courses/show.blade.php -->
@extends('layouts.frontend')

@section('contents')
<div class="container-fluid py-4">
    <div class="row">
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
                                    @else
                                    <i class="bi bi-file-pdf-fill text-primary fs-4"></i>
                                    @endif
                                </div>
                                <div class="content-info flex-grow-1">
                                    <a href="#" class="content-item text-decoration-none text-dark" 
                                       data-content-id="{{ $content->id }}" 
                                       onclick="loadContent({{ $content->id }})">
                                        <div><strong>{{ $index + 1 }}. {{ $content->titre }}</strong></div>
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
                    </div>
                </div>
            </div>
        </div>
        
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
                        <div>
                            <div class="instructor-preview d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#instructorModal">
                                <img src="{{ asset('storage/' . $course->formateur->user->profile->avatar) }}" 
                                    class="rounded-circle me-2" alt="Instructor" style="width:40px; height:40px; object-fit:cover;">
                                <div>
                                    <small class="text-muted d-block">Instructor</small>
                                    <strong>{{ $course->formateur->user->name }}</strong>
                                </div>
                            </div>
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
                            
                            <!-- Course Progress -->
                            <div class="mt-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Your Progress</span>
                                    <span>25%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" 
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
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
                                    
                                    <div>
                                        <button class="btn btn-success btn-sm">
                                            <i class="bi bi-check-circle"></i> Mark as Complete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
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

@endsection

@push('style')
<style>
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
    
    .progress {
        border-radius: 20px;
        background-color: #e9ecef;
    }
    
    .progress-bar {
        border-radius: 20px;
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
</style>
@endpush

@push('script')
<script>
    // Function to load content
    function loadContent(contentId) {
        // Hide all content containers
        document.querySelectorAll('.content-container').forEach(function(elem) {
            elem.style.display = 'none';
        });
        
        // Hide default content
        document.getElementById('default-content').style.display = 'none';
        
        // Show selected content
        document.getElementById('content-' + contentId).style.display = 'block';
        
        // Update active class in sidebar
        document.querySelectorAll('.list-group-item').forEach(function(elem) {
            elem.classList.remove('active-item');
        });
        
        // Find the parent list-group-item of the clicked content
        const selectedItem = document.querySelector(`.content-item[data-content-id="${contentId}"]`)
            .closest('.list-group-item');
        if (selectedItem) {
            selectedItem.classList.add('active-item');
            // Scroll into view if needed
            selectedItem.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        
        // Pause intro video if playing
        const introVideo = document.getElementById('intro-video');
        if (introVideo) {
            introVideo.pause();
        }
    }
    
    // Function to show default content
    function showDefaultContent() {
        // Hide all content containers
        document.querySelectorAll('.content-container').forEach(function(elem) {
            elem.style.display = 'none';
        });
        
        // Show default content
        document.getElementById('default-content').style.display = 'block';
        
        // Remove active class from sidebar items
        document.querySelectorAll('.list-group-item').forEach(function(elem) {
            elem.classList.remove('active-item');
        });
    }
    
    // Check if there's a content ID in the URL and load it
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const contentId = urlParams.get('content_id');
        
        if (contentId) {
            loadContent(contentId);
        }
    });
</script>
@endpush
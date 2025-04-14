@extends('layouts.dashboard')

@section('contents')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Informations principales du cours -->
            <div class="card mb-4 shadow-sm">
                <div class="position-relative">
                    @if($course->video_intro)
                        <video class="card-img-top w-100" controls>
                            <source src="{{ asset('storage/' . $course->video_intro) }}" type="video/mp4">
                            Votre navigateur ne prend pas en charge la balise vidéo.
                        </video>
                    @elseif($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->titre }}" class="card-img-top">
                    @endif
                    <div class="position-absolute top-0 end-0 p-2">
                        <span class="badge bg-{{ $course->status == 'published' ? 'success' : 'warning' }}">
                            {{ $course->status == 'published' ? 'Publié' : 'En attente' }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <h1 class="card-title">{{ $course->titre }}</h1>
                    <p class="text-muted">
                        @if($course->category)
                            <span class="badge bg-info">{{ $course->category->name }}</span>
                        @endif
                        <span class="ms-2">Créé le: {{ $course->created_at->format('d/m/Y') }}</span>
                        <span class="ms-2">Dernière mise à jour: {{ $course->updated_at->format('d/m/Y') }}</span>
                    </p>
                    <h5 class="mt-3">Description</h5>
                    <p class="card-text">{{ $course->description }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <h4 class="text-primary">{{ number_format($course->price, 2, ',', ' ') }} MAD</h4>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- Contenu du cours -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light">
                    <h3 class="card-title mb-0">Contenu du cours</h3>
                    <p class="text-muted mb-0">{{ $course->contents->count() }} sections</p>
                </div>
                <div class="card-body p-0">
                    <div class="accordion" id="courseContents">
                        @foreach($course->contents as $index => $content)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $content->id }}">
                                <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $content->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $content->id }}">
                                    <div class="d-flex justify-content-between w-100 me-3">
                                        <div>
                                            <i class="fas 
                                                @if($content->type == 'video') fa-video 
                                                @elseif($content->type == 'pdf') fa-file-pdf
                                                @else fa-external-link-alt @endif 
                                                me-2"></i>
                                            {{ $content->titre }}
                                        </div>
                                        <div class="text-muted small">
                                            @if($content->duree)
                                                <i class="far fa-clock me-1"></i>{{ $content->duree }} min
                                            @endif
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse{{ $content->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $content->id }}" data-bs-parent="#courseContents">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                        <h5>Description</h5>
                                        <p>{{ $content->description }}</p>
                                    </div>
                                    
                                    @if($content->type == 'video')
                                        <div class="mb-3">
                                            <video class="w-100" controls>
                                                <source src="{{ asset('storage/' . $content->chemin) }}" type="video/mp4">
                                                Votre navigateur ne prend pas en charge la balise vidéo.
                                            </video>
                                        </div>
                                    @elseif($content->type == 'pdf')
                                        <div class="mb-3">
                                            <a href="{{ asset('storage/' . $content->chemin) }}" class="btn btn-outline-primary" target="_blank">
                                                <i class="fas fa-download me-2"></i>Télécharger le PDF
                                            </a>
                                            <p class="mt-2 text-muted">
                                                @if($content->nombre_pages)
                                                    <i class="fas fa-file-alt me-1"></i>{{ $content->nombre_pages }} pages
                                                @endif
                                            </p>
                                        </div>
                                    @elseif($content->type == 'link')
                                        <div class="mb-3">
                                            <a href="{{ $content->chemin }}" class="btn btn-outline-primary" target="_blank">
                                                <i class="fas fa-external-link-alt me-2"></i>Ouvrir la ressource
                                            </a>
                                        </div>
                                    @endif
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="badge bg-{{ $content->status == 'published' ? 'success' : 'warning' }}">
                                            {{ $content->status == 'published' ? 'Publié' : 'En attente' }}
                                        </span>
                                        <small class="text-muted">Ajouté le: {{ \Carbon\Carbon::parse($content->created_at)->format('d/m/Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Informations du formateur -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light">
                    <h3 class="card-title mb-0">Formateur</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        @if($course->formateur->user->profile->avatar ?? false)
                            <img src="{{ asset('storage/' . $course->formateur->user->profile->avatar) }}" alt="{{ $course->formateur->user->name }}" class="rounded-circle me-3" width="60" height="60">
                        @else
                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                {{ substr($course->formateur->user->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h5 class="mb-0">{{ $course->formateur->user->name }}</h5>
                            @if($course->formateur->user->profile->occupation ?? false)
                                <p class="text-muted mb-0">{{ $course->formateur->user->profile->occupation }}</p>
                            @endif
                        </div>
                    </div>
                    
                    @if($course->formateur->user->profile->bio ?? false)
                        <div class="mb-3">
                            <h6>À propos</h6>
                            <p>{{ $course->formateur->user->profile->bio }}</p>
                        </div>
                    @endif
                    
                    <div class="d-flex flex-wrap">
                        @if($course->formateur->user->profile->website ?? false)
                            <a href="{{ $course->formateur->user->profile->website }}" class="btn btn-sm btn-outline-secondary me-2 mb-2" target="_blank">
                                <i class="fas fa-globe me-1"></i>Site web
                            </a>
                        @endif
                        
                        @if($course->formateur->user->profile->facebook_profile ?? false)
                            <a href="{{ $course->formateur->user->profile->facebook_profile }}" class="btn btn-sm btn-outline-primary me-2 mb-2" target="_blank">
                                <i class="fab fa-facebook me-1"></i>Facebook
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Statistiques du cours -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light">
                    <h3 class="card-title mb-0">Statistiques du cours</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Contenu total
                            <span class="badge bg-primary rounded-pill">{{ $course->contents_count }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Vidéos
                            <span class="badge bg-primary rounded-pill">{{ $course->contents->where('type', 'video')->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Documents
                            <span class="badge bg-primary rounded-pill">{{ $course->contents->where('type', 'pdf')->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Liens externes
                            <span class="badge bg-primary rounded-pill">{{ $course->contents->where('type', 'link')->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Durée totale
                            <span class="badge bg-primary rounded-pill">{{ $course->contents->sum('duree') }} min</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 








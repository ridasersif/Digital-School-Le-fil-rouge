
@extends('layouts.frontend')
@section('title', 'Home Page')
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
    </style>

@endpush

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
    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Développez vos compétences avec SersifAcademy</h1>
            <p class="lead mb-5">Découvrez plus de 10 000 cours dispensés par des experts dans leur domaine</p>
            <div class="d-flex justify-content-center">
                <form class="col-md-6">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="Que souhaitez-vous apprendre?">
                        <button class="btn btn-primary px-4" type="submit">Rechercher</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
  
    <!-- Categories Section -->
    <section id="Categories" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Explorez nos catégories populaires</h2>
            <div class="row g-4">
    
                @foreach ($categories as $category)
                    <div class="col-6 col-md-4 col-lg-2">
                        
                        <div class="card text-center h-100">
                            <div class="card-body">
                                
                                <iconify-icon icon="{{ $category->icon }}" class="fas  fa-3x mb-3" style="color: #6d28d2;" ></iconify-icon>
                                <h5 class="card-title">{{ $category->nom }}</h5>
                                <p class="card-text small">{{ $category->cours_count }} cours</p>
                            </div>
                        </div>
                    </div>
                @endforeach
    
            </div>
        </div>
    </section>
    

    

    <!-- Featured Courses -->
<section class="py-5 bg-light" id="cours">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Cours populaires</h2>
            <a href="{{route('home.getAllCourses')}}" class="btn btn-outline-primary">Voir tous les cours</a>
        </div>
        <div class="row g-4">
            @forelse($cours as $course)
               
        
                <div class="col-md-6 col-lg-3">
                    <div class="card course-card">
                        <!-- Catégorie -->
                        <span class="badge bg-primary category-badge">
                            {{ $course->category->nom ?? 'Catégorie inconnue' }}
                        </span>
        
                        <!-- Image du cours -->
                        {{-- <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top course-image" alt="Cours"> --}}
                        <a href="{{ route('courses.show', $course->id) }}">
                            {{-- <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top course-image" alt="Cours"> --}}
                            @if($course->image)
                                <a href="{{ route('courses.show', $course->id) }}">
                                    <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top course-image" alt="Cours">
                                </a>
                            @else
                                <a href="{{ route('courses.show', $course->id) }}">
                                    <div class="d-flex justify-content-center align-items-center" style="height: 160px; background-color: #f0f0f0;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                </a>
                            @endif

                        </a>

                        <div class="card-body">
                            <!-- Bestseller + Étoiles -->
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-light text-dark">Bestseller</span>
                                <div>
                                    <i class="fas fa-star text-warning"></i>
                                    <small>4.8 (245)</small>
                                </div>
                            </div>
        
                            <!-- Titre du cours -->
                            <h5 class="card-title">{{ $course->titre }}</h5>
                         
                                 <!-- Formateur -->
                                <p class="card-text small text-muted">
                                    Par {{ $course->formateur->user->name }}
                                </p>


                                @php
                                    $user = Auth::user();
                                    $etudiant = $user->etudiant ?? null;
                                    $isInscrit = false;
                        
                                    if ($etudiant) {
                                        $isInscrit = \App\Models\Inscription::where('etudiant_id', $etudiant->id)
                                                    ->where('cours_id', $course->id)
                                                ->exists();
                
                                    }
                                @endphp
                            @if ($etudiant)
                                        <!-- Bouton dynamique -->
                                @if($isInscrit)
                                    <form action="{{route('student.myCourses.show',$course->id)}}" method="git">
                                        @csrf
                                        {{-- <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-cart-plus me-1"></i> Ajouter au panier
                                        </button> --}}
                                        <button  class="btn btn-success w-100"> Commencer à apprendre </button>
                                    
                                    </form>
                                
                                @else
                                    <form action="{{ route('student.panier.ajouter', $course->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100"> Ajouter au panier</button>
                                    </form>
                                @endif
                            
                          
                            @endif
                           
                        </div>
                    </div>
                </div>
            @empty
                <p>Aucun cours trouvé.</p>
            @endforelse
        </div>
        
    </div>
     <!-- Modal pour login  -->
     <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Authentification requise</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
            Pour ajouter ce cours au panier, vous devez être connecté.
            </div>
            <div class="modal-footer">
            <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Créer un compte</a>
            </div>
        </div>
        </div>
    </div>
</section>
       
  




    <!-- Instructors Section -->
    <section id="Instructors" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Nos instructeurs d'élite</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center h-100">
                        <img src="/api/placeholder/150/150" class="rounded-circle mx-auto mt-4" width="100" height="100" alt="Instructeur">
                        <div class="card-body">
                            <h5 class="card-title">Jean Dupont</h5>
                            <p class="card-text text-muted">Développeur Web Senior</p>
                            <p class="card-text">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <small class="text-muted">(4.9)</small>
                            </p>
                            <p class="card-text small">12 cours · 45,000+ étudiants</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center h-100">
                        <img src="/api/placeholder/150/150" class="rounded-circle mx-auto mt-4" width="100" height="100" alt="Instructeur">
                        <div class="card-body">
                            <h5 class="card-title">Marie Martin</h5>
                            <p class="card-text text-muted">Experte en IA</p>
                            <p class="card-text">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                                <small class="text-muted">(4.8)</small>
                            </p>
                            <p class="card-text small">8 cours · 32,000+ étudiants</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center h-100">
                        <img src="/api/placeholder/150/150" class="rounded-circle mx-auto mt-4" width="100" height="100" alt="Instructeur">
                        <div class="card-body">
                            <h5 class="card-title">Sophie Bernard</h5>
                            <p class="card-text text-muted">Consultante en stratégie</p>
                            <p class="card-text">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <small class="text-muted">(4.9)</small>
                            </p>
                            <p class="card-text small">10 cours · 38,000+ étudiants</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center h-100">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGJSSN5-gXh3p-I8g9UqSFkOeYSOe3QWqH-R3v5nsDKTBI-5kepOnHXny1LofLOQiFwUU&usqp=CAU" class="rounded-circle mx-auto mt-4" width="100" height="100" alt="Instructeur">
                        <div class="card-body">
                            <h5 class="card-title">Lucas Petit</h5>
                            <p class="card-text text-muted">Designer UX/UI</p>
                            <p class="card-text">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                                <small class="text-muted">(4.7)</small>
                            </p>
                            <p class="card-text small">15 cours · 42,000+ étudiants</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Ce que disent nos étudiants</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="card-text">"Cette plateforme a complètement transformé ma carrière. Les cours sont incroyablement bien structurés et les instructeurs sont des experts dans leur domaine."</p>
                            <div class="d-flex align-items-center mt-3">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGJSSN5-gXh3p-I8g9UqSFkOeYSOe3QWqH-R3v5nsDKTBI-5kepOnHXny1LofLOQiFwUU&usqp=CAU" class="rounded-circle me-3" width="50" height="50" alt="Étudiant">
                                <div>
                                    <h6 class="mb-0">Sarah Durand</h6>
                                    <small class="text-muted">Développeuse Web</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="card-text">"J'ai suivi plusieurs cours sur l'IA et je suis impressionné par la qualité du contenu. J'ai pu appliquer directement ces connaissances dans mon travail quotidien."</p>
                            <div class="d-flex align-items-center mt-3">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGJSSN5-gXh3p-I8g9UqSFkOeYSOe3QWqH-R3v5nsDKTBI-5kepOnHXny1LofLOQiFwUU&usqp=CAU" class="rounded-circle me-3" width="50" height="50" alt="Étudiant">
                                <div>
                                    <h6 class="mb-0">Thomas Leroy</h6>
                                    <small class="text-muted">Data Scientist</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                            </div>
                            <p class="card-text">"Le cours sur le lancement d'entreprise en ligne m'a donné toutes les clés pour démarrer mon activité. Je recommande vivement cette plateforme à tous les entrepreneurs en herbe."</p>
                            <div class="d-flex align-items-center mt-3">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGJSSN5-gXh3p-I8g9UqSFkOeYSOe3QWqH-R3v5nsDKTBI-5kepOnHXny1LofLOQiFwUU&usqp=CAU" class="rounded-circle me-3" width="50" height="50" alt="Étudiant">
                                <div>
                                    <h6 class="mb-0">Claire Moreau</h6>
                                    <small class="text-muted">Entrepreneure</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 text-white text-center" style="background-color: #6d28d2;">

        <div class="container">
            <h2 class="mb-4">Prêt à développer vos compétences?</h2>
            <p class="lead mb-4">Rejoignez plus de 500 000 étudiants qui apprennent déjà sur notre plateforme</p>
            <a href="#" class="btn btn-light btn-lg px-4 me-2">Commencer gratuitement</a>
            <a href="all-courses.html" class="btn btn-outline-light btn-lg px-4">Voir tous les cours</a>
        </div>
    </section>
@endsection

@push('script')
<script>
      // Hide alert after 3 seconds
      setTimeout(() => {
        const alert = document.getElementById('alert-message');
        if (alert) {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300); // remove after fade
        }
    }, 3000);
</script>
@endpush

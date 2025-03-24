<!DOCTYPE html>
<html lang="fr" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPlateforme - Votre plateforme d'apprentissage en ligne</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
       :root {
            --primary-color: #5e35b1;
            --primary-hover: #4527a0;
            --text-color: #333;
            --bg-color: #f8f9fa;
            --card-bg: #fff;
            --card-border: rgba(0,0,0,0.125);
            --nav-bg: #fff;
            --footer-bg: #212529;
        }
        
        [data-bs-theme="dark"] {
            --text-color: #f8f9fa;
            --bg-color: #212529;
            --card-bg: #343a40;
            --card-border: rgba(255,255,255,0.125);
            --nav-bg: #212529;
            --footer-bg: #111;
        } 
   
      

        
        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s, color 0.3s;
        }
        
        .navbar {
            background-color: var(--nav-bg) !important;
        }
        
        .card {
            background-color: var(--card-bg);
            border-color: var(--card-border);
            transition: transform 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        
        .footer {
            background-color: var(--footer-bg);
            color: #fff;
        }
        
        .course-card {
            height: 100%;
        }
        
        .course-image {
            height: 160px;
            object-fit: cover;
        }
        
        .category-badge {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/api/placeholder/1500/500');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }

        [data-bs-theme="dark"] .navbar {
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        [data-bs-theme="dark"] .nav-link, 
        [data-bs-theme="dark"] .navbar-brand {
            color: #fff !important;
        }

        [data-bs-theme="dark"] .dropdown-menu {
            background-color: #343a40;
            border-color: rgba(255,255,255,0.15);
        }

        [data-bs-theme="dark"] .dropdown-item {
            color: #f8f9fa;
        }

        [data-bs-theme="dark"] .dropdown-item:hover {
            background-color: #212529;
        }

        [data-bs-theme="dark"] .bg-light {
            background-color: #343a40 !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.html">
                <i class="fas fa-graduation-cap text-primary me-2"></i>EduPlateforme
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.html">Accueil</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown">
                            Catégories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Développement Web</a></li>
                            <li><a class="dropdown-item" href="#">Intelligence Artificielle</a></li>
                            <li><a class="dropdown-item" href="#">Business</a></li>
                            <li><a class="dropdown-item" href="#">Design</a></li>
                            <li><a class="dropdown-item" href="#">Marketing</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="all-courses.html">Toutes les catégories</a></li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item ">
                        <a class="nav-link " href="#" >Tous les cours</a>
                    </li> --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href=""  role="button" data-bs-toggle="dropdown">
                            Cours
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">cour</a></li>
                            <li><a class="dropdown-item" href="#">cour</a></li>
                            <li><a class="dropdown-item" href="#">cour</a></li>
                            <li><a class="dropdown-item" href="#">cour</a></li>
                            <li><a class="dropdown-item" href="#">Mcour</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="all-courses.html">Toutes les cours</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Mes cours</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                </ul>
                {{-- <form class="d-flex mx-auto col-lg-4">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Rechercher des cours...">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form> --}}
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <button class="btn btn-outline-primary me-2" id="theme-toggle">
                            <i class="fas fa-moon" id="theme-icon"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-primary me-2" href="{{route('login')}}">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{route('register')}}">Inscription</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: "{{ session('error') }}",
                position: 'top-end',
                toast: true,
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                background: 'var(--card-bg)',
                color: 'var(--text-color)'
            });
        });
    </script>
    @endif



    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Développez vos compétences avec EduPlateforme</h1>
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
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Explorez nos catégories populaires</h2>
            <div class="row g-4">
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-laptop-code fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Développement</h5>
                            <p class="card-text small">650+ cours</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-robot fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">IA</h5>
                            <p class="card-text small">320+ cours</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Business</h5>
                            <p class="card-text small">480+ cours</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-pencil-ruler fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Design</h5>
                            <p class="card-text small">360+ cours</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-bullhorn fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Marketing</h5>
                            <p class="card-text small">290+ cours</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-language fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Langues</h5>
                            <p class="card-text small">410+ cours</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Courses -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Cours populaires</h2>
                <a href="all-courses.html" class="btn btn-outline-primary">Voir tous les cours</a>
            </div>
            <div class="row g-4">
                <!-- Course 1 -->
                <div class="col-md-6 col-lg-3">
                    <div class="card course-card">
                        <span class="badge bg-primary category-badge">Développement Web</span>
                        <img src="/https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGJSSN5-gXh3p-I8g9UqSFkOeYSOe3QWqH-R3v5nsDKTBI-5kepOnHXny1LofLOQiFwUU&usqp=CAU" class="card-img-top course-image" alt="Cours">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-light text-dark">Bestseller</span>
                                <div>
                                    <i class="fas fa-star text-warning"></i>
                                    <small>4.8 (245)</small>
                                </div>
                            </div>
                            <h5 class="card-title">Formation complète développeur web 2025</h5>
                            <p class="card-text small text-muted">Par Jean Dupont</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold">39,99 €</span>
                                <span class="text-decoration-line-through text-muted">129,99 €</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="#" class="btn btn-primary w-100">Ajouter au panier</a>
                        </div>
                    </div>
                </div>

                <!-- Course 2 -->
                <div class="col-md-6 col-lg-3">
                    <div class="card course-card">
                        <span class="badge bg-primary category-badge">IA</span>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGJSSN5-gXh3p-I8g9UqSFkOeYSOe3QWqH-R3v5nsDKTBI-5kepOnHXny1LofLOQiFwUU&usqp=CAU" class="card-img-top course-image" alt="Cours">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-danger text-white">Nouveau</span>
                                <div>
                                    <i class="fas fa-star text-warning"></i>
                                    <small>4.9 (128)</small>
                                </div>
                            </div>
                            <h5 class="card-title">Maîtrisez l'intelligence artificielle avec Python</h5>
                            <p class="card-text small text-muted">Par Marie Martin</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold">49,99 €</span>
                                <span class="text-decoration-line-through text-muted">149,99 €</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="#" class="btn btn-primary w-100">Ajouter au panier</a>
                        </div>
                    </div>
                </div>

                <!-- Course 3 -->
                <div class="col-md-6 col-lg-3">
                    <div class="card course-card">
                        <span class="badge bg-primary category-badge">Business</span>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGJSSN5-gXh3p-I8g9UqSFkOeYSOe3QWqH-R3v5nsDKTBI-5kepOnHXny1LofLOQiFwUU&usqp=CAU" class="card-img-top course-image" alt="Cours">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-light text-dark">Populaire</span>
                                <div>
                                    <i class="fas fa-star text-warning"></i>
                                    <small>4.7 (315)</small>
                                </div>
                            </div>
                            <h5 class="card-title">Lancer votre entreprise en ligne: Guide complet</h5>
                            <p class="card-text small text-muted">Par Sophie Bernard</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold">29,99 €</span>
                                <span class="text-decoration-line-through text-muted">99,99 €</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="#" class="btn btn-primary w-100">Ajouter au panier</a>
                        </div>
                    </div>
                </div>

                <!-- Course 4 -->
                <div class="col-md-6 col-lg-3">
                    <div class="card course-card">
                        <span class="badge bg-primary category-badge">Design</span>
                        <img src="/api/placeholder/400/220" class="card-img-top course-image" alt="Cours">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-light text-dark">Tendance</span>
                                <div>
                                    <i class="fas fa-star text-warning"></i>
                                    <small>4.6 (189)</small>
                                </div>
                            </div>
                            <h5 class="card-title">UX/UI Design: De débutant à expert</h5>
                            <p class="card-text small text-muted">Par Lucas Petit</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold">44,99 €</span>
                                <span class="text-decoration-line-through text-muted">119,99 €</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="#" class="btn btn-primary w-100">Ajouter au panier</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Instructors Section -->
    <section class="py-5">
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
    <section class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h2 class="mb-4">Prêt à développer vos compétences?</h2>
            <p class="lead mb-4">Rejoignez plus de 500 000 étudiants qui apprennent déjà sur notre plateforme</p>
            <a href="#" class="btn btn-light btn-lg px-4 me-2">Commencer gratuitement</a>
            <a href="all-courses.html" class="btn btn-outline-light btn-lg px-4">Voir tous les cours</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-white mb-4">
                        <i class="fas fa-graduation-cap me-2"></i>EduPlateforme
                    </h5>
                    <p class="text-white-50">Nous offrons des cours de qualité pour vous aider à maîtriser de nouvelles compétences et à avancer dans votre carrière.</p>
                    <div class="d-flex mt-4">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2 mb-4 mb-lg-0">
                    <h6 class="text-white mb-4">Liens Rapides</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="index.html" class="text-white-50">Accueil</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">À propos</a></li>
                        <li class="mb-2"><a href="all-courses.html" class="text-white-50">Cours</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Instructeurs</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Témoignages</a></li>
                        <li><a href="#" class="text-white-50">Contact</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-lg-2 mb-4 mb-lg-0">
                    <h6 class="text-white mb-4">Catégories</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50">Développement Web</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Intelligence Artificielle</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Business</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Design</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Marketing</a></li>
                        <li><a href="#" class="text-white-50">Langues</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="text-white mb-4">Abonnez-vous à notre newsletter</h6>
                    <form class="d-flex">
                        <input type="email" class="form-control me-2" placeholder="Votre email">
                        <button type="submit" class="btn btn-primary">S'abonner</button>
                    </form>
                </div>
            </div>
        </div>
    </footer>
     <!-- Bootstrap JS Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script pour gérer le mode sombre/clair -->
    <script>
        // Fonction pour basculer entre les modes
        function toggleTheme() {
            const htmlElement = document.documentElement;
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            htmlElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        }

        // Fonction pour mettre à jour l'icône du thème
        function updateThemeIcon(theme) {
            const themeIcon = document.getElementById('theme-icon');
            if (theme === 'dark') {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        }

        // Appliquer le thème sauvegardé au chargement de la page
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
            updateThemeIcon(savedTheme);

            // Ajouter un écouteur d'événement sur le bouton de basculement
            const themeToggle = document.getElementById('theme-toggle');
            themeToggle.addEventListener('click', toggleTheme);
        });
    </script>
</body>
</html>
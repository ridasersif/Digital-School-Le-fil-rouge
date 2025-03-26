
@extends('layouts.frontend')
@section('title', 'Home Page')
@push('style')
{{--  --}}
@endpush
@section('contents')
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
    <section class="py-5 bg-light" id="cours">
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
    <section class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h2 class="mb-4">Prêt à développer vos compétences?</h2>
            <p class="lead mb-4">Rejoignez plus de 500 000 étudiants qui apprennent déjà sur notre plateforme</p>
            <a href="#" class="btn btn-light btn-lg px-4 me-2">Commencer gratuitement</a>
            <a href="all-courses.html" class="btn btn-outline-light btn-lg px-4">Voir tous les cours</a>
        </div>
    </section>
@endsection

@push('script')
{{--  --}}
@endpush


</html>
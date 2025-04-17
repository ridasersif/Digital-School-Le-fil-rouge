<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier de Cours</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .course-img {
            height: 140px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .rating-stars {
            color: #f7c32e;
        }
        .btn-primary {
            background-color: #7952b3;
            border-color: #7952b3;
        }
        .btn-primary:hover {
            background-color: #614092;
            border-color: #614092;
        }
        .btn-outline-primary {
            color: #7952b3;
            border-color: #7952b3;
        }
        .btn-outline-primary:hover {
            background-color: #7952b3;
            color: white;
        }
        .badge-update {
            background-color: #28a745;
            color: white;
        }
        .promo-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            background-color: #dc3545;
            color: white;
            border-radius: 5px;
            font-weight: bold;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: #7952b3;
        }
        .cart-summary {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }
        .instructor-badge {
            display: inline-block;
            margin-right: 5px;
        }
        .instructor-img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">EduPro</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home"></i> Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-book"></i> Cours</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-shopping-cart"></i> Panier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-heart"></i> Favoris</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user"></i> Mon Compte</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4 fw-bold">Mon Panier</h1>
                <div class="alert alert-info d-flex align-items-center" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <div>Profitez de notre offre spéciale : <strong>-15% sur tous les cours</strong> avec le code <strong>SUMMER2025</strong></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i> 3 cours dans le panier</h5>
                            <a href="#" class="text-decoration-none text-danger"><i class="fas fa-trash-alt me-1"></i> Vider le panier</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <!-- Course 1 -->
                        <div class="row g-0 border-bottom p-3">
                            <div class="col-md-2 mb-3 mb-md-0">
                                <img src="/api/placeholder/200/140" alt="Python" class="img-fluid rounded">
                            </div>
                            <div class="col-md-7 ps-md-3">
                                <h5 class="mb-1">Programmation en Python 3: Du Débutant à l'Expert</h5>
                                <p class="mb-1 text-muted small">Par Ivan Lourenço Gomes et 1 autre</p>
                                <div class="mb-1">
                                    <span class="badge bg-secondary me-1">4 heures</span>
                                    <span class="badge bg-secondary me-1">32 sessions</span>
                                    <span class="badge bg-secondary">Tous niveaux</span>
                                </div>
                                <div class="mb-2">
                                    <span class="fw-bold">4,6</span>
                                    <span class="rating-stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </span>
                                    <span class="text-muted">(135 avis)</span>
                                </div>
                                <div class="d-flex">
                                    <a href="#" class="text-decoration-none me-3"><i class="far fa-heart me-1"></i> Sauvegarder</a>
                                    <a href="#" class="text-decoration-none text-danger"><i class="fas fa-trash-alt me-1"></i> Supprimer</a>
                                </div>
                            </div>
                            <div class="col-md-3 text-md-end mt-3 mt-md-0">
                                <h5 class="fw-bold">39,99 $US</h5>
                                <p class="text-muted text-decoration-line-through mb-0">59,99 $US</p>
                            </div>
                        </div>

                        <!-- Course 2 -->
                        <div class="row g-0 border-bottom p-3">
                            <div class="col-md-2 mb-3 mb-md-0">
                                <div class="position-relative">
                                    <img src="/api/placeholder/200/140" alt="Laravel" class="img-fluid rounded">
                                    <span class="badge bg-success position-absolute top-0 end-0 m-1">Mis à jour</span>
                                </div>
                            </div>
                            <div class="col-md-7 ps-md-3">
                                <h5 class="mb-1">Laravel 11 - Build a Complete Learning Management System LMS</h5>
                                <p class="mb-1 text-muted small">Par Web Solution US</p>
                                <div class="mb-1">
                                    <span class="badge bg-secondary me-1">115 heures</span>
                                    <span class="badge bg-secondary me-1">506 sessions</span>
                                    <span class="badge bg-secondary">Tous niveaux</span>
                                </div>
                                <div class="mb-2">
                                    <span class="fw-bold">4,6</span>
                                    <span class="rating-stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </span>
                                    <span class="text-muted">(144 avis)</span>
                                </div>
                                <div class="d-flex">
                                    <a href="#" class="text-decoration-none me-3"><i class="far fa-heart me-1"></i> Sauvegarder</a>
                                    <a href="#" class="text-decoration-none text-danger"><i class="fas fa-trash-alt me-1"></i> Supprimer</a>
                                </div>
                            </div>
                            <div class="col-md-3 text-md-end mt-3 mt-md-0">
                                <h5 class="fw-bold">59,99 $US</h5>
                                <p class="text-muted text-decoration-line-through mb-0">89,99 $US</p>
                            </div>
                        </div>

                        <!-- Course 3 -->
                        <div class="row g-0 p-3">
                            <div class="col-md-2 mb-3 mb-md-0">
                                <img src="/api/placeholder/200/140" alt="Data Analysis" class="img-fluid rounded">
                            </div>
                            <div class="col-md-7 ps-md-3">
                                <h5 class="mb-1">Analyse de Données avec Python: Numpy, Pandas et Matplotlib</h5>
                                <p class="mb-1 text-muted small">Par Lucie G.</p>
                                <div class="mb-1">
                                    <span class="badge bg-secondary me-1">3 heures</span>
                                    <span class="badge bg-secondary me-1">130 sessions</span>
                                    <span class="badge bg-secondary">Débutant</span>
                                </div>
                                <div class="mb-2">
                                    <span class="fw-bold">4,3</span>
                                    <span class="rating-stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </span>
                                    <span class="text-muted">(347 avis)</span>
                                </div>
                                <div class="d-flex">
                                    <a href="#" class="text-decoration-none me-3"><i class="far fa-heart me-1"></i> Sauvegarder</a>
                                    <a href="#" class="text-decoration-none text-danger"><i class="fas fa-trash-alt me-1"></i> Supprimer</a>
                                </div>
                            </div>
                            <div class="col-md-3 text-md-end mt-3 mt-md-0">
                                <h5 class="fw-bold">24,99 $US</h5>
                                <p class="text-muted text-decoration-line-through mb-0">44,99 $US</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Suggested courses -->
                <h4 class="mb-3">Cours recommandés pour vous</h4>
                <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
                    <div class="col">
                        <div class="card h-100">
                            <img src="/api/placeholder/400/200" class="card-img-top course-img" alt="JavaScript">
                            <div class="card-body">
                                <span class="badge bg-primary mb-2">Bestseller</span>
                                <h5 class="card-title">JavaScript Moderne: Les Bases à l'Expert</h5>
                                <p class="card-text text-muted small">Par Thomas Martin</p>
                                <div>
                                    <span class="fw-bold">4,8</span>
                                    <span class="rating-stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </span>
                                    <span class="text-muted">(1,254 avis)</span>
                                </div>
                            </div>
                            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                                <span class="fw-bold">29,99 $US</span>
                                <button class="btn btn-sm btn-primary"><i class="fas fa-cart-plus me-1"></i> Ajouter</button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="/api/placeholder/400/200" class="card-img-top course-img" alt="React">
                            <div class="card-body">
                                <span class="badge bg-danger mb-2">Populaire</span>
                                <h5 class="card-title">React & Redux: Créer des Applications Web Modernes</h5>
                                <p class="card-text text-muted small">Par Sarah Johnson</p>
                                <div>
                                    <span class="fw-bold">4,7</span>
                                    <span class="rating-stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </span>
                                    <span class="text-muted">(892 avis)</span>
                                </div>
                            </div>
                            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                                <span class="fw-bold">34,99 $US</span>
                                <button class="btn btn-sm btn-primary"><i class="fas fa-cart-plus me-1"></i> Ajouter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="col-lg-4">
                <div class="cart-summary sticky-lg-top" style="top: 20px;">
                    <h4 class="mb-4">Résumé de la commande</h4>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Prix original:</span>
                        <span class="text-muted text-decoration-line-through">194,97 $US</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Prix réduit:</span>
                        <span>124,97 $US</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <span>Vous économisez:</span>
                        <span class="text-success">70,00 $US (36%)</span>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold">Total:</span>
                        <span class="fw-bold fs-4">124,97 $US</span>
                    </div>
                    
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Code promo">
                            <button class="btn btn-outline-primary" type="button">Appliquer</button>
                        </div>
                        <div class="form-text text-danger">Le code de coupon saisi n'est pas valide pour ce cours.</div>
                    </div>
                    
                    <button class="btn btn-primary w-100 py-2 mb-3">
                        <i class="fas fa-lock me-2"></i> Payer maintenant
                    </button>
                    
                    <p class="text-center text-muted small mb-0">Vous ne serez pas encore débité</p>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-center gap-3">
                        <img src="/api/placeholder/40/30" alt="Visa" class="img-fluid">
                        <img src="/api/placeholder/40/30" alt="Mastercard" class="img-fluid">
                        <img src="/api/placeholder/40/30" alt="PayPal" class="img-fluid">
                        <img src="/api/placeholder/40/30" alt="Apple Pay" class="img-fluid">
                    </div>
                    
                    <hr>
                    
                    <div class="text-center">
                        <p class="mb-2"><strong>Garantie de satisfaction de 30 jours</strong></p>
                        <p class="text-muted small">Si vous n'êtes pas satisfait, nous vous remboursons intégralement dans les 30 jours suivant l'achat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>EduPro</h5>
                    <p class="text-muted">La plateforme de cours en ligne pour développer vos compétences professionnelles.</p>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h6>Liens utiles</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-muted">Accueil</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Cours</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Enseignants</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h6>Support</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-muted">FAQ</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Contact</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Aide</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6>Inscrivez-vous à notre newsletter</h6>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Votre email">
                        <button class="btn btn-primary" type="button">S'inscrire</button>
                    </div>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-decoration-none text-muted"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-decoration-none text-muted"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-decoration-none text-muted"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-decoration-none text-muted"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="small text-muted mb-0">© 2025 EduPro. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-decoration-none text-muted small me-3">Conditions d'utilisation</a>
                    <a href="#" class="text-decoration-none text-muted small">Politique de confidentialité</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
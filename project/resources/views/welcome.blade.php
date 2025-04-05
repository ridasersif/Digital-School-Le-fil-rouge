<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Udemy-like</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (icônes) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>
        /* Styles personnalisés */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
}

header {
    position: sticky;
    top: 0;
    z-index: 1000;
}

.card {
    border: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
}

.progress {
    height: 1.5rem;
    border-radius: 10px;
}

.progress-bar {
    border-radius: 10px;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-primary {
    background-color: #5624d0;
    border-color: #5624d0;
}

.btn-primary:hover {
    background-color: #4a1fb8;
    border-color: #4a1fb8;
}

.text-primary {
    color: #5624d0 !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-body {
        padding: 1rem;
    }
}
    </style>
    <!-- En-tête -->
    <header class="bg-white shadow-sm py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h1 class="fs-4 fw-bold text-primary mb-0">LearnHub</h1>
                <form class="ms-4 d-none d-md-block">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Rechercher des cours...">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <nav>
                <ul class="list-unstyled d-flex gap-4 mb-0">
                    <li><a href="#" class="text-dark"><i class="fas fa-home"></i></a></li>
                    <li><a href="#" class="text-dark"><i class="fas fa-book-open"></i></a></li>
                    <li><a href="#" class="text-dark"><i class="fas fa-envelope"></i></a></li>
                    <li><a href="#" class="text-dark"><i class="fas fa-bell"></i></a></li>
                    <li><a href="#" class="text-dark"><img src="https://via.placeholder.com/30" class="rounded-circle" alt="Profil"></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="container my-4">
        <div class="row">
            <!-- Colonne principale (Cours en progression) -->
            <div class="col-lg-9">
                <h2 class="h4 fw-bold mb-4">Mes cours en progression</h2>
                
                <!-- Carte de cours -->
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="https://via.placeholder.com/300x170" class="img-fluid rounded-start" alt="Cours">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Marketing Digital 2024</h5>
                                <p class="card-text text-muted">Maîtrisez les stratégies modernes de marketing en ligne.</p>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-success" style="width: 75%">75%</div>
                                </div>
                                <a href="#" class="btn btn-primary">Continuer</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recommandations -->
                <h2 class="h4 fw-bold mt-5 mb-3">Recommandations pour vous</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/300x170" class="card-img-top" alt="Cours">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Python pour débutants</h5>
                                <p class="card-text text-muted">Apprenez les bases de Python en 30 jours.</p>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="#" class="btn btn-sm btn-outline-primary">Voir le cours</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/300x170" class="card-img-top" alt="Cours">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">UI/UX Design</h5>
                                <p class="card-text text-muted">Créez des interfaces utilisateur intuitives.</p>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="#" class="btn btn-sm btn-outline-primary">Voir le cours</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/300x170" class="card-img-top" alt="Cours">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Data Science</h5>
                                <p class="card-text text-muted">Introduction à l'analyse de données.</p>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="#" class="btn btn-sm btn-outline-primary">Voir le cours</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar (Progression & Certificats) -->
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Objectifs d'apprentissage</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Progression hebdo :</span>
                            <span class="fw-bold">3h / 5h</span>
                        </div>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-info" style="width: 60%"></div>
                        </div>
                        <p class="text-success"><i class="fas fa-trophy me-2"></i>Étudiant assidu</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Certificats</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-certificate text-warning me-2"></i>Marketing Digital</li>
                            <li class="mb-2"><i class="fas fa-certificate text-warning me-2"></i>Python</li>
                        </ul>
                        <a href="#" class="btn btn-sm btn-outline-secondary">Voir tout</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Pied de page -->
    <footer class="bg-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">© 2024 LearnHub. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-muted me-3">Conditions</a>
                    <a href="#" class="text-muted me-3">Confidentialité</a>
                    <a href="#" class="text-muted">Devenez formateur</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

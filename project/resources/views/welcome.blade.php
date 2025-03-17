<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | E-Learning</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
            
            /* Light mode colors */
            --body-bg: #f8f9fc;
            --sidebar-bg: #4e73df;
            --sidebar-color: white;
            --card-bg: white;
            --text-color: #444;
            --border-color: rgba(0,0,0,.125);
        }
        
        [data-bs-theme="dark"] {
            --body-bg: #121212;
            --sidebar-bg: #1f223b;
            --sidebar-color: #dcdcdc;
            --card-bg: #242424;
            --text-color: #dfdfdf;
            --border-color: rgba(255,255,255,.1);
        }
        
        /* Arabic typographic styles */
        [lang="ar"] {
            font-family: 'Amiri', serif;
            direction: rtl;
            text-align: right;
        }
        
        [lang="ar"] .sidebar {
            right: 0;
        }
        
        [lang="ar"] .main-content {
            margin-right: 225px;
            margin-left: 0;
        }
        
        [lang="ar"] .sidebar .nav-item .nav-link {
            text-align: right;
            padding-right: 1rem;
        }
        
        [lang="ar"] .sidebar .nav-item .nav-link i {
            margin-left: 0.75rem;
            margin-right: 0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--body-bg);
            color: var(--text-color);
            transition: background-color 0.3s, color 0.3s;
        }
        
        .sidebar {
            width: 225px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-color);
            padding-top: 1rem;
            z-index: 999;
            transition: background-color 0.3s, color 0.3s;
        }
        
        .sidebar .sidebar-brand {
            padding: 1.5rem 1rem;
            font-size: 1.25rem;
            font-weight: 700;
            text-transform: uppercase;
            text-align: center;
            letter-spacing: 0.05rem;
        }
        
        .sidebar .nav-item {
            position: relative;
        }
        
        .sidebar .nav-item .nav-link {
            color: var(--sidebar-color);
            padding: 0.75rem 1rem;
            font-weight: 500;
            border-radius: 0;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-item .nav-link i {
            margin-right: 0.75rem;
            font-size: 1rem;
        }
        
        .sidebar .nav-item .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .nav-item.active .nav-link {
            font-weight: 700;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .main-content {
            margin-left: 225px;
            padding: 1.5rem;
            min-height: 100vh;
            transition: margin 0.3s;
        }
        
        .card {
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
            margin-bottom: 1.5rem;
            background-color: var(--card-bg);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }
        
        .card-header {
            border-bottom: 1px solid var(--border-color);
            background-color: var(--card-bg);
            padding: 1rem 1.25rem;
            font-weight: 600;
        }
        
        .topbar {
            height: 4.5rem;
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }
        
        .rounded-info-card {
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .rounded-info-card:hover {
            transform: translateY(-5px);
        }
        
        .statistics-card {
            border-left: 0.25rem solid;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }
        
        .statistics-card.primary {
            border-left-color: var(--primary-color);
        }
        
        .statistics-card.success {
            border-left-color: var(--success-color);
        }
        
        .statistics-card.info {
            border-left-color: var(--info-color);
        }
        
        .statistics-card.warning {
            border-left-color: var(--warning-color);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--body-bg);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--secondary-color);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }
        
        /* Progress bars */
        .progress {
            height: 10px;
            border-radius: 10px;
        }
        
        .chart-container {
            position: relative;
            height: 300px;
        }
        
        /* Animation */
        .fade-in {
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 6.5rem;
            }
            
            .sidebar .sidebar-brand {
                font-size: 1rem;
            }
            
            .sidebar .nav-item .nav-link span {
                display: none;
            }
            
            .sidebar .nav-item .nav-link {
                text-align: center;
                padding: 0.75rem 1rem;
                width: 6.5rem;
            }
            
            .sidebar .nav-item .nav-link i {
                margin-right: 0;
                font-size: 1.25rem;
            }
            
            .main-content {
                margin-left: 6.5rem;
            }
            
            [lang="ar"] .main-content {
                margin-right: 6.5rem;
                margin-left: 0;
            }
        }

                /* Style de l'image de profil dans la navbar */
        .img-profile {
            width: 40px; /* Ajustez selon vos besoins */
            height: 40px;
            border-radius: 50%; /* Rend l'image circulaire */
            object-fit: cover; /* Assure que l'image s'ajuste bien */
            border: 2px solid var(--primary-color); /* Ajoute une bordure élégante */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Effet de survol */
        .img-profile:hover {
            transform: scale(1.1); /* Effet d'agrandissement */
            box-shadow: 0 0 10px rgba(78, 115, 223, 0.5); /* Ajoute une ombre lumineuse */
        }

        /* Ajout d'un contour plus visible en mode sombre */
        [data-bs-theme="dark"] .img-profile {
            border-color: var(--light-color);
        }

    </style>

    
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand d-flex align-items-center justify-content-center">
            <i class="fas fa-graduation-cap me-2"></i>
            <span>EduLearn</span>
        </div>
        <hr class="sidebar-divider my-0">
        <ul class="nav flex-column">
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Cours</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Étudiants</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                    <span>Formateurs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Statistiques</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>Paiements</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Commentaires</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Paramètres</span>
                </a>
            </li>
        </ul>
        
        <!-- Sidebar Footer -->
        <div class="text-center position-absolute bottom-0 w-100 p-3">
            <div class="d-flex justify-content-center mb-2">
                <button class="btn btn-sm btn-outline-light me-2" id="theme-toggle">
                    <i class="fas fa-moon"></i>
                </button>
                <button class="btn btn-sm btn-outline-light" id="language-toggle">
                    <i class="fas fa-language"></i>
                </button>
            </div>
            <small>©2025 EduLearn Admin</small>
        </div>
    </div>
     <!-- endSidebar -->
    

    <!-- Main Content -->
    <div class="main-content">
        <!-- navBare -->
        <nav class="navbar navbar-expand topbar mb-4 static-top">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none">
                <i class="fa fa-bars"></i>
            </button>
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Rechercher..." aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3+
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">Centre de notifications</h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="me-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">15 mars 2025</div>
                                <span>Un nouveau rapport mensuel est prêt à être téléchargé !</span>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="me-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">14 mars 2025</div>
                                5000 MAD ont été déposés dans votre compte !
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Afficher toutes les notifications</a>
                    </div>
                </li>
                
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            7
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">Centre de messages</h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image me-3">
                                <img class="rounded-circle" src="/api/placeholder/48/48" alt="Profile">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Le cours "JavaScript avancé" est maintenant le plus populaire cette semaine !</div>
                                <div class="small text-gray-500">Ahmed Benani · 58m</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image me-3">
                                <img class="rounded-circle" src="/api/placeholder/48/48" alt="Profile">
                                <div class="status-indicator"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Je voudrais savoir si nous pouvons ajouter un nouveau cours sur React Native?</div>
                                <div class="small text-gray-500">Laila Moussaoui · 1j</div>
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Lire plus de messages</a>
                    </div>
                </li>
                
                <div class="topbar-divider d-none d-sm-block"></div>
                
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-2 d-none d-lg-inline text-gray-600 small">Mohamed Alami</span>
                        <img class="img-profile rounded-circle" src="{{ asset('assets/images/profil.png') }}" alt="Profile">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                            Profil
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>
                            Paramètres
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>
                            Journal d'activité
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                            Déconnexion
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
         <!-- endnavBare -->
        
        <!-- Begin Page Content -->
        <div class="container-fluid fade-in">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0">Tableau de bord</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Générer rapport
                </a>
            </div>
            
            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card statistics-card primary h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Revenus (Mensuel)
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold">42,500 MAD</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card statistics-card success h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Revenus (Annuel)
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold">357,000 MAD</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card statistics-card info h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tâches</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold">75%</div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 75%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card statistics-card warning h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Demandes en attente
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold">18</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content Row -->
            <div class="row">
                <!-- Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Aperçu des revenus</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Options:</div>
                                    <a class="dropdown-item" href="#">Par jour</a>
                                    <a class="dropdown-item" href="#">Par semaine</a>
                                    <a class="dropdown-item" href="#">Par mois</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Catégories de cours</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Voir détails</a>
                                    <a class="dropdown-item" href="#">Exporter données</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container pt-4 pb-2">
                                <canvas id="categoryChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="me-2">
                                    <i class="fas fa-circle text-primary"></i> Développement
                                </span>
                                <span class="me-2">
                                    <i class="fas fa-circle text-success"></i> Business
                                </span>
                                <span class="me-2">
                                    <i class="fas fa-circle text-info"></i> Langues
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Top Courses & Students Row -->
            <div class="row">
                <!-- Most Popular Courses -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Cours les plus populaires</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Titre</th>
                                            <th>Formateur</th>
                                            <th>Étudiants</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Développement Web Full-Stack</td>
                                            <td>Rachid Tazi</td>
                                            <td>1,248</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">4.8</div>
                                                    <div>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star-half-alt text-warning"></i>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Intelligence Artificielle</td>
                                            <td>Samir Bennani</td>
                                            <td>943</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">4.7</div>
                                                    <div>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star-half-alt text-warning"></i>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Marketing Digital</td>
                                            <td>Khadija Alaoui</td>
                                            <td>875</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">4.9</div>
                                                    <div>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Anglais des affaires</td>
                                            <td>Nadia Lahrichi</td>
                                            <td>732</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">4.6</div>
                                                    <div>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star-half-alt text-warning"></i>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- New Students -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Nouveaux étudiants</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Date d'inscription</th>
                                                <th>Cours</th>
                                                <th>Progression</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Youssef El Mansouri</td>
                                                <td>10 mars 2025</td>
                                                <td>Développement Web Full-Stack</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Fatima Zahra Benjelloun</td>
                                                <td>9 mars 2025</td>
                                                <td>Marketing Digital</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 45%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Karim El Amrani</td>
                                                <td>8 mars 2025</td>
                                                <td>Intelligence Artificielle</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 30%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Leila Bouzidi</td>
                                                <td>7 mars 2025</td>
                                                <td>Anglais des affaires</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->
            </div>
        
            <!-- Logout Modal -->
            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logoutModalLabel">Prêt à partir ?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Sélectionnez "Déconnexion" ci-dessous si vous êtes prêt à mettre fin à votre session actuelle.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <a href="#" class="btn btn-primary">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Bootstrap JS and dependencies -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        
            <!-- Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
            <!-- Custom Scripts -->
            <script>
                // Theme toggle
                const themeToggle = document.getElementById('theme-toggle');
                themeToggle.addEventListener('click', () => {
                    document.body.setAttribute('data-bs-theme', 
                        document.body.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark');
                });
        
                // Language toggle
                const languageToggle = document.getElementById('language-toggle');
                languageToggle.addEventListener('click', () => {
                    document.documentElement.setAttribute('lang', 
                        document.documentElement.getAttribute('lang') === 'fr' ? 'ar' : 'fr');
                });
        
                // Revenue Chart
                const revenueChart = new Chart(document.getElementById('revenueChart'), {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                        datasets: [{
                            label: 'Revenus (MAD)',
                            data: [25000, 30000, 35000, 40000, 42000, 45000, 47000, 50000, 52000, 55000, 57000, 60000],
                            borderColor: 'rgba(78, 115, 223, 1)',
                            backgroundColor: 'rgba(78, 115, 223, 0.2)',
                            borderWidth: 2,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
        
                // Category Chart
                const categoryChart = new Chart(document.getElementById('categoryChart'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Développement', 'Business', 'Langues'],
                        datasets: [{
                            data: [55, 30, 15],
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            </script>
</body>
</html>


     
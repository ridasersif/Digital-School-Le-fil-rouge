 <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container">

        <!-- Logo avec animation au hover -->
        <a class="navbar-brand fw-bold text-dark d-flex align-items-center" href="index.html" style="transition: all 0.3s;">
            <i class="fas fa-graduation-cap me-2" style="font-size: 1.5rem; color: #6d28d2;"></i>
            <span class="brand-text">Sersif</span><span class="brand-text-alt" style="color: #495057;">Academy</span>
        </a>

        <div>
           
        </div>

        <!-- Bouton mobile modifié avec icône X -->
        <button class="navbar-toggler border-0" onclick="toggleMenu()" type="button">
            <i id="menu-icon" class="fas fa-bars" style="font-size: 1.5rem;"></i>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu principal -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item mx-1">
                    <a class="nav-link text-dark position-relative {{ request()->path() == '/' ? 'active' : '' }}" href="/">
                        Accueil
                        <span class="span-actev position-absolute bottom-0 start-50 translate-middle-x"  style="background-color: #6d28d2;"></span>

                    </a>
                </li>
                
                <li class="nav-item dropdown mx-1">
                    <a class="nav-link text-dark position-relative dropdown-toggle" href="categries" id="categoriesDropdown" role="button" data-bs-toggle="dropdown">
                        Catégories
                        <span class="span-actev position-absolute bottom-0 start-50 translate-middle-x"  style="background-color: #6d28d2;"></span>


                    </a>
                    <ul class="dropdown-menu shadow-lg border-0">
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-code me-2 text-primary"></i> Développement Web</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-robot me-2 text-info"></i> Intelligence Artificielle</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-chart-line me-2 text-success"></i> Business</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-paint-brush me-2 text-warning"></i> Design</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-bullhorn me-2 text-danger"></i> Marketing</a></li>
                        <li><hr class="dropdown-divider mx-3"></li>
                        <li><a class="dropdown-item py-2 text-primary fw-bold" href="all-courses.html"><i class="fas fa-ellipsis-h me-2"></i> Toutes les catégories</a></li>
                    </ul>
                </li>

                <li class="nav-item mx-1">
                    <a class="nav-link text-dark position-relative {{ request()->path() == '/#cours' ? 'active' : '' }}" href="#cours">
                        Cours
                        <span class="span-actev position-absolute bottom-0 start-50 translate-middle-x"  style="background-color: #6d28d2;"></span>


                    </a>                                            
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link position-relative text-dark " href="#">
                        Blog
                        <span class="span-actev position-absolute bottom-0 start-50 translate-middle-x"  style="background-color: #6d28d2;"></span>


                    </a>
                </li>

                @auth
                    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                        <li class="nav-item mx-1">
                            <a class="nav-link position-relative text-dark " href="{{route('admin.index')}}">
                                <i class="fas fa-tachometer-alt me-1"  style="color: #6d28d2;"></i>
                                 Dashboard
                                 <span class="span-actev position-absolute bottom-0 start-50 translate-middle-x"  style="background-color: #6d28d2;"></span>
                            </a>
                        </li>
                    @endif

                    @if(auth()->user()->role_id == 3)
                        <li class="nav-item mx-1">
                            <a class="nav-link text-dark position-relative " href="/mes-cours">
                                <i class="fas fa-book-open me-1"  style="color: #6d28d2;" ></i> Mes cours
                                <span class="span-actev position-absolute bottom-0 start-50 translate-middle-x"  style="background-color: #6d28d2;" ></span>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
            <!-- Menu droit -->
            <ul class="navbar-nav ms-auto align-items-center d-flex flex-row gap-3">
                <!-- Dark Mode -->
                <li class="nav-item me-3">
                    <button class="btn btn-sm rounded-pill px-3 theme-toggle" id="theme-toggle" style="border: 1px solid #6d28d2;">

                        <i class="fas fa-moon me-1" id="theme-icon"> </i>Mode
                    </button>
                </li>
            
                @guest
                    <li class="nav-item me-2">
                        <a class="btn rounded-pill px-3" href="{{route('login')}}" <button class="btn btn-sm rounded-pill px-3 theme-toggle" style="border: 1px solid #6d28d2; color: #6d28d2;">
                            <i class="fas fa-sign-in-alt me-1"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary rounded-pill px-3 fw-bold" href="{{route('register')}}">
                            <i class="fas fa-user-plus me-1"></i> Inscription
                        </a>
                    </li>
                @else
                 <!-- Notifications -->
                 <li class="nav-item dropdown me-3">
                    <a class="nav-link text-dark position-relative" href="#" id="alertsDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-bell fa-lg"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color: #6d28d2;">
                            3+
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-message-notifiction dropdown-menu-end p-0 shadow-lg border-0">
                        <div class="p-3 text-white" style="background-color: #6d28d2;">
                            <h6 class="mb-0"><i class="fas fa-bell me-2"></i> Notifications</h6>
                        </div>
                        <div style="max-height: 400px; overflow-y: auto;">
                            <a class="dropdown-item p-3 border-bottom" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary rounded-circle p-2 text-white">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="small text-muted">15 mars 2025</div>
                                        <p class="mb-0">Nouveau rapport disponible</p>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item p-3" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-success rounded-circle p-2 text-white">
                                            <i class="fas fa-donate"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="small text-muted">14 mars 2025</div>
                                        <p class="mb-0">5000 MAD déposés</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="text-center p-2 border-top">
                            <a href="#" class="text-primary small">Voir toutes</a>
                        </div>
                    </div>
                </li>
                <!-- Messages -->
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark position-relative" href="#" id="messagesDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-envelope fa-lg"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color: #6d28d2;">
                            7
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-message-notifiction dropdown-menu-end p-0 shadow-lg border-0">
                        <div class="p-3 text-white" style="background-color: #6d28d2;">
                            <h6 class="mb-0"><i class="fas fa-envelope me-2"></i> Messages</h6>
                        </div>
                        <div style="max-height: 400px; overflow-y: auto;">
                            <a class="dropdown-item p-3 border-bottom" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="/api/placeholder/40/40" class="rounded-circle" alt="Profile">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-0">Ahmed Benani</h6>
                                            <small class="text-muted">58m</small>
                                        </div>
                                        <p class="small mb-0 text-truncate">JavaScript avancé populaire</p>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item p-3" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="/api/placeholder/40/40" class="rounded-circle" alt="Profile">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-0">Laila Moussaoui</h6>
                                            <small class="text-muted">1j</small>
                                        </div>
                                        <p class="small mb-0 text-truncate">Nouveau cours React Native?</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="text-center p-2 border-top">
                            <a href="#" class="text-primary small">Voir tous</a>
                        </div>
                    </div>
                </li>
               <!-- Panier -->
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark position-relative" href="#" id="panierDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color: #6d28d2;">
                            1
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-message-notifiction dropdown-menu-end p-0 shadow-lg border-0">
                        <div class="p-3 text-white" style="background-color: #6d28d2;">
                            <h6 class="mb-0"><i class="fas fa-shopping-cart me-2"></i> Panier</h6>
                        </div>
                        <div style="max-height: 400px; overflow-y: auto;">
                            <a class="dropdown-item p-3 border-bottom" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="/api/placeholder/40/40" class="rounded-circle" alt="Profile">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-0">Ahmed Benani</h6>
                                            <small class="text-muted">58m</small>
                                        </div>
                                        <p class="small mb-0 text-truncate">Produit ajouté au panier</p>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item p-3" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="/api/placeholder/40/40" class="rounded-circle" alt="Profile">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-0">Laila Moussaoui</h6>
                                            <small class="text-muted">1j</small>
                                        </div>
                                        <p class="small mb-0 text-truncate">Produit ajouté récemment</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="text-center p-2 border-top">
                            <a href="#" class="text-primary small">Voir tous</a>
                        </div>
                    </div>
                </li>
                <!-- Profil Utilisateur -->
                <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-2 border border-2 border-primary" src="{{ asset('assets/images/profil.png') }}" alt="Profile" style="width: 36px; height: 36px; object-fit: cover;">
                        <span class="d-none d-lg-inline">Mohamed Alami</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-message-notifiction dropdown-menu-end shadow-lg border-0">
                        <div class="p-4 text-center text-white" style="background-color: #6d28d2;">
                            <img class="rounded-circle mb-2 border border-3 border-white" src="{{ asset('assets/images/profil.png') }}" alt="Profile" style="width: 80px; height: 80px; object-fit: cover;">
                            <h6 class="mb-0">Mohamed Alami</h6>
                            <small class="text-white-50">Étudiant Premium</small>
                        </div>
                        <div class="p-2">
                            <a class="dropdown-item px-3 py-2 rounded" href="{{route('meProfile')}}">
                                <i class="fas fa-user me-2 " style="color: #6d28d2;"></i> Profil
                            </a>
                            <a class="dropdown-item px-3 py-2 rounded" href="{{route('securiteProfile')}}">
                                <i class="fas fa-cogs me-2" style="color: #6d28d2;"></i> Paramètres
                            </a>
                            <a class="dropdown-item px-3 py-2 rounded" href="#">
                                <i class="fas fa-list me-2" style="color: #6d28d2;"></i> Journal
                            </a>
                            <div class="dropdown-divider my-1"></div>
                           
                                <button type="button" class="dropdown-item px-3 py-2 rounded text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                                </button>
                            
                        </div>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

    <!-- Modal -->


<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirmation de déconnexion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir vous déconnecter ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form method="post" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Oui, se déconnecter</button>
                </form>
            </div>
        </div>
    </div> 
</div>

<script>
    function toggleMenu() {
        let navbar = document.getElementById("navbarNav");
        let icon = document.getElementById("menu-icon");

        if (navbar.classList.contains("show")) {
            navbar.classList.remove("show");
            icon.classList.remove("fa-times");
            icon.classList.add("fa-bars");
        } else {
            navbar.classList.add("show");
            icon.classList.remove("fa-bars");
            icon.classList.add("fa-times");
        }
    }
</script>





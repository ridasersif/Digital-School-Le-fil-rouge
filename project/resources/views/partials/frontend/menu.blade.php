<ul class="navbar-nav ms-auto align-items-center d-flex flex-row gap-3">
    <!-- Dark Mode -->
    <li class="nav-item me-3">
        <button class="btn btn-sm btn-outline-primary rounded-pill px-3" id="theme-toggle">
            <i class="fas fa-moon me-1" id="theme-icon"></i> Mode
        </button>
    </li>

    @guest
        <li class="nav-item me-2">
            <a class="btn btn-outline-primary rounded-pill px-3" href="{{route('login')}}">
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
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                3+
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-message-notifiction dropdown-menu-end p-0 shadow-lg border-0">
            <div class="p-3 bg-primary text-white">
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
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                7
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-message-notifiction dropdown-menu-end p-0 shadow-lg border-0">
            <div class="p-3 bg-primary text-white">
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
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                1
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-message-notifiction dropdown-menu-end p-0 shadow-lg border-0">
            <div class="p-3 bg-primary text-white">
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
            <div class="p-4 text-center bg-primary text-white">
                <img class="rounded-circle mb-2 border border-3 border-white" src="{{ asset('assets/images/profil.png') }}" alt="Profile" style="width: 80px; height: 80px; object-fit: cover;">
                <h6 class="mb-0">Mohamed Alami</h6>
                <small class="text-white-50">Étudiant Premium</small>
            </div>
            <div class="p-2">
                <a class="dropdown-item px-3 py-2 rounded" href="{{route('meProfile')}}">
                    <i class="fas fa-user me-2 text-primary"></i> Profil
                </a>
                <a class="dropdown-item px-3 py-2 rounded" href="{{route('securiteProfile')}}">
                    <i class="fas fa-cogs me-2 text-primary"></i> Paramètres
                </a>
                <a class="dropdown-item px-3 py-2 rounded" href="#">
                    <i class="fas fa-list me-2 text-primary"></i> Journal
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
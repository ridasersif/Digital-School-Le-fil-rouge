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
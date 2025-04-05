
 <div class="sidebar">
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <i class="fas fa-graduation-cap me-2"></i>
        <span>{{ Auth::user()->role->name }}</span>
    </div>
    <hr class="sidebar-divider my-0">

    @if (Auth::user()->role_id === 1)
    <ul class="nav flex-column">
        <li class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Tableau de bord</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('categories.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('categories.index') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Catégories</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#categorySubmenu" aria-expanded="false">
                <i class="fas fa-fw fa-layer-group"></i>
                <span>Cours</span>
            </a>
            <div id="categorySubmenu" class="collapse">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-plus-circle"></i> Ajouter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-list"></i> Voir les catégories
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Dropdown Utilisateurs -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#usersSubmenu" aria-expanded="false">
                <i class="fas fa-fw fa-users"></i>
                <span>Utilisateurs</span>
            </a>
            <div id="usersSubmenu" class="collapse">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="fas fa-user-graduate"></i> Étudiants
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="fas fa-chalkboard-teacher"></i> Formateurs
                        </a>
                    </li>
                </ul>
            </div>
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
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-home"></i>
                <span>Retour à l'accueil</span>
            </a>
        </li>
    </ul>
    @endif
   
    
</div>


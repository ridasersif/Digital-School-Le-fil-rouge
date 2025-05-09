

 <div class="sidebar" id="sidebar">
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <i class="fas fa-graduation-cap me-2"></i>
        <span class="sidebar-brand-text">{{ Auth::user()->role->name }}</span> 
            <button id="sidebarToggleTop" class="btn rounded-circle mr-3  d-md-none">
                <i class="fas fa-times close-icon">
                    <style>
                      
                      
                    </style>
                </i>
            </button>
    </div>
    <hr class="sidebar-divider my-0">

  

    @if (Auth::user()->role_id === 1)
        <ul class="nav flex-column">
            <li class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.statistiqueForadmin') }}">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span class="nav-text">Statistiques</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('categories.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span class="nav-text">Catégories</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#coursesSubmenu" aria-expanded="false">
                    <i class="fas fa-fw fa-book"></i>
                    <span class="nav-text">Cours</span>
                    <i class="fas fa-angle-down submenu-indicator ms-auto"></i>
                </a>
                <div id="coursesSubmenu" class="collapse submenu">
                    <ul class="nav flex-column submenu-items">
            
                        <li class="nav-item {{ Route::is('course.byStatus') && request()->status == 'all' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('course.byStatus', ['status' => 'all']) }}">
                                <i class="fas fa-list fa-sm"></i>
                                <span class="nav-text">Tous les cours</span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('course.byStatus') && request()->status == 'pending' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('course.byStatus', ['status' => 'pending']) }}">
                                <i class="fas fa-hourglass-half fa-sm"></i>
                                <span class="nav-text">En attente</span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('course.byStatus') && request()->status == 'published' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('course.byStatus', ['status' => 'published']) }}">
                                <i class="fas fa-check-circle fa-sm"></i>
                                <span class="nav-text">Publiés</span>
                            </a>
                        </li>
                        
            
                    </ul>
                </div>
            </li>
            

            <!-- Dropdown Utilisateurs -->
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#usersSubmenu" aria-expanded="false">
                    <i class="fas fa-fw fa-users"></i>
                    <span class="nav-text">Utilisateurs</span>
                    <i class="fas fa-angle-down submenu-indicator ms-auto"></i>
                </a>
                <div id="usersSubmenu" class="collapse submenu">
                    <ul class="nav flex-column submenu-items">
                        <li class="nav-item {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                <i class="fas fa-users fa-sm"></i>
                                <span class="nav-text">Tous les utilisateurs</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('admin.students.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.students.index') }}">
                                <i class="fas fa-user-graduate fa-sm"></i>
                                <span class="nav-text">Étudiants</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('admin.instructors.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.instructors.index') }}">
                                <i class="fas fa-chalkboard-teacher fa-sm"></i>
                                <span class="nav-text">Formateurs</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('admin.users.inactive') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.users.inactive') }}">
                                <i class="fas fa-user-slash fa-sm "></i>
                                <span class="nav-text">Utilisateurs inactifs</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.payments') }}">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span class="nav-text">Paiements</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.avis') }}">
                    <i class="fas fa-fw fa-comments"></i>
                    <span class="nav-text">Avis</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-cog"></i>
                    <span class="nav-text">Paramètres</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span class="nav-text">Retour à l'accueil</span>
                </a>
            </li>
        </ul>
    @endif
    @if (Auth::user()->role_id === 2)
        <ul class="nav flex-column">
            <li class="nav-item {{ request()->routeIs('instructor.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('instructor.statistiqueForInstructor') }}">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span class="nav-text">Statistiques</span>
                </a>
            </li>
           

            <!-- Dropdown Cours -->
           
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#coursesSubmenu" aria-expanded="false">
                    <i class="fas fa-fw fa-book"></i>
                    <span class="nav-text">Cours</span>
                    <i class="fas fa-angle-down submenu-indicator ms-auto"></i>
                </a>
                <div id="coursesSubmenu" class="collapse submenu">
                    <ul class="nav flex-column submenu-items">
            
                        <li class="nav-item {{ request()->is('course.all') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('course.byStatus', ['status' => 'all']) }}">
                                <i class="fas fa-list fa-sm"></i>
                                <span class="nav-text">Tous les cours</span>
                            </a>
                        </li>
            
                        <li class="nav-item {{ request()->is('course.draft') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('course.byStatus', ['status' => 'draft']) }}">
                                <i class="fas fa-pencil-alt fa-sm"></i>
                                <span class="nav-text">Brouillons</span>
                            </a>
                        </li>
            
                        <li class="nav-item {{ request()->is('course.pending') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('course.byStatus', ['status' => 'pending']) }}">
                                <i class="fas fa-hourglass-half fa-sm"></i>
                                <span class="nav-text">En attente</span>
                            </a>
                        </li>
            
                        <li class="nav-item {{ request()->is('icourse.published') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('course.byStatus', ['status' => 'published']) }}">
                                <i class="fas fa-check-circle fa-sm"></i>
                                <span class="nav-text">Publiés</span>
                            </a>
                        </li>
            
                    </ul>
                </div>
            </li>
            

            <!-- Dropdown Utilisateurs -->
            <li class="nav-item ">
                <a class="nav-link " href="{{route('instructor.etudiantsInscrits')}}" >
                    <i class="fas fa-fw fa-users"></i>
                    <span class="nav-text">Utilisateurs</span>
                   
                </a>
               
            </li>

           
            <li class="nav-item">
                <a class="nav-link" href="{{ route('instructor.payments') }}">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span class="nav-text">Paiements</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('instructor.mesAvis') }}">
                    <i class="fas fa-fw fa-comments"></i>
                    <span class="nav-text">Avis</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span class="nav-text">Retour à l'accueil</span>
                </a>
            </li>
        </ul>
    @endif

    <div class="sidebar-footer">
        <button id="theme-toggle" class="btn theme-toggle">
            <i class="fas fa-moon dark-icon"></i>
            <i class="fas fa-sun light-icon"></i>
            <span class="ms-2 d-none d-lg-inline theme-text">Changer de thème</span>
        </button>
    </div>
</div>

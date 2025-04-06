
  <div class="modal fade" id="userModal-{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0">
        <!-- En-tête avec photo de profil -->
        <div class="modal-header position-relative p-0" style="height: 120px;">
          <div class="w-100 h-100 bg-primary"></div>
          <div class="position-absolute top-100 start-50 translate-middle">
            @if($user->profile && $user->profile->avatar)
              <img src="{{ asset('storage/' . $user->profile->avatar) }}" class="rounded-circle border border-4 border-white" width="100" height="100" style="object-fit: cover;">
            @else
              <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center border border-4 border-white" style="width: 100px; height: 100px;">
                <i class="fas fa-user fa-2x"></i>
              </div>
            @endif
          </div>
          <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        
        <!-- Corps du modal -->
        <div class="modal-body pt-5 px-4 pb-4">
          <!-- Nom et rôle -->
          <div class="text-center mb-4">
            <h4 class="mb-1">{{ $user->name }}</h4>
            <span class="badge bg-primary rounded-pill">{{ ucfirst($user->role->name ?? 'Utilisateur') }}</span>
          </div>
          
          <!-- Section informations -->
          <div class="row g-3">
            <!-- Colonne gauche -->
            <div class="col-md-6">
              <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                  <h6 class="card-title text-muted mb-3">
                    <i class="fas fa-info-circle me-2"></i>Informations
                  </h6>
                  <ul class="list-unstyled small">
                    <li class="mb-2"><i class="fas fa-envelope me-2 text-muted"></i> {{ $user->email }}</li>
                    <li class="mb-2"><i class="fas fa-phone me-2 text-muted"></i> {{ $user->profile->phone ?? '---' }}</li>
                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-muted"></i> {{ $user->profile->address ?? '---' }}</li>
                    <li><i class="fas fa-calendar-alt me-2 text-muted"></i> Inscrit le {{ $user->created_at ? $user->created_at->format('d/m/Y') : '---' }}</li>
                  </ul>
                </div>
              </div>
            </div>
            
            <!-- Colonne droite -->
            <div class="col-md-6">
              <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                  <h6 class="card-title text-muted mb-3">
                    <i class="fas fa-plus-circle me-2"></i>Détails
                  </h6>
                  <ul class="list-unstyled small">
                    <li class="mb-2"><i class="fas fa-birthday-cake me-2 text-muted"></i> {{ $user->profile && $user->profile->birthdate ? \Carbon\Carbon::parse($user->profile->birthdate)->format('d/m/Y') : '---' }}</li>
                    <li class="mb-2"><i class="fas fa-briefcase me-2 text-muted"></i> {{ $user->profile->occupation ?? '---' }}</li>
                    <li><i class="fas fa-globe me-2 text-muted"></i> 
                      @if($user->profile && $user->profile->website)
                        <a href="{{ $user->profile->website }}" target="_blank">Site web</a>
                      @else
                        ---
                      @endif
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Biographie -->
          @if($user->profile && $user->profile->bio)
            <div class="card border-0 shadow-sm mb-3">
              <div class="card-body">
                <h6 class="card-title text-muted mb-3">
                  <i class="fas fa-quote-left me-2"></i>Bio
                </h6>
                <p class="mb-0">{{ $user->profile->bio }}</p>
              </div>
            </div>
          @endif
          
          <!-- Réseaux sociaux -->
          @if($user->profile && $user->profile->facebook_profile)
            <div class="d-flex justify-content-center mt-3">
              <a href="{{ $user->profile->facebook_profile }}" class="btn btn-sm btn-outline-primary rounded-circle me-2" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </div>
          @endif
        </div>
        
        <!-- Pied de modal -->
        <div class="modal-footer border-0 pt-0">
          <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
{{-- <div class="modal fade" id="userModal-{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel-{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-gradient-primary ">
          <h5 class="modal-title" id="userModalLabel-{{ $user->id }}">
            <i class="fas fa-user-circle me-2"></i>Profil de {{ $user->name }}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body p-0">
          <!-- En-tête du profil -->
          <div class=" p-4 text-center">
            @if($user->profile && $user->profile->avatar)
              <img src="{{ asset('storage/' . $user->profile->avatar) }}" class="rounded-circle border shadow" width="120" height="120" style="object-fit: cover;">
            @else
              <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px;">
                <i class="fas fa-user fa-3x"></i>
              </div>
            @endif
            <h4 class="mt-3 mb-1">{{ $user->name }}</h4>
            <p class="text-muted mb-2">{{ ucfirst($user->role->name ?? 'Utilisateur') }}</p>
          </div>
          
          <!-- Informations détaillées -->
          <div class="p-4">
            <div class="row g-4">
              <!-- Colonne gauche -->
              <div class="col-md-6">
                <div class="card shadow-sm h-100">
                  <div class="card-header bg-white">
                    <h6 class="mb-0"><i class="fas fa-id-card me-2 text-primary"></i>Informations principales</h6>
                  </div>
                  <div class="card-body">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">ID:</span>
                        <span class="fw-medium">{{ $user->id }}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Email:</span>
                        <span class="fw-medium">{{ $user->email }}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Téléphone:</span>
                        <span class="fw-medium">{{ $user->profile->phone ?? '---' }}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Date d'inscription:</span>
                        <span class="fw-medium">{{ $user->created_at ? $user->created_at->format('d/m/Y') : '---' }}</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              
              <!-- Colonne droite -->
              <div class="col-md-6">
                <div class="card shadow-sm h-100">
                  <div class="card-header bg-white">
                    <h6 class="mb-0"><i class="fas fa-address-book me-2"></i>Informations supplémentaires</h6>
                  </div>
                  <div class="card-body">
                    <ul class="list-group list-group-flush">
                      <!-- Adresse -->
                      <li class="list-group-item d-flex justify-content-between align-items-start px-0">
                        <span class="text-muted">Adresse:</span>
                        <span class="fw-medium text-end">{{ $user->profile->address ?? '---' }}</span>
                      </li>
                      <!-- Date de naissance -->
                      <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Date de naissance:</span>
                        <span class="fw-medium">{{ $user->profile && $user->profile->birthdate ? \Carbon\Carbon::parse($user->profile->birthdate)->format('d/m/Y') : '---' }}</span>
                      </li>
                      <!-- Profession -->
                      <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Profession:</span>
                        <span class="fw-medium">{{ $user->profile->occupation ?? '---' }}</span>
                      </li>
                      <!-- Site web -->
                      <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Site web:</span>
                        <span class="fw-medium">
                          @if($user->profile && $user->profile->website)
                            <a href="{{ $user->profile->website }}" target="_blank">{{ $user->profile->website }}</a>
                          @else
                            ---
                          @endif
                        </span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              
              <!-- Bio et Réseaux sociaux -->
              <div class="col-12">
                <div class="card shadow-sm">
                  <div class="card-header bg-white">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Bio & Réseaux sociaux</h6>
                  </div>
                  <div class="card-body">
                    <div class="mb-4">
                      <h6 class="text-muted mb-2">Biographie:</h6>
                      <p class="mb-0">{{ $user->profile->bio ?? 'Aucune biographie disponible.' }}</p>
                    </div>
                    <div>
                      <h6 class="text-muted mb-2">Réseaux sociaux:</h6>
                      <div class="d-flex gap-2">
                        @if($user->profile && $user->profile->facebook_profile)
                          <a href="{{ $user->profile->facebook_profile }}" class="btn btn-sm btn-outline-primary" target="_blank">
                            <i class="fab fa-facebook-f me-1"></i>Facebook
                          </a>
                        @else
                          <span class="text-muted">Aucun profil Facebook lié</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times me-1"></i>Fermer
          </button>
  
        </div>
      </div>
    </div>
  </div> --}}


  <div class="modal fade" id="userModal-{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel-{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header py-3">
          <h5 class="modal-title" id="userModalLabel-{{ $user->id }}">
            Profil de {{ $user->name }}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        
        <div class="modal-body p-0">
          <!-- En-tête du profil -->
          <div class="text-center p-4 ">
            @if($user->profile && $user->profile->avatar)
              <img src="{{ asset('storage/' . $user->profile->avatar) }}" class="rounded-circle" width="80" height="80" style="object-fit: cover;">
            @else
              <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px;">
                <i class="fas fa-user fa-2x"></i>
              </div>
            @endif
            <h4 class="mt-3 mb-1">{{ $user->name }}</h4>
            <p class="text-muted small">{{ ucfirst($user->role->name ?? 'Utilisateur') }}</p>
          </div>
          
          <!-- Informations utilisateur -->
          <div class="p-4">
            <!-- Informations principales -->
            <h6 class="mb-3 text-secondary">Informations principales</h6>
            <div class="mb-4">
              <div class="row mb-2">
                <div class="col-4 text-muted">Email:</div>
                <div class="col-8">{{ $user->email }}</div>
              </div>
              <div class="row mb-2">
                <div class="col-4 text-muted">Téléphone:</div>
                <div class="col-8">{{ $user->profile->phone ?? '---' }}</div>
              </div>
              <div class="row mb-2">
                <div class="col-4 text-muted">Adresse:</div>
                <div class="col-8">{{ $user->profile->address ?? '---' }}</div>
              </div>
              <div class="row mb-2">
                <div class="col-4 text-muted">Inscription:</div>
                <div class="col-8">{{ $user->created_at ? $user->created_at->format('d/m/Y') : '---' }}</div>
              </div>
            </div>
            
            <!-- Informations supplémentaires -->
            <h6 class="mb-3 text-secondary">Informations supplémentaires</h6>
            <div class="mb-4">
              <div class="row mb-2">
                <div class="col-4 text-muted">Naissance:</div>
                <div class="col-8">{{ $user->profile && $user->profile->birthdate ? \Carbon\Carbon::parse($user->profile->birthdate)->format('d/m/Y') : '---' }}</div>
              </div>
              <div class="row mb-2">
                <div class="col-4 text-muted">Profession:</div>
                <div class="col-8">{{ $user->profile->occupation ?? '---' }}</div>
              </div>
              <div class="row mb-2">
                <div class="col-4 text-muted">Site web:</div>
                <div class="col-8">
                  @if($user->profile && $user->profile->website)
                    <a href="{{ $user->profile->website }}" target="_blank" class="text-decoration-none">{{ $user->profile->website }}</a>
                  @else
                    ---
                  @endif
                </div>
              </div>
            </div>
            
            <!-- Biographie -->
            @if($user->profile && $user->profile->bio)
              <h6 class="mb-3 text-secondary">Biographie</h6>
              <p class="mb-4">{{ $user->profile->bio }}</p>
            @endif
            
            <!-- Réseaux sociaux -->
            @if($user->profile && $user->profile->facebook_profile)
              <h6 class="mb-3 text-secondary">Réseaux sociaux</h6>
              <div class="mb-3">
                <a href="{{ $user->profile->facebook_profile }}" class="btn btn-sm btn-outline-primary" target="_blank">
                  <i class="fab fa-facebook-f me-1"></i>Facebook
                </a>
              </div>
            @endif
          </div>
        </div>
        
        <div class="modal-footer py-2">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
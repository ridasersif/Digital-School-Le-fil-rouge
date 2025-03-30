
@extends('profile.profile')
@section('title', 'Paramètres de Sécurité')

@section('profile-content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="content-area">
    <div class="mb-4">
        <h2 class="section-title">Compte</h2>
        <p class="text-muted">Modifiez vos paramètres de compte et votre mot de passe.</p>
    </div>
    
    <hr class="my-4 bg-light">
    <!-- Section Email -->
    <div class="mb-4">
        <label class="form-label fw-medium text-dark mb-2">E-mail :</label>
        <div class="d-flex align-items-center gap-3">
            <div class="form-control py-2">{{auth()->user()->email}}</div>
            <button class="btn btn-outline-secondary px-3" data-bs-toggle="modal" data-bs-target="#emaileModal">
                <i class="bi bi-pencil"></i>
            </button>
        </div>
    </div>

    @if ($errors->has('email') || $errors->has('password'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('emaileModal'));
            myModal.show();
        });
    </script>
    @endif
    

    <!-- Modal Modifier Email -->
    <div class="modal fade" id="emaileModal" tabindex="-1" aria-labelledby="emaileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="emaileModalLabel">Changer votre adresse e-mail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.email') }}" method="POST">
                        @csrf
                        <!-- Input Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Nouvel E-mail:</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" >
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        
                        <!-- Input Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe:</label>
                            <input type="password" name="password" id="password" class="form-control" >
                            
                            @error('password') <small class="text-danger d-block">{{ $message }}</small> @enderror
                        </div>
                      

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                                <i class="bi bi-save me-2"></i> Enregistrer
                            </button>
                            
                        </div>
                    </form>
                    
                </div>
               
            </div>
        </div>
    </div>

    <hr class="my-4 bg-light">
    
    <!-- Section Mot de passe -->
    <div class="mb-4">
        <label class="form-label fw-medium text-dark mb-2">Mot de passe :</label>
        <form action="{{ route('update.password') }}" method="POST">
            @csrf
            
            <!-- Mot de passe actuel -->
            <div class="mb-3 position-relative">
                <input type="password" name="current_password" class="form-control form-input-custom py-2" 
                       placeholder="Saisissez votre mot de passe actuel" style="box-shadow: none;">
                <i class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3 toggle-password" style="cursor: pointer;"></i>
                @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <!-- Nouveau mot de passe -->
            <div class="mb-3 position-relative">
                <input type="password" name="new_password" class="form-control form-input-custom py-2" 
                       placeholder="Saisissez votre nouveau mot de passe" style="box-shadow: none;">
                <i class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3 toggle-password" style="cursor: pointer;"></i>
                @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <!-- Confirmation du mot de passe -->
            <div class="mb-4 position-relative">
                <input type="password" name="new_password_confirmation" class="form-control form-input-custom py-2" 
                       placeholder="Retapez votre nouveau mot de passe" style="box-shadow: none;">
                <i class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3 toggle-password" style="cursor: pointer;"></i>
                @error('new_password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <button type="submit" class="btn btn-dark px-4 py-2">
                <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                
                <i class="bi bi-shield-lock me-2"></i>Modifier le mot de passe
            </button>
        </form>
    </div>
    
    
</div>

@push('script')

@endpush
@endsection

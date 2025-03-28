



@extends('profile.profile')
@section('title', 'Paramètres de Sécurité')

@section('profile-content')
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
            <input type="text" class="form-control form-input-custom  py-2" 
                   value="ridasersif1@gmail.com" readonly
                   style="box-shadow: none;">
            <button class="btn btn-outline-secondary px-3">
                <i class="bi bi-pencil"></i>
            </button>
        </div>
    </div>
    
    <hr class="my-4 bg-light">
    
    <!-- Section Mot de passe -->
    <div class="mb-4">
        <label class="form-label fw-medium text-dark mb-2">Mot de passe :</label>
        
        <div class="mb-3">
            <input type="password" class="form-control form-input-custom py-2" 
                   placeholder="Saisissez votre mot de passe actuel"
                   style="box-shadow: none;">
        </div>
        
        <div class="mb-3">
            <input type="password" class="form-control form-input-custom py-2" 
                   placeholder="Saisissez votre nouveau mot de passe"
                   style="box-shadow: none;">
        </div>
        
        <div class="mb-4">
            <input type="password" class="form-control form-input-custom py-2" 
                   placeholder="Retapez votre nouveau mot de passe"
                   style="box-shadow: none;">
        </div>
        
        <button class="btn btn-dark px-4 py-2">
            <i class="bi bi-shield-lock me-2"></i>Modifier le mot de passe
        </button>
    </div>
</div>

@push('script')
<script>
    // Script pour gérer l'édition de l'email
    document.querySelector('.btn-outline-secondary').addEventListener('click', function() {
        const emailField = document.querySelector('input[type="text"]');
        emailField.readOnly = !emailField.readOnly;
        if (!emailField.readOnly) {
            emailField.focus();
            emailField.classList.remove('bg-light');
            emailField.classList.add('bg-white');
        } else {
            emailField.classList.add('bg-light');
            emailField.classList.remove('bg-white');
        }
    });
</script>
@endpush
@endsection
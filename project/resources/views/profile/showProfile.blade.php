@extends('profile.profile')
@section('title', 'Profil Public')

@push('style')

@endpush

@section('profile-content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="section-title">Profil Public</h2>
        <p class="text-muted">Ajoutez des informations vous concernant</p>
    </div>

    <hr class="my-4">

    <form>
        <!-- Section Informations de base -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Nom et Prénom</label>
                <input type="text" class="form-control form-input-custom py-2" value="Rida Sersif">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Téléphone</label>
                <input type="tel" class="form-control form-input-custom py-2">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Date de naissance</label>
                <input type="date" class="form-control form-input-custom py-2">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Occupation</label>
                <input type="text" class="form-control form-input-custom py-2">
            </div>
        </div>

        <hr class="my-4">

        <!-- Section Adresse -->
        <div class="mb-4">
            <label class="form-label fw-medium">Adresse</label>
            <textarea class="form-control form-input-custom py-2" rows="3"></textarea>
        </div>

        <hr class="my-4">

        <!-- Section Réseaux -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Site internet</label>
                <input type="url" class="form-control form-input-custom py-2" placeholder="https://example.com">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Profil Facebook</label>
                <div class="input-group">
                    <span class="input-group-text input-group-text-custom">facebook.com/</span>
                    <input type="text" class="form-control form-input-custom py-2" placeholder="votre.pseudo">
                </div>
            </div>
        </div>

        <!-- Bouton de soumission -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary px-4 py-2">
                <i class="bi bi-save me-2"></i>Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
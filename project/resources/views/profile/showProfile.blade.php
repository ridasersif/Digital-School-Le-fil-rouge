@extends('profile.profile')
@section('title', 'Profil Public')

@push('style')
@endpush

@section('profile-content')
<div class="content-area">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="mb-4">
        <h2 class="section-title">Profil Public</h2>
        <p class="text-muted">Ajoutez des informations vous concernant</p>
    </div>

    <hr class="my-4">

    <form action="{{ route('update.Profile') }}" method="post">
        @csrf
        <!-- Section Informations de base -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Nom et Prénom</label>
                <input type="text" name="name" class="form-control form-input-custom py-2" value="{{ old('name', auth()->user()->name) }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Téléphone</label>
                <input type="tel" name="phone" class="form-control form-input-custom py-2" value="{{ old('phone', auth()->user()->profile ? auth()->user()->profile->phone : '') }}">
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Date de naissance</label>
                <input type="date" name="birthdate" class="form-control form-input-custom py-2" value="{{ old('birthdate', auth()->user()->profile ? auth()->user()->profile->birthdate : '') }}">
                @error('birthdate')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Occupation</label>
                <input type="text" name="occupation" class="form-control form-input-custom py-2" value="{{ old('occupation', auth()->user()->profile ? auth()->user()->profile->occupation : '') }}">
                @error('occupation')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr class="my-4">

        <!-- Section Adresse -->
        <div class="mb-4">
            <label class="form-label fw-medium">Adresse</label>
            <textarea name="address" class="form-control form-input-custom py-2" rows="3">{{ old('address', auth()->user()->profile ? auth()->user()->profile->address : '') }}</textarea>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <hr class="my-4">

        <!-- Section Réseaux -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Site internet</label>
                <input type="url" name="website" class="form-control form-input-custom py-2" placeholder="https://example.com" value="{{ old('website', auth()->user()->profile ? auth()->user()->profile->website : '') }}">
                @error('website')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-medium">Profil Facebook</label>
                <div class="input-group">
                    <span class="input-group-text input-group-text-custom">facebook.com/</span>
                    <input type="text" name="facebook" class="form-control form-input-custom py-2" placeholder="votre.pseudo" value="{{ old('facebook', auth()->user()->profile ? auth()->user()->profile->facebook : '') }}">
                </div>
                @error('facebook')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Bouton de soumission -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary px-4 py-2">
                <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                <i class="bi bi-save me-2"></i> Enregistrer
            </button>
        </div>
    </form>
</div>
@push('script')

@endpush
@endsection

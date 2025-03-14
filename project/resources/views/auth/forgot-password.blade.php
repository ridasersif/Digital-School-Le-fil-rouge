@extends('layouts.auth')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="card auth-card">
    <div class="card-body">
        <div class="text-center mb-4">
            <div class="auth-logo">
                <i class="fas fa-graduation-cap me-2"></i>{{ config('app.name', 'E-Learning') }}
            </div>
            <h4>Mot de passe oublié</h4>
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Entrez votre email" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-primary auth-btn">
                    Envoyer le lien de réinitialisation
                </button>
            </div>

            <div class="text-center">
                <p>Retour à la <a href="{{ route('login') }}">connexion</a></p>
            </div>
        </form>
    </div>
</div>

<!-- Modal for success -->
@if (session('status'))
   <!-- Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 10px; background-color: #f8f9fa;">
            <div class="modal-header" style="border-bottom: 2px solid #007bff; background-color: #007bff; color: white; border-radius: 10px 10px 0 0;">
                <h5 class="modal-title" id="resetPasswordModalLabel">Réinitialisation du mot de passe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;"></button>
            </div>
            <div class="modal-body">
                <p style="font-size: 1.1rem; color: #495057;">Nous avons envoyé un lien de réinitialisation à l'adresse email suivante :</p>
                <h5 class="fw-bold" style="font-size: 1.2rem; color: #007bff;">{{ session('email') }}</h5>
                <p style="font-size: 1rem; color: #495057;">Veuillez vérifier votre boîte de réception et suivre les instructions pour réinitialiser votre mot de passe.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #007bff; color: white;">Fermer</button>
            </div>
        </div>
    </div>
</div>

@endif
@push('scripts')
<!-- Ajouter le script Bootstrap et jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/JS/Auth/forgot-password.js') }}"></script>

@endpush
@endsection

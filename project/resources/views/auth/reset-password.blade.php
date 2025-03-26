@extends('layouts.auth')

@section('title', 'Réinitialiser le mot de passe')

@section('contents')
<div class="card auth-card">
    <div class="card-body">
        <div class="text-center mb-4">
            <div class="auth-logo">
                <i class="fas fa-graduation-cap me-2"></i>{{ config('app.name', 'E-Learning') }}
            </div>
            <h4>Réinitialiser votre mot de passe</h4>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $email) }}" autofocus placeholder="Entrez votre email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Nouveau mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password" placeholder="Entrez votre nouveau mot de passe">
                    <span class="input-group-text" onclick="togglePassword('password')">
                        <i class="fas fa-eye" id="eye-icon-password"></i>
                    </span>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password" placeholder="Confirmez votre mot de passe">
                    <span class="input-group-text" onclick="togglePassword('password_confirmation')">
                        <i class="fas fa-eye" id="eye-icon-password_confirmation"></i>
                    </span>
                </div>
            </div>

            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-primary auth-btn">
                    Réinitialiser le mot de passe
                </button>
            </div>

            <div class="text-center">
                <p>Retour à la <a href="{{ route('login') }}">connexion</a></p>
            </div>
        </form>
    </div>
</div>

@push('script')
<script src="{{ asset('assets/JS/Auth/reset-password.js') }}"></script>
@endpush
@endsection

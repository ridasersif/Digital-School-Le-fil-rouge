@extends('layouts.auth')

@section('title', 'Inscription')

@section('contents')
<div class="card auth-card">
    <div class="card-body">
        <div class="text-center mb-4">
            <div class="auth-logo">
                <i class="fas fa-graduation-cap me-2"></i>{{ config('app.name', 'E-Learning') }}
            </div>
            <h4>Créer un compte</h4>
        </div>
        
        {{-- @include('partials.messages') --}}
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Nom complet</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="Entrez votre nom complet">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="Entrez votre email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"  autocomplete="new-password" placeholder="Créez un mot de passe">
                    <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                        <i class="fas fa-eye"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-text">Le mot de passe doit contenir au moins 8 caractères.</div>
            </div>
            
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  autocomplete="new-password" placeholder="Confirmez votre mot de passe">
                    <button class="btn btn-outline-secondary" type="button" id="toggle-confirm-password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="role" class="form-label">Je souhaite m'inscrire en tant que</label>
                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" >
                    <option value="" disabled selected>Sélectionnez votre rôle</option>
                    @foreach ($roles as $role)
                        @if ($role->id!=1 && $role->id!=4)
                            <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }} 
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }}>
                <label class="form-check-label" for="terms">J'accepte les <a href="{{ route('terms') }}" target="_blank">conditions d'utilisation</a> et la <a href="{{ route('privacy') }}" target="_blank">politique de confidentialité</a>.</label>
                @error('terms')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-primary auth-btn">
                    S'inscrire
                </button>
            </div>
            
            <div class="divider">
                <span>Ou</span>
            </div>
            
            <div class="social-login">
                <a href="{{ route('login.google') }}" class="social-btn google-btn">
                    {{-- <i class="fab fa-google"></i> --}}
                    Google
                </a>
                {{-- <a href="" class="social-btn facebook-btn">
                    <i class="fab fa-facebook-f"></i>
                </a> --}}
            </div>
        </form>
        
        <div class="text-center mt-3">
            <p>Vous avez déjà un compte? <a href="{{ route('login') }}">Connexion</a></p>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('assets/JS/Auth/register.js') }}"></script>
@endpush
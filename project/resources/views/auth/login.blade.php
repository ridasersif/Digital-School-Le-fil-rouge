@extends('layouts.auth')

@section('title', 'Connexion')
@section('contents')
<div class="card auth-card">
    <div class="card-body">
        <div class="text-center mb-4">
            <div class="auth-logo">
                <i class="fas fa-graduation-cap me-2"></i>{{ config('app.name', 'E-Learning') }}
            </div>
            <h4>Connexion à votre compte</h4>
        </div>
        
        {{-- @include('partials.messages') --}}
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="Entrez votre email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"  autocomplete="current-password" placeholder="Entrez votre mot de passe">
                    <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                        <i class="fas fa-eye"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Se souvenir de moi</label>
            </div>
            
            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-primary auth-btn">
                    Connexion
                </button>
            </div>
            
            @if (Route::has('password.request'))
                <div class="text-center mb-3">
                    <a href="{{route('password.request')}}">
                        Mot de passe oublié?
                    </a>
                </div>
            @endif
            
            <div class="divider">
                <span>Ou</span>
            </div>
            
            <div class="social-login">
                <a href="{{ route('login.google') }}" class="social-btn google-btn">
                    {{-- <i class="fab fa-google"></i> --}}
                    Google
                </a>
               
            </div>
        </form>
        
        <div class="text-center mt-3">
            <p>Vous n'avez pas de compte? <a href="{{ route('register') }}">Inscription</a></p>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('assets/JS/Auth/login.js') }}"></script>
@endpush
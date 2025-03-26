@extends('layouts.app')
    @push('styles')

        <link rel="stylesheet" href="{{ asset('assets/CSS/auth/auth.css') }}">
        @stack('style')

    @endpush

    @section('content')
    
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 col-sm-10">
                    @yield('contents')
                    
                    <div class="auth-footer">
                        <p>&copy; {{ date('Y') }} {{ config('app.name', 'E-Learning') }}. Tous droits réservés.</p>
                    </div>
                </div>
            </div>
        </div>

    @endsection
   
    @push('scripts')

     @stack('script') 

    @endpush

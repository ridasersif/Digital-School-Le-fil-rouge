{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Authentification') | {{ config('app.name', 'E-Learning') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
   <link rel="stylesheet" href="{{ asset('assets/CSS/auth/auth.css') }}">
    @stack('styles')
</head> --}}


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
<body>

   

    <!-- Bootstrap JS Bundle with Popper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    
   
    @push('scripts')

     @stack('script') 

    @endpush
{{-- </body>
</html> --}}
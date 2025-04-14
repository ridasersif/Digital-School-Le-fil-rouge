
@extends('layouts.app')
@section('title', 'Home Page')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/CSS/frontend/front.css') }}">
@stack('style')
@endpush
@section('content')

    <!-- Navbar -->
    @include('partials.frontend.navbar')
    @if(session('error'))
        @if(session('isRole'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: "{{ session('error') }}",
                        position: 'top-end',
                        toast: true,
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        background: 'var(--card-bg)',
                        color: 'var(--text-color)'
                    });
                });
            </script>
        @endif
        @if(session('inctive'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Compte désactivé',
                    text: "{{ session('error') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Contacter le support',
                    cancelButtonText: 'Fermer',
                    reverseButtons: true,
                    background: 'var(--card-bg)',
                    color: 'var(--text-color)'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // redirige vers une page de contact (change lien selon المشروع ديالك)
                        window.location.href = "";
                    }
                });
            });
        </script>
        @endif
       
    @endif
   
    @yield('contents')

    <!-- Footer -->
    @include('partials.frontend.footer')
     <!-- Bootstrap JS Bundle with Popper -->
@endsection

@push('scripts')
<script src="{{ asset('assets/JS/frontend/front.js') }}"></script>
@stack('script')
@endpush

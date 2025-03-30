@extends('layouts.app')


@push('styles')
<link rel="stylesheet" href="{{ asset('assets/CSS/dashboard/dashboard.css') }}">
@endpush
@section('content')
    <!-- Sidebar -->
    @include('partials.dashboard.sidebar')
     <!-- endSidebar -->
    <!-- Main Content -->
    <div class="main-content">
        <!-- navBare -->
        @include('partials.dashboard.navbar_dashboard')
         <!-- endnavBare -->
        <!-- Begin Page Content -->
        <div class="container-fluid fade-in">

           @yield('contents')
            <!-- Logout Modal -->
            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logoutModalLabel">Confirmation de déconnexion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir vous déconnecter ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <form method="post" action="{{route('logout')}}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Oui, se déconnecter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Custom Scripts -->
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/JS/dashboard/dashboard.js') }}"></script>

@stack('statisticsJs')
@endpush
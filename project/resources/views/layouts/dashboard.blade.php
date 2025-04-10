@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/CSS/dashboard/dashboard.css') }}">
@endpush

@section('content')
    <!-- Sidebar -->
    @include('partials.dashboard.sidebar')
    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        @include('partials.dashboard.navbar_dashboard')
        <!-- Begin Page Content -->
        <div class="container-fluid fade-in">
           @yield('contents')
            
            <!-- Logout Modal -->
           @include('partials.logout')
            <!-- Custom Scripts -->
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/JS/dashboard/dashboard.js') }}"></script>
@stack('statisticsJs')
@endpush
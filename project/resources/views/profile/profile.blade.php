
@extends('layouts.frontend')

@push('style')
<style>
   
    .profile-container {
        max-width: 1200px;
        margin: 30px auto;
      
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    /* Sidebar Style - Exactement comme dans votre screenshot */
    .sidebar {
        background-color: #343a40;
        color: white;
        padding: 30px 20px;
        min-height: 100%;
    }
    .profile-avatar {
        width: 100px;
        height: 100px;
        background-color: #000;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        margin: 0 auto 20px;
    }
    .sidebar-header {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        text-align: center;
    }
    .sidebar-menu {
        list-style: none;
        padding: 0;
    }
    .sidebar-menu li {
        margin-bottom: 10px;
    }
    .sidebar-menu a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        display: block;
        padding: 8px 10px;
        border-radius: 5px;
        transition: all 0.3s;
    }
    .sidebar-menu a:hover, 
    .sidebar-menu a.active {
        color: white;
        background-color: rgba(255,255,255,0.1);
    }
    /* Content Area */
    .content-area {
        padding: 30px;
    }
    .section-title {
        font-size: 1.8rem;
        margin-bottom: 25px;
        color: #343a40;
        font-weight: 600;
    }
    .upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 30px;
        text-align: center;
        margin-bottom: 20px;
       
    }
    .upload-icon {
        font-size: 3rem;
        color: #6c757d;
        margin-bottom: 15px;
    }
    .btn-save {
        background-color: #343a40;
        color: white;
        padding: 10px 25px;
        border-radius: 5px;
        border: none;
        font-weight: 500;
    }
    .btn-save:hover {
        background-color: #23272b;
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .sidebar {
            border-radius: 10px 10px 0 0;
        }
        .content-area {
            border-radius: 0 0 10px 10px;
        }
    }
</style>
@endpush

@section('contents')
<div class="container-fluid profile-container p-0">
    <div class="row g-0">
        <!-- Sidebar - Identique à votre screenshot -->
        <div class="col-lg-3 sidebar">
            <div class="profile-avatar">RS</div>
            <div class="sidebar-header">Rida Sersif</div>
            <ul class="sidebar-menu">
                <li><a href="{{route('meProfile')}}">Voir le profil public</a></li>
                <li><a href="{{route('imageProfile')}}">Photo</a></li>
                <li><a href="{{route('securiteProfile')}}">Sécurité du compte</a></li>
            </ul>
        </div>
        
        <!-- Content Area qui sera rempli par les vues enfants -->
        <div class="col-lg-9 content-area">
            @yield('profile-content')
        </div>
    </div>
</div>
@endsection
@push('script')
<!-- Bootstrap Icons -->
 
<!-- Bootstrap JS Bundle with Popper -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}} 
@endpush
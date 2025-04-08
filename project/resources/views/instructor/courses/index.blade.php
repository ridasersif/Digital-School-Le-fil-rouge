@extends('layouts.dashboard')

@section('title', 'listes des cours')
@push('styles')
{{-- <link rel="stylesheet" href="{{ asset('assets/CSS/auth/auth.css') }}"> --}}
@endpush
@section('contents')

   <!-- Bouton pour ouvrir le modal -->
   
    @if(session('success'))
        <div class="alert alert-success" role="alert" id="successAlert">
            {{ session('success') }}
        </div>
    @endif
   
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0">Listes des cours</h1>
            <a href="{{route('instructor.courses.create')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" >
                <i class="fas fa-plus-circle fa-sm text-white-50"></i> Créer un cours
            </a>
        </div>
        
  

   
@endsection

@push('scripts')
<script src="{{ asset('assets/JS/dashboard/admin/categories.js') }}"></script>
@endpush
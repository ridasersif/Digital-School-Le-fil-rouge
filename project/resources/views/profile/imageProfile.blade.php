

@extends('profile.profile')

@section('title', 'Photo de Profil')

@push('style')
@endpush

@section('profile-content')
    <h1 class="section-title">Aperçu de l'image</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Ajouter/Modifier l'image</h5>
            <form action="{{ route('update.Avatar') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="upload-area">
                @if(auth()->user()->profile && auth()->user()->profile->avatar) 
                    <img src="{{ asset('storage/' . auth()->user()->profile->avatar) }}" alt="Profile Image" class="img-fluid mb-3" style="max-width: 200px;">
                @else 
                    <p class="text-muted">Aucune image sélectionnée</p>
                @endif

                <div class="upload-icon">
                    <i class="bi bi-cloud-arrow-up"></i>
                </div>
                <p class="text-muted">Aucun fichier sélectionné</p>
                <input type="file" id="file-upload" class="d-none" name="avatar" onchange="previewImage(event)">
                <label for="file-upload" class="btn btn-outline-secondary mt-3">
                    Télécharger l'image
                </label>
            </div>

            <div id="image-preview-container" class="mt-3">
                <img id="image-preview" src="#" alt="Preview" style="display: none; max-width: 200px;">
            </div>

            <div class="d-flex justify-content-end">
             
                  
                    <button class="btn-save" type="submit">
                     <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                        Sauvegarder
                    </button>
             
            </div>
        </form>
        </div>
    </div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image-preview');
            output.src = reader.result;
            output.style.display = 'block'; 
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection

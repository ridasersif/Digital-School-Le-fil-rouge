
 @extends('profile.profile')
@section('title', 'Photo de Profil')

@push('style')

@endpush

@section('profile-content')
    <h1 class="section-title">Aperçu de l'image</h1>
    
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Ajouter/Modifier l'image</h5>
            
            <div class="upload-area">
                <div class="upload-icon">
                    <i class="bi bi-cloud-arrow-up"></i>
                </div>
                <p class="text-muted">Aucun fichier sélectionné</p>
                <input type="file" id="file-upload" class="d-none">
                <label for="file-upload" class="btn btn-outline-secondary mt-3">
                    Télécharger l'image
                </label>
            </div>
            
            <div class="d-flex justify-content-end">
                <button class="btn-save">Sauvegarder</button>
            </div>
        </div>
    </div>
@endsection

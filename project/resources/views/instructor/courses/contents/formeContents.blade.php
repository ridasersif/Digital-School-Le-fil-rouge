@extends('instructor.courses.cours')

@section('title', 'Créer un cours')

@push('styles')
{{-- <link rel="stylesheet" href="{{ asset('assets/CSS/auth/auth.css') }}"> --}}
@endpush

@section('courses')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Ajouter un cours</h1>
        {{-- <a href="{{ route('instructor.courses.index') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class=" "></i> Router vers la liste des cours
        </a> --}}
    </div>
    <div class="creation-card card">
        <div class="card-body p-4">

    <!-- Formulaire pour ajouter du contenu -->
            <form id="contentForm">
                <input type="hidden" id="contentType">

                <div class="mb-3">
                    <label class="form-label">Titre du contenu</label>
                    <input type="text" class="form-control" id="contentTitle" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description (optionnelle)</label>
                    <textarea class="form-control" id="contentDescription" rows="3"></textarea>
                </div>

                <!-- Champs pour les vidéos -->
                <div id="videoFields">
                    <div class="mb-3">
                        <label class="form-label">Lien de la vidéo</label>
                        <input type="url" class="form-control" placeholder="https://..." id="videoUrl">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Durée de la vidéo (minutes)</label>
                            <input type="number" class="form-control" min="1" id="videoDuration">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Miniature (optionnelle)</label>
                            <input type="file" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>

                <!-- Champs pour les fichiers -->
                <div id="fileFields" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">Téléverser le fichier</label>
                        <input type="file" class="form-control" id="pdfFile" accept=".pdf">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description du fichier (optionnelle)</label>
                        <textarea class="form-control" rows="2" placeholder="Décrivez brièvement le contenu du fichier"></textarea>
                    </div>
                </div>

              
                <div class="nav-buttons">
                    <a class="btn back-btn" href="{{route('instructor.contents.index')}}"> <i class="fas fa-arrow-left me-2"></i> Précédent</a>
                    <a class="btn next-btn" href="">  Enregistrer le contenu<i class="fas fa-arrow-right ms-2"></i>  </a>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script src="{{ asset('assets/JS/dashboard/admin/categories.js') }}"></script>
@endpush

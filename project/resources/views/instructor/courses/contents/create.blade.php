
@extends('instructor.courses.cours')

@section('title', 'Créer un cours')

@push('styles')
<style>
    .content-types {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        margin-top: 20px;
    }
    .type-btn {
        flex: 1;
        padding: 20px;
        border: 1px solid rgba(67, 97, 238, 0.3);
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        font-size: 18px;
        transition: all 0.3s ease;
    }

    .type-btn:hover {
        background-color: rgba(67, 97, 238, 0.2);
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.1);
    }

    .type-btn i {
        font-size: 24px;
        margin-bottom: 10px;
        display: block;
    }

    .type-btn[data-type="video"] i {
        color: #4e73df;
    }

    .type-btn[data-type="pdf"] i {
        color: #e74a3b;
    }

    .type-btn[data-type="link"] i {
        color: #36b9cc;
    }

    .type-btn.active {
        border: 1px solid rgba(67, 97, 238, 0.3);
        background-color: rgba(67, 97, 238, 0.2);
    }

    .preview-area {
        margin-top: 15px;
        border: 1px solid rgba(67, 97, 238, 0.3);
        border-radius: 5px;
        padding: 15px;
        background-color: #f9f9f9;
    }

    .content-inputs {
    display: block;
    }
    .content-inputs:not(.active) input,
    .content-inputs:not(.active) textarea,
    .content-inputs:not(.active) select {
        display: none; 
        pointer-events: none;
    }
    .content-inputs:not(.active) {
        height: 0;
        overflow: hidden;
    }


    .content-inputs.active {
        display: block;
    }

    .file-preview {
        margin-top: 10px;
        padding: 15px;
        border-radius: 5px;
        border: 1px solid rgba(67, 97, 238, 0.3);
    }

    .thumbnail-preview {
        max-width: 100%;
        max-height: 200px;
        border-radius: 5px;
        margin-top: 10px;
        border: 1px solid #ddd;
        display: block;
    }

    .image-preview-container {
        margin-top: 15px;
        text-align: center;
        display: none;
    }
    
    .optional-field {
       
        padding: 10px;
        border-radius: 5px;
        margin-top: 10px;
        border: 1px solid rgba(67, 97, 238, 0.3);
    }
    .optional-field label {
        color: #5a5c69;
        font-size: 0.9rem;
    }
  
    .btn-save{
        display: block;
       
        background-color: rgba(67, 97, 238, 0.1);
        border: 1px solid rgba(67, 97, 238, 0.3);
        border-radius: 8px;
       
    }

    .btn-save:hover {
        background-color: rgba(67, 97, 238, 0.2);
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.1);
    }
    .btn-backe{
        padding: 0.85rem;
        text-align: center;
        transition: all 0.3s ease;
    }
    .btn-backe:hover{
        transform: translateY(-2px);
    }
</style>
@endpush

@section('courses')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Ajouter un cours</h1>
    <a href="{{ route('instructor.course.index') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-list"></i> Liste des cours
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form id="contentForm" class="loadingForm" action="{{ route('instructor.content.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        
           
            <div class="content-types">
                <div class="type-btn active" data-type="video">
                    <i class="fas fa-video"></i>Vidéo
                </div>
                <div class="type-btn" data-type="pdf">
                    <i class="fas fa-file-pdf"></i>PDF
                </div>
                <div class="type-btn" data-type="link">
                    <i class="fas fa-link"></i>Lien
                </div>
            </div>
        
            <input type="hidden" name="type" id="contentType" value="video">
            <input type="hidden" name="cours_id" value="{{ $course->id }}">
        
           
            <div class="mb-3">
                <label class="form-label">Titre du contenu</label>
                <input type="text" class="form-control" name="titre" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description (optionnelle)</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>
        
          
            <div id="videoInputs" class="content-inputs active">
                <div class="mb-3">
                    <label class="form-label">Fichier vidéo</label>
                    <input type="file" class="form-control" name="chemin_video" id="videoFile" accept="video/*">
                    <div id="videoPreview" class="file-preview">
                        <p class="text-muted">La vidéo s'affichera ici après l'avoir sélectionnée</p>
                    </div>
                </div>
                <div class="optional-field">
                    <label class="form-label">Durée de la vidéo (optionnel)</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="duree_video" placeholder="Durée en minutes">
                        <span class="input-group-text">minutes</span>
                    </div>
                </div>
            </div>
        
           
            <div id="pdfInputs" class="content-inputs">
                <div class="mb-3">
                    <label class="form-label">Fichier PDF</label>
                    <input type="file" class="form-control" name="chemin_pdf" id="pdfFile" accept=".pdf">
                    <div id="pdfPreview" class="file-preview">
                        <p class="text-muted">Les informations du PDF s'afficheront ici</p>
                    </div>
                </div>
                <div class="optional-field">
                    <label class="form-label">Nombre de pages (optionnel)</label>
                    <input type="number" class="form-control" name="nombre_pages_pdf" placeholder="Nombre de pages">
                </div>
            </div>
        
           
            <div id="linkInputs" class="content-inputs">
                <div class="mb-3">
                    <label class="form-label">URL du lien</label>
                    <input type="url" class="form-control" name="chemin_lien" id="linkUrl" placeholder="https://...">
                    <div id="linkPreview" class="file-preview">
                        <p class="text-muted">L'aperçu du lien s'affichera ici</p>
                    </div>
                </div>
                <div class="optional-field">
                    <label class="form-label">Durée du contenu (optionnel)</label>
                    <div class="input-group">
                        <input type="number" name="duree_lien" class="form-control" placeholder="Durée en minutes">
                        <span class="input-group-text">minutes</span>
                    </div>
                </div>
            </div>
        
          
            <div class="mb-3">
                <label class="form-label">Image miniature</label>
                <input type="file" class="form-control" name="image" id="contentImage" accept="image/*">
                <div id="imagePreviewContainer" class="image-preview-container">
                    <img id="imagePreview" class="thumbnail-preview">
                </div>
            </div>
        
          
            <div class="mt-4 d-flex justify-content-between">
                <a class="btn btn-backe btn-outline-secondary" href="{{ route('instructor.course.index') }}">
                    <i class="fas fa-arrow-left me-2"></i>Précédent
                </a>
                <button type="submit" class="btn btn-save">
                    Enregistrer le contenu<i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
              <!-- louding -->
             @include('partials.loadingForm')
        </form>
        
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const typeButtons = document.querySelectorAll(".type-btn");
        const contentInputs = document.querySelectorAll(".content-inputs");
        const contentTypeInput = document.getElementById("contentType");
        const imagePreviewContainer = document.getElementById("imagePreviewContainer");
        const imagePreview = document.getElementById("imagePreview");

        typeButtons.forEach(btn => {
            btn.addEventListener("click", () => {
                typeButtons.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                const type = btn.getAttribute("data-type");
                contentTypeInput.value = type;
                contentInputs.forEach(input => input.classList.remove("active"));
                document.getElementById(type + "Inputs").classList.add("active");
            });
        });

        document.getElementById("videoFile").addEventListener("change", function () {
            const file = this.files[0];
            const videoPreview = document.getElementById("videoPreview");
            
            if (file) {
                const url = URL.createObjectURL(file);
                videoPreview.innerHTML = `
                    <video controls src="${url}" class="w-100" style="max-height:200px;"></video>
                    <p class="mt-2"><strong>Nom:</strong> ${file.name}</p>
                    <p><strong>Taille:</strong> ${(file.size / (1024 * 1024)).toFixed(2)} MB</p>
                `;
            } else {
                videoPreview.innerHTML = `<p class="text-muted">La vidéo s'affichera ici après l'avoir sélectionnée</p>`;
            }
        });

        document.getElementById("pdfFile").addEventListener("change", function () {
            const file = this.files[0];
            const pdfPreview = document.getElementById("pdfPreview");
            
            if (file) {
                pdfPreview.innerHTML = `
                    <p><i class="fas fa-file-pdf fa-2x text-danger"></i></p>
                    <p><strong>Nom:</strong> ${file.name}</p>
                    <p><strong>Taille:</strong> ${(file.size / (1024 * 1024)).toFixed(2)} MB</p>
                `;
            } else {
                pdfPreview.innerHTML = `<p class="text-muted">Les informations du PDF s'afficheront ici</p>`;
            }
        });

        document.getElementById("linkUrl").addEventListener("input", function () {
            const url = this.value;
            const linkPreview = document.getElementById("linkPreview");
            
            if (url) {
                linkPreview.innerHTML = `
                    <p><i class="fas fa-link fa-lg text-info"></i> <strong>Lien:</strong></p>
                    <a href="${url}" target="_blank" class="d-block mt-2 text-break">${url}</a>
                `;
            } else {
                linkPreview.innerHTML = `<p class="text-muted">L'aperçu du lien s'affichera ici</p>`;
            }
        });

        document.getElementById("contentImage").addEventListener("change", function() {
            const file = this.files[0];
            
            if (file) {
                const url = URL.createObjectURL(file);
                imagePreview.src = url;
                imagePreviewContainer.style.display = "block";
            } else {
                imagePreviewContainer.style.display = "none";
            }
        });
        document.querySelectorAll('.type-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const type = this.dataset.type;
        document.getElementById('contentType').value = type;

        const inputs = ['videoInputs', 'pdfInputs', 'linkInputs'];
        inputs.forEach(id => {
            const section = document.getElementById(id);
            if (id.startsWith(type)) {
                section.classList.add('active');
                section.querySelectorAll('input, textarea').forEach(field => field.disabled = false);
            } else {
                section.classList.remove('active');
                section.querySelectorAll('input, textarea').forEach(field => field.disabled = true);
            }
        });
    });
});
    });
</script>
@endpush


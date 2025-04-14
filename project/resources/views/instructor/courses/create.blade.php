
 @extends('instructor.courses.cours')

@section('title',  $isUpdate ? 'Modifier le cours' : 'Créer un cours')

@push('styles')
<style>
    .preview-container {
        margin-top: 10px;
        border-radius: 5px;
        border: 1px dashed #ccc;
        padding: 10px;
        display: none;
    }

    .video-preview,
    .image-preview {
        max-width: 100%;
        height: auto;
    }

    .image-preview {
        max-height: 200px;
    }
</style>
@endpush

@section('courses')
    @if(session('success'))
        <div class="alert alert-success" role="alert" id="successAlert">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">{{ $isUpdate ? 'Modifier le cours' : 'Créer un cours' }}</h1>
        <a href="{{ route('instructor.course.index') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Retour à la liste
        </a>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <h3 class="card-title">{{ $isUpdate ? 'Modifier le cours' : 'Créer un nouveau cours' }}</h3>

            <form id="createCourseForm" method="POST" class="loadingForm"
            action="{{ $isUpdate ? route('instructor.course.update', $course) : route('instructor.course.store') }}"

                  enctype="multipart/form-data">
                @csrf
                @if($isUpdate)
                    @method('PUT')
                @endif

                <!-- Titre -->
                <div class="mb-3">
                    <label class="form-label">Titre du cours</label>
                    <input type="text" name="titre"
                           class="form-control @error('titre') is-invalid @enderror"
                           placeholder="Entrez un titre attractif pour le cours"
                           value="{{ old('titre', $course->titre ?? '') }}">
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Description du cours</label>
                    <textarea name="description"
                              class="form-control @error('description') is-invalid @enderror"
                              rows="4"
                              placeholder="Décrivez le contenu et les objectifs du cours">{{ old('description', $course->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Catégorie -->
                <div class="mb-3">
                    <label class="form-label">Catégorie</label>
                    <select name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">Choisir une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    {{ old('category_id', $course->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Prix -->
                <div class="mb-3">
                    <label class="form-label">Prix du cours (MAD)</label>
                    <input type="number" name="price"
                           class="form-control @error('price') is-invalid @enderror"
                           placeholder="Ex: 199" min="0"
                           value="{{ old('price', $course->price ?? '') }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Vidéo d'introduction -->
              <!-- Vidéo d'introduction -->
                <div class="mb-3">
                    <label class="form-label">Vidéo d'introduction</label>
                    <input type="file" name="video_intro" id="video_intro"
                        class="form-control @error('video_intro') is-invalid @enderror"
                        accept="video/*">
                    @error('video_intro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="videoPreviewContainer" class="preview-container" 
                        style="{{ ($isUpdate && !empty($course->video_intro)) ? 'display: block;' : '' }}">
                        <h6>Aperçu de la vidéo:</h6>
                        <video id="videoPreview" class="video-preview" controls>
                            @if($isUpdate && !empty($course->video_intro))
                                <source src="{{ asset('storage/' . $course->video_intro) }}" type="video/mp4">
                                Votre navigateur ne supporte pas la vidéo.
                            @endif
                        </video>
                    </div>
                </div>

                <!-- Image de couverture -->
                <!-- Image de couverture -->
                <div class="mb-4">
                    <label class="form-label">Image de couverture</label>
                    <input type="file" name="image" id="course_image"
                        class="form-control @error('image') is-invalid @enderror"
                        accept="image/*">
                    <div class="form-text">Taille recommandée : 1280×720 pixels</div>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="imagePreviewContainer" class="preview-container"
                        style="{{ ($isUpdate && !empty($course->image)) ? 'display: block;' : '' }}">
                        <h6>Aperçu de l'image:</h6>
                        <img id="imagePreview" class="image-preview"
                            src="{{ ($isUpdate && !empty($course->image)) ? asset('storage/' . $course->image) : '' }}"
                            alt="Aperçu de l'image">
                    </div>
                </div>

                <!-- Formateur ID -->
                <input type="hidden" name="formateur_id" value="{{ auth()->user()->id }}">

                <!-- Bouton d'enregistrement -->
                <div class="text-center d-flex justify-content-between">
                    <a class="btn btn-backe btn-outline-secondary" href="{{ route('instructor.course.index') }}">
                        <i class="fas fa-arrow-left me-2"></i>Retour
                    </a>
                    <button type="submit" class="btn btn-primary">
                        {{ $isUpdate ? 'Mettre à jour le cours' : 'Créer le cours' }}
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
        document.getElementById('course_image').addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const imagePreview = document.getElementById('imagePreview');
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                        document.getElementById('imagePreviewContainer').style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Aperçu vidéo
            document.getElementById('video_intro').addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const videoPreview = document.getElementById('videoPreview');
                        // Supprimer les anciens sources s'ils existent
                        while (videoPreview.firstChild) {
                            videoPreview.removeChild(videoPreview.firstChild);
                        }
                        
                        // Créer une nouvelle source pour la vidéo
                        const source = document.createElement('source');
                        source.src = e.target.result;
                        source.type = file.type;
                        videoPreview.appendChild(source);
                        
                        // Recharger la vidéo pour qu'elle prenne en compte la nouvelle source
                        videoPreview.load();
                        document.getElementById('videoPreviewContainer').style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
    </script>
@endpush


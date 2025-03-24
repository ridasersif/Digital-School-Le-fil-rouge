<div class="modal fade updatecategoryModal" id="updatecategoryModal-{{ $category->id }}" tabindex="-1" aria-labelledby="updatecategoryModal-{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatecategoryModal-{{ $category->id }}">Modifier la catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" id="updateCategoryForm-{{ $category->id }}">
                    @csrf
                    @method('PUT') <!-- Utiliser la méthode PUT pour la mise à jour -->
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom de la catégorie</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ $category->nom }}">
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icône de la catégorie</label>
                        <input type="text" class="form-control" id="icon-{{ $category->id }}" name="icon" placeholder="Recherchez une icône..." value="{{ $category->icon }}" autocomplete="off">
                        <div id="iconSuggestions-{{ $category->id }}" class="list-group position-absolute w-100 mt-1" style="z-index: 1000;"></div>
                    </div>
                    <div class="text-center mt-3">
                        <i id="iconPreview-{{ $category->id }}" class="fs-2">
                            <iconify-icon icon="{{ $category->icon }}" width="24" height="24"></iconify-icon>
                        </i>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ $category->description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </div>
                </form>
                <div id="message-{{ $category->id }}" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>
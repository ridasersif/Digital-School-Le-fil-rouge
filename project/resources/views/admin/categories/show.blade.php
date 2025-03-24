<div class="modal fade" id="categoryModal-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel-{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="categoryModalLabel-{{ $category->id }}">
                    <i class="fas fa-info-circle me-2"></i>Détails de la catégorie
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                     <iconify-icon
                         icon="{{ $category->icon }}" width="120" height="120"
                          class="rounded-circle border border-3 border-primary shadow-sm">
                    </iconify-icon>
                </div>
                <div class="card border-0 bg-light mb-3">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-4 text-secondary fw-bold">Nom:</div>
                            <div class="col-8">{{ $category->nom }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 text-secondary fw-bold">Description:</div>
                            <div class="col-8">{{ $category->description ?: 'Aucune description' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 text-secondary fw-bold">Date Création:</div>
                            <div class="col-8">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ $category->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 text-secondary fw-bold">Dernière Modification:</div>
                            <div class="col-8">
                                <i class="far fa-edit me-1"></i>
                                {{ $category->updated_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Fermer
                </button>
                <button class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#updatecategoryModal-{{ $category->id }}">
                    <i class="fas fa-edit me-1"></i>Modifier
                </button>
            </div>
        </div>
    </div>
</div>
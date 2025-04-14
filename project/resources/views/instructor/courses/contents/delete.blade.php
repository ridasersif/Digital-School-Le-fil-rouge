@foreach($course->contents as $content)
<!-- Modal de Confirmation -->
<div class="modal fade" id="deleteModal-{{ $content->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header ">
              <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="text-center mb-3">
                  <i class="bi bi-exclamation-triangle text-warning display-4"></i>
              </div>
              <p class="text-center">Êtes-vous sûr de vouloir supprimer ce content ?<br>Cette action est irréversible.</p>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
              <form action="{{ route('instructor.contents.destroy', $content->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                  <button type="submit" class="btn btn-danger ms-2">Supprimer</button>
              </form>
          </div>
      </div>
  </div>
</div>
  <!-- end Modal de Confirmation -->
@endforeach
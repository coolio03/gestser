{{-- !-- Delete Warning Modal -->  --}}
<form action="{{ route('cadre.collaborateurs.destroy', $collaborateur->id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">Etes vous sure de vouloir Supprimer le collaborateur {{ $collaborateur->nom.' '.$collaborateur->prenoms }} ?</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annule</button>
        <button type="submit" class="btn btn-danger">Oui, Supprimer Collaborateur</button>
    </div>
</form>
<div class="modal-header">
  <h4 class="modal-title" >Demande(s) relative(s) au collaborateur <em  style="color: blue">{{$collabo->nom}}  {{$collabo->prenoms}} </em> </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
  <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Numero demande</th>
          <th>Type de demande</th>
          <th>Date  de reception</th>
          <th>Responsable de traitement</th>
          <th>date de traitement</th>
          <th>Statut</th>
        </tr>
      </thead>
      <tbody>
        @if (count($collabo->demande))
          @foreach($collabo->demande as $dde)
            <tr>
              <th>{{ $loop->index+1 }}</th>
              <td> {{$dde->numero_dossier}} </td>
              <td> {{$dde->type}} </td>
              <td> {{date('d/m/Y',strtotime($dde->date_reception))}} </td>
              <td> 
                @if (!empty($dde->user->name))
                  {{$dde->user->name}}
                @else
                    
                @endif
              </td>
              <td> 
                @if ($dde->date_traitement!=null)
                  {{date('d/m/Y',strtotime($dde->date_traitement))}}
                @endif
              <td>
                @if ($dde->date_traitement == false)
                    Non Traite
                @else
                    Traite
                @endif
                /
                @if ($dde->status == false)
                  Non complet
                @else 
                  Complet
                @endif  
              </td>         
            </tr>
          @endforeach
        @else
          <tr><td colspan="7"> Pas de Demandes Trouvees</td></tr>
        @endif
     
        
      </tbody>
  </table>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" id="submit" class="btn btn-primary" data-dismiss="modal">Enregistrer</button>
</div>

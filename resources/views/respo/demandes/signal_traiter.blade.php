<form action=" {{route('traiter', $demande->id)}}" method="post">
    @method('put')
    {{csrf_field()}}
    <div class="modal-header">
        <h4 class="modal-title" >Mise a jour du suivie de la demande de <em  style="color: blue" >{{$demande->type}}  </em> de @if ($demande->motif_demande == 'CDD' or $demande->motif_demande =="CONSULTANCE"){{$demande->motif_demande}}  de
            
        @endif <em  style="color: blue">{{$demande->collaborateur->nom.' '.$demande->collaborateur->prenoms }}  </em> </h4>
       
    </div>
    <div class="modal-body">
        <input type="hidden" name="id" value=" {{$demande->id}} ">
        <div class="row">
                @if (!isset($demande->date_traitement))
                    @include('partials.form-group',[
                    'title'=>__('Date de Traitement'),
                    'type'=>'date',
                    'name'=>'date_traitement',
                    'value' => $demande->date_traitement,
                    'required'=>true
                    ])
                @endif
                @if ($demande->date_traitement != null)
                    @if (!isset($demande->date_saisir_hr))
                        @include('partials.form-group',[
                            'title'=>__('Date de saisir HR'),
                            'type'=>'date',
                            'name'=>'date_saisir_hr',
                            'value' => $demande->date_saisir_hr,
                            'required'=>true
                        ])
                    @endif
                    @if (!isset($demande->date_archive))
                        @include('partials.form-group',[
                            'title'=>__('Date Archivage'),
                            'type'=>'date',
                            'name'=>'date_archive',
                            'value' => $demande->date_archive,
                            'required'=>true
                        ])
                    @endif
                @endif
                <div class="form-group col-6">
                    <label>Observation</label>
                    <textarea name="observation" class="form-control" rows="3" placeholder="Observation ..." >
                        {{$demande->observation}} 
                    </textarea>
                </div>
                
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>

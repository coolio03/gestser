<form action=" #" method="post">
    @method('put')
    {{csrf_field()}}
    <div class="modal-header">
        <h4 class="modal-title" >Mise a jour du suivie de la demande de <em  style="color: blue" >{{$demande->type}}  </em> de <em  style="color: blue">{{$demande->collaborateur->nom.' '.$demande->collaborateur->prenoms }}  </em> </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidemanden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <input type="hidden" name="id" value=" {{$demande->id}} ">
        <div class="row">
            <input type="hidden" name="id" value=" {{$demande->type}} ">
            <div class="row">
                @include('partials.form-group-d',[
                    'title'=>__('Date reception'),
                    'type'=>'date',
                    'name'=>'date_reception',
                    'value' =>,
                    'required'=>false
                ])                                          
                @include('partials.form-group-d',[
                    'title'=>__('Date de remise RA'),
                    'type'=>'date',
                    'name'=>'date_remise_ra',
                    'required'=>false,
                ])
                @include('partials.form-group',[
                    'title'=>__('Date de traitement'),
                    'type'=>'date',
                    'name'=>'date_traitement',
                    'required'=>false
                ])  
                @include('partials.form-group',[
                    'title'=>__('Date de Saisie Hr'),
                    'type'=>'date',
                    'name'=>'date_saisir_hr',
                    'required'=>false
                ])                      
            </div>
                
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>

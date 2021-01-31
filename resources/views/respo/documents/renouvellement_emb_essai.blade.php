<form method="post" action=" {{route('redigeRenouvellementEmbEssai', $demande->id)}}  ">
    @method('PUT')
    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
    <input type="hidden" name="id" value=" {{$demande->id}} ">
    <input type="hidden" name="responsable_id" value=" {{ Auth::user()->id }} ">    
    <div class="card-header">
        <h3 class="card-title">Formulaire de Renouvellement de periode d'essai</h3>
      </div>
    <div class="card-body">
        <div class="row">
            @include('partials.form-group-d',[
                'title'=>__('Nom'),
                'type'=>'text',
                'name'=>'nom',
                'value'=>$demande->collaborateur->nom,
                'required'=>true
            ])
            @include('partials.form-group-d',[
                'title'=>__('Prenoms'),
                'type'=>'text',
                'name'=>'prenoms',
                'value'=>$demande->collaborateur->prenoms,
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Direction S/C'),
                'type'=>'text',
                'name'=>'direction_sc',
                'required'=>true
            ])
            @include('partials.form-group',[
                'title'=>__('Copie'),
                'type'=>'text',
                'name'=>'copie',
                'required'=>true
            ])  
             @include('partials.form-group',[
                'title'=>__('Poste'),
                'type'=>'text',
                'name'=>'poste',
                'required'=>true
            ])   
             @include('partials.form-group',[
                'title'=>__('delai'),
                'type'=>'text',
                'name'=>'delai',
                'required'=>true
            ]) 
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="" >Unite du delai</label>
                    <select name="unite" id="" class="form-control">
                        <option value="">Choisir type</option>
                        <option value="jours">Jours</option>
                        <option value="semaine">Semaine</option>
                        <option value="mois">Mois</option>                                    
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
        </div> 
    </div>            
      
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
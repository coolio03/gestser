<form method="post" action=" {{route('redigeContratCDI', $demande->id)}}  ">
    @method('PUT')
    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
    <input type="hidden" name="id" value=" {{$demande->id}} ">
    <input type="hidden" name="responsable_id" value=" {{ Auth::user()->id }} ">    
    <div class="card-header">
        <h3 class="card-title">Formulaire de contrat CDI</h3>
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
                'title'=>__('Matricule'),
                'type'=>'text',
                'name'=>'matricule',
                'required'=>true
            ])
            @include('partials.form-group',[
                'title'=>__('Nom et Prenoms du Père'),
                'type'=>'text',
                'name'=>'nom_pere',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Nom et Prenoms du Mère'),
                'type'=>'text',
                'name'=>'nom_mere',
                'required'=>true
            ])
           
             <div class="col-sm-6">
                <div class="form-group">
                    <label for="" >Situation Familiale</label>
                    <select name="situation_familiale" id="" class="form-control">
                        <option value="">Choisir Situation</option>
                        <option value="Célibataire">Célibataire</option>
                        <option value="Marié(e)">Marié(e)</option>                                                      
                        <option value="Veuve">Veuve</option>                                                      
                        <option value="Divorcé(e)">Divorcé(e)</option>                                                      
                                                                         
                    </select>
                </div>
                <div class="clearfix"></div>
            </div> 
            
            @include('partials.form-group',[
                'title'=>__("Lieu d'habitation"),
                'type'=>'text',
                'name'=>'lieu_habitation',
                'required'=>true
            ]) 
             @include('partials.form-group',[
                'title'=>__("Nationalité"),
                'type'=>'text',
                'name'=>'nationnalite',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__("Profession"),
                'type'=>'text',
                'name'=>'profession',
                'required'=>true
            ]) 
            @include('partials.form-group',[
            'title'=>__('Fonction'),
            'type'=>'text',
            'name'=>'fonction',
            'required'=>true
            ])            
            @include('partials.form-group',[
                'title'=>__("Direction acceuil"),
                'type'=>'text',
                'name'=>'direction_acceuil',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__("Echelon"),
                'type'=>'text',
                'name'=>'echellon',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Salaire Mensuelle'),
                'type'=>'text',
                'name'=>'salaire_mensuelle',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Prime Logement'),
                'type'=>'text',
                'name'=>'prime_logement',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Prime de transport'),
                'type'=>'text',
                'name'=>'prime_transport',
                'required'=>true
            ])
            @include('partials.form-group',[
                'title'=>__('Indemnité Tranche Gratuite'),
                'type'=>'text',
                'name'=>'ind_tranche_grat',
                'required'=>true
            ])  
            @include('partials.form-group',[
                'title'=>__('Date de debut'),
                'type'=>'date',
                'name'=>'date_debut',
                'required'=>true
            ]) 
            
        </div> 
    </div>            
      
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
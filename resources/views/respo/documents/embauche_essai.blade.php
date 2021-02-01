<form method="post" action=" {{route('redigeContratEmbauche', $demande->id)}}  ">
    @method('PUT')
    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
    <input type="hidden" name="id" value=" {{$demande->id}} ">
    <input type="hidden" name="responsable_id" value=" {{ Auth::user()->id }} ">   
    <div class="card-header">
        <h3 class="card-title">Formulaire de contrat Embauche a l'essai</h3>
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
                'title'=>__('Direction S/C'),
                'type'=>'text',
                'name'=>'direction_sc',
                'required'=>true
            ])  
            @include('partials.form-group',[
                'title'=>__('Delai de stage'),
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
            @include('partials.form-group',[
                'title'=>__('Direction Acceuil'),
                'type'=>'text',
                'name'=>'direction_acceuil',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Service Acceuil'),
                'type'=>'text',
                'name'=>'service_acceuil',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Fonction'),
                'type'=>'text',
                'name'=>'fonction',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Classement'),
                'type'=>'text',
                'name'=>'classement',
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
                'title'=>__('Ind. Entretient Bleu'),
                'type'=>'text',
                'name'=>'prime_entretien',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Date de debut'),
                'type'=>'date',
                'name'=>'date_debut',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Date de fin'),
                'type'=>'date',
                'name'=>'date_fin',
                'required'=>true
            ]) 
        </div> 
    </div>            
      
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
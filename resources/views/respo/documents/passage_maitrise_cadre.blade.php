<form method="post" action=" {{route('redigePassageMC', $demande->id)}}  ">
    @method('PUT')
    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
    <input type="hidden" name="id" value=" {{$demande->id}} ">
    <input type="hidden" name="responsable_id" value=" {{ Auth::user()->id }} ">   
    <div class="card-header">
        <h3 class="card-title">Formulaire de Courier de Promotion suite a publication de Poste</h3>
      </div> 
    <div class="card-body">
        <div class="row">
            @include('partials.form-group',[
                'title'=>__('Nom'),
                'type'=>'text',
                'name'=>'nom',
                'value'=>$demande->collaborateur->nom,
                'required'=>true
            ])
            @include('partials.form-group',[
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
                'value'=>$demande->collaborateur->matricule,
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Plage Catégorielle'),
                'type'=>'text',
                'name'=>'plage_categorielle',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Ancien Classement'),
                'type'=>'text',
                'name'=>'classement_actuel',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Nouveau Classement'),
                'type'=>'text',
                'name'=>'classement_nouveau',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Nouveau Salaire'),
                'type'=>'text',
                'name'=>'salaire_nouveau',
                'required'=>true
            ])
             @include('partials.form-group',[
                'title'=>__("Prime de logement"),
                'type'=>'text',
                'name'=>'prime_logement',
                'required'=>true
            ])
             @include('partials.form-group',[
                'title'=>__("Indemnite Kilo Info"),
                'type'=>'text',
                'name'=>'ind_kilo_info',
                'required'=>true
            ])
             @include('partials.form-group',[
                'title'=>__("Indemnite Tranche Gratuite"),
                'type'=>'text',
                'name'=>'ind_tranche_grat',
                'required'=>true
            ])
             @include('partials.form-group',[
                'title'=>__("Indemnite Vehicule S/C"),
                'type'=>'text',
                'name'=>'ind_vehicule_sc',
                'required'=>true
            ])
             @include('partials.form-group',[
                'title'=>__("Indemnite Entretien Bleu"),
                'type'=>'text',
                'name'=>'ind_entretien_bleu',
                'required'=>true
            ])
            
            @include('partials.form-group',[
                'title'=>__('Date Effet'),
                'type'=>'date',
                'name'=>'date_effet',
                'required'=>true
                ])          
            

        </div> 
    </div>            
      
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
<form method="post" action=" {{route('redigeProrogation', $demande->id)}}  ">
    @method('PUT')
    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
    <input type="hidden" name="id" value=" {{$demande->id}} ">
    <input type="hidden" name="responsable_id" value=" {{ Auth::user()->id }} ">   
    <div class="card-header">
        <h3 class="card-title">Formulaire de Prorogation de contrat de {{$demande->motif_demande}} </h3>
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
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="" >Civilité SC</label>
                    <select name="civilite_sc" id="" class="form-control">
                        <option value="">Choisir Civilité</option>
                        <option value="Monsieur">Monsieur</option>
                        <option value="Madame">Madame</option>
                        <option value="Mademoiselle">Mademoiselle</option>
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            @include('partials.form-group',[
                'title'=>__('Direction SC'),
                'type'=>'text',
                'name'=>'direction_sc',
                'required'=>true
            ]) 
             @include('partials.form-group',[
                'title'=>__('Personnes en copie'),
                'type'=>'text',
                'name'=>'copie',
                'required'=>true
            ])    
            @include('partials.form-group',[
                'title'=>__('Date de Fin 1er Contrat'),
                'type'=>'date',
                'name'=>'date_fin',
                'required'=>true
            ])    
             @include('partials.form-group',[
                'title'=>__('Nouveau delai'),
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
                'title'=>__('Date de Debut Prorogation'),
                'type'=>'date',
                'name'=>'date_debut_pro',
                'required'=>true
            ])          
            @include('partials.form-group',[
                'title'=>__('Date de Fin Prorogation'),
                'type'=>'date',
                'name'=>'date_fin_pro',
                'required'=>true
            ])
            

        </div> 
    </div>            
      
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
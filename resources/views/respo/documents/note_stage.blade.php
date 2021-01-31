<form method="post" action=" {{route('redigeNote', $demande->id)}}  ">
    @method('PUT')
    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
    <input type="hidden" name="id" value=" {{$demande->id}} ">
    <input type="hidden" name="responsable_id" value=" {{ Auth::user()->id }} ">    
    <div class="card-header">
        <h3 class="card-title">Formulaire de note de STAGE</h3>
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
                'title'=>__('Destinataire'),
                'type'=>'text',
                'name'=>'destinataire',
                'required'=>true
            ]) 
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="" >Statut</label>
                    <select name="statut" id="" class="form-control">
                        <option value="">Choisir statut</option>
                        <option value="élève">Elève</option>
                        <option value="étudiant">Etudiant</option>
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            @include('partials.form-group',[
                'title'=>__("Niveau d'etude "),
                'type'=>'text',
                'name'=>'niveau',
                'required'=>true
            ]) 
            @include('partials.form-group',[
            'title'=>__('Option'),
            'type'=>'text',
            'name'=>'option',
            'required'=>true
            ]) 
            @include('partials.form-group',[
            'title'=>__('Ecole'),
            'type'=>'text',
            'name'=>'ecole',
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
                'title'=>__('Objet'),
                'type'=>'text',
                'name'=>'objet',
                'required'=>true
                ])
        </div> 
    </div>            
      
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
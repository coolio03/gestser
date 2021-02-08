<form method="post" action=" {{route('redigeReclassement', $demande->id)}}  ">
    @method('PUT')
    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
    <input type="hidden" name="id" value=" {{$demande->id}} ">
    <input type="hidden" name="responsable_id" value=" {{ Auth::user()->id }} ">   
    <div class="card-header">
        <h3 class="card-title">Formulaire de Courier de reclassement</h3>
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
                'title'=>__('Ancienne Fonction'),
                'type'=>'text',
                'name'=>'ancienne_fonction',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Nouvelle Fonction'),
                'type'=>'text',
                'name'=>'nouvelle_fonction',
                'required'=>true
            ]) 
            
            @include('partials.form-group',[
                'title'=>__('Classement Actuel'),
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
                'title'=>__('Ancien Salaire'),
                'type'=>'text',
                'name'=>'salaire_ancien',
                'required'=>true
            ])
           
            @include('partials.form-group',[
                'title'=>__('Nouveau Salaire'),
                'type'=>'text',
                'name'=>'salaire_nouveau',
                'required'=>true
            ])
             @include('partials.form-group',[
                'title'=>__("Prime d'ancienneté"),
                'type'=>'text',
                'name'=>'prime_anciennete',
                'required'=>true
            ])
            @include('partials.form-group',[
                'title'=>__('Personnes en copie'),
                'type'=>'text',
                'name'=>'copie',
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
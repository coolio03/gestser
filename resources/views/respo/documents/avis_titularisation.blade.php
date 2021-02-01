<form method="post" action=" {{route('redigeAvisTitularisation', $demande->id)}}  ">
    @method('PUT')
    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
    <input type="hidden" name="id" value=" {{$demande->id}} ">
    <input type="hidden" name="responsable_id" value=" {{ Auth::user()->id }} "> 
    <div class="card-header">
        <h3 class="card-title">Formulaire d'Avis de Titularisation</h3>
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
                'title'=>__('Destinataire'),
                'type'=>'text',
                'name'=>'destinataire',
                'required'=>true
            ])   
            @include('partials.form-group',[
                'title'=>__('Copie'),
                'type'=>'text',
                'name'=>'copie',
                'required'=>true
            ])
            @include('partials.form-group',[
                'title'=>__('Date fin Essaie'),
                'type'=>'date',
                'name'=>'date_fin_essai',
                'required'=>true
            ])   
            @include('partials.form-group',[
                'title'=>__('Classement'),
                'type'=>'text',
                'name'=>'classement_actuel',
                'required'=>true
            ]) 
             @include('partials.form-group',[
                'title'=>__('Fonction'),
                'type'=>'text',
                'name'=>'fonction',
                'required'=>true
            ]) 
             @include('partials.form-group',[
                'title'=>__('Direction'),
                'type'=>'text',
                'name'=>'direction',
                'required'=>true
            ]) 
             @include('partials.form-group',[
                'title'=>__('Code Exploitation'),
                'type'=>'text',
                'name'=>'code_expl',
                'required'=>true
            ])        
            @include('partials.form-group',[
                'title'=>__('Date de debut'),
                'type'=>'date',
                'name'=>'date_debut',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Date de fin Essaie'),
                'type'=>'date',
                'name'=>'date_fin_essaie',
                'required'=>true
            ]) 
        </div> 
    </div>            
      
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
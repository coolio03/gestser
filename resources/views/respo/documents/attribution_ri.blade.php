<form method="post" action=" {{route('redigeReglementInterieur', $demande->id)}}  ">
    @method('PUT')
    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
    <input type="hidden" name="id" value=" {{$demande->id}} ">
    <input type="hidden" name="responsable_id" value=" {{ Auth::user()->id }} ">    
    <div class="card-header">
        <h3 class="card-title">Formulaire d'attribution Reglement Interieur</h3>
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
                'title'=>__('Direction S/C'),
                'type'=>'text',
                'name'=>'direction_sc',
                'required'=>true
            ]) 
            @include('partials.form-group',[
                'title'=>__('Date de Debut'),
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
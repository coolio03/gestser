<form method="post" action=" {{route('redigeFinContratCDD', $demande->id)}}  ">
    @method('PUT')
    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
    <input type="hidden" name="id" value=" {{$demande->id}} ">
    <input type="hidden" name="responsable_id" value=" {{ Auth::user()->id }} ">
    <div class="card-header">
        <h3 class="card-title">Formulaire de fin contrat CDD</h3>
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
                'title'=>__('Direction Acceuil'),
                'type'=>'text',
                'name'=>'direction_acceuil',
                'required'=>true
            ])
            @include('partials.form-group',[
                'title'=>__('Fonction '),
                'type'=>'text',
                'name'=>'fonction',
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
                  
        </div> 
    </div>            
      
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
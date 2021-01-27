<form method="post" action=" {{route('redige', $demande->id)}}  ">
    @method('PUT')
    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
    <input type="hidden" name="id" value=" {{$demande->id}} ">
    <input type="hidden" name="responsable_id" value=" {{ Auth::user()->id }} ">    
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
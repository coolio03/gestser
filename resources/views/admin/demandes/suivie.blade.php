<form action=" {{route('suivie', $demande->id)}}" method="post">
  @method('put')
  {{csrf_field()}}
  <div class="modal-header">
      <h4 class="modal-title" >Formulaire de Suivie de <em  style="color: blue">{{$demande->type}}  </em> </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <input type="hidden" name="id" id="dde_id" value=" {{$dde->id}} ">
    <div class="row">
       
            @include('partials.form-group',[
                'title'=>__('Date reception'),
                'type'=>'date',
                'name'=>'date_reception',
                'required'=>false
            ])

            
        
            @include('partials.form-group',[
                'title'=>__('Date de remise RA'),
                'type'=>'date',
                'name'=>'date_remise_ra',
                'required'=>false,
            ])
        
    
        @include('partials.form-group',[
            'title'=>__('Date de traitement'),
            'type'=>'date',
            'name'=>'date_traitement',
            'required'=>false
        ])
        
        
        @include('partials.form-group',[
            'title'=>__('Date de Visa CE'),
            'type'=>'date',
            'name'=>'date_visa_ce',
            'required'=>false
        ])
        @include('partials.form-group',[
            'title'=>__('Date de Visa CSER'),
            'type'=>'date',
            'name'=>'date_visa_cser',
            'required'=>false
        ])
           
        @include('partials.form-group',[
            'title'=>__('Date de Visa SDAP'),
            'type'=>'date',
            'name'=>'date_visa_sdap',
            'required'=>false
        ])
        @if ($dde->type != "STAGE ECOLE")
            @include('partials.form-group',[
                'title'=>__('Date de Visa DARH'),
                'type'=>'date',
                'name'=>'date_visa_darh',
                'required'=>false
            ])
                @include('partials.form-group',[
                    'title'=>__('Date de Visa DCRH'),
                    'type'=>'date',
                    'name'=>'date_visa_dcrh',
                    'required'=>false
                ])
                @include('partials.form-group',[
                    'title'=>__('Date de Visa SG'),
                    'type'=>'date',
                    'name'=>'date_visa_sg',
                    'required'=>false
                ])
                
                @include('partials.form-group',[
                    'title'=>__('Date de Visa DG'),
                    'type'=>'date',
                    'name'=>'date_visa_dg',
                    'required'=>false
                ])            
        @endif
        <div class="form-group">
            <label>Textarea</label>
            <textarea name="observation" class="form-control" rows="3" placeholder="Observation ..."></textarea>
          </div>
        </div> 
       
    </div>
  
</div>
  <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="button" id="submit" class="btn btn-primary" data-dismiss="modal">Enregistrer</button>
  </div>

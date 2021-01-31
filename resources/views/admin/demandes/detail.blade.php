<div class="modal-header">
    <h4 class="modal-title" >Circuit de Suivie de la demande de <em  style="color: blue">{{$demande->type}}  </em> </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidemanden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <div class="row">
    @include('partials.form-group-d',[
        'title'=>__('Date reception'),
        'type'=>'date',
        'name'=>'date_reception-d',
        'value' => $demande->date_reception,
        'required'=>true
    ])
    @include('partials.form-group-d',[
        'title'=>__('Date de remise RA'),
        'type'=>'date',
        'name'=>'date_remise_ra',
        'value' => $demande->date_remise_ra,
        'required'=>true
    ])
    @include('partials.form-group-d',[
        'title'=>__('Date de traitement'),
        'type'=>'date',
        'name'=>'date_traitement',
        'value' => $demande->date_traitement,
        'required'=>true
    ])
    @include('partials.form-group-d',[
            'title'=>__('Date de Visa CE'),
            'type'=>'date',
            'name'=>'date_visa_ce',
        'value' => $demande->date_visa_ce,
            'required'=>true
        ])
    @include('partials.form-group-d',[
            'title'=>__('Date de Visa CSER'),
        'type'=>'date',
        'name'=>'date_visa_cser',
        'value' => $demande->date_visa_cser,
        'required'=>true
    ])
    @include('partials.form-group-d',[
        'title'=>__('Date de Visa SDAP'),
        'type'=>'date',
        'name'=>'date_visa_sdap',
        'value' => $demande->date_visa_sdap,
        'required'=>true
    ])
    @if ($demande->type != "STAGE ECOLE")
        @include('partials.form-group-d',[
            'title'=>__('Date de Visa DARH'),
            'type'=>'date',
            'name'=>'date_visa_darh',
            'value' => $demande->date_visa_darh,
            'required'=>true
        ])
        @if ($demande->type != "STAGE IMMERSION" and $demande->type != "STAGE QUALIFICATION")
            @include('partials.form-group-d',[
                'title'=>__('Date de Visa DCRH'),
                'type'=>'date',
                'name'=>'date_visa_dcrh',
                'value' => $demande->date_visa_dcrh,
                'required'=>true
            ])
            @include('partials.form-group-d',[
                'title'=>__('Date de Visa SG'),
                'type'=>'date',
                'name'=>'date_visa_sg',
                'value' => $demande->date_visa_sg,
                'required'=>true
            ])
            @include('partials.form-group-d',[
                'title'=>__('Date de Visa DG'),
                'type'=>'date',
                'name'=>'date_visa_dg',
                'value' => $demande->date_visa_dg,
                'required'=>true
            ])
        @endif
    @endif
    @include('partials.form-group-d',[
                'title'=>__('Date de cloture'),
                'type'=>'date',
                'name'=>'date_cloture',
                'value' => $demande->date_cloture,
                'required'=>true
            ])
    @include('partials.form-group-d',[
        'title'=>__('Date de transmission'),
        'type'=>'date',
        'name'=>'date_transmission',
        'value' => $demande->date_transmission,
        'required'=>true
    ])
    @include('partials.form-group-d',[
        'title'=>__('Date de Saisie dans HR'),
        'type'=>'date',
        'name'=>'date_saisir_hr',
        'value' => $demande->date_saisir_hr,
        'required'=>true
    ])
    @include('partials.form-group-d',[
        'title'=>__('Date archivage'),
        'type'=>'date',
        'name'=>'date_archive',
        'value' => $demande->date_archive,
        'required'=>true
    ])
    <div class="form-group">
        <label>Textarea</label>
        <textarea name="observation" class="form-control" rows="3"  disabled></textarea>
      </div>
    </div>
    </div>
  </div>
  
  
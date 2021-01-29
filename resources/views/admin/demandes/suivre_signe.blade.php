<form action=" {{route('suivie', $demande->id)}}" method="post">
    @method('put')
    {{csrf_field()}}
    <div class="modal-header">
        <h4 class="modal-title" >Mise a jour du suivie de la demande de <em  style="color: blue" >{{$demande->type}}  </em> de <em  style="color: blue">{{$demande->collaborateur->nom.' '.$demande->collaborateur->prenoms }}  </em> </h4>
       
    </div>
    <div class="modal-body">
        <input type="hidden" name="id" value=" {{$demande->id}} ">
        <div class="row">
           
                @if(!isset($demande->date_remise_ra))
                    @include('partials.form-group',[
                        'title'=>__('Date de Remise RA'),
                        'type'=>'date',
                        'name'=>'date_remise_ra',
                        'value' => $demande->date_remise_ra,
                        'required'=>true
                    ])
                @endif
                @if (!isset($demande->date_traitement))
                    @include('partials.form-group',[
                    'title'=>__('Date de Traitement'),
                    'type'=>'date',
                    'name'=>'date_traitement',
                    'value' => $demande->date_traitement,
                    'required'=>true
                    ])
                @endif
                @if (!isset($demande->date_visa_ce))
                    @include('partials.form-group',[
                    'title'=>__('Date de Visa CE'),
                    'type'=>'date',
                    'name'=>'date_visa_ce',
                    'value' => $demande->date_visa_ce,
                    'required'=>true
                    ])
                @endif
                @if (!isset($demande->date_visa_cser))
                    @include('partials.form-group',[
                        'title'=>__('Date de Visa CSER'),
                        'type'=>'date',
                        'name'=>'date_visa_cser',
                        'value' => $demande->date_visa_cser,
                        'required'=>true
                    ])  
                @endif
                @if (!isset($demande->date_visa_sdap))
                    @include('partials.form-group',[
                        'title'=>__('Date de Visa SDAP'),
                        'type'=>'date',
                        'name'=>'date_visa_sdap',
                        'value' => $demande->date_visa_sdap,
                        'required'=>true
                    ])
                @endif
                @if ($demande->type != "STAGE ECOLE")
                    @if (!isset($demande->date_visa_darh))
                        @include('partials.form-group',[
                            'title'=>__('Date de Visa DARH'),
                            'type'=>'date',
                            'name'=>'date_visa_darh',
                            'value' => $demande->date_visa_darh,
                            'required'=>true
                        ])
                    @endif
                    @if ($demande->type != "STAGE IMMERSION" and $demande->type != "STAGE QUALIFICATION")
                        @include('partials.form-group',[
                            'title'=>__('Date de Visa DCRH'),
                            'type'=>'date',
                            'name'=>'date_visa_dcrh',
                            'value' => $demande->date_visa_dcrh,
                            'required'=>true
                        ])
                        @include('partials.form-group',[
                            'title'=>__('Date de Visa SG'),
                            'type'=>'date',
                            'name'=>'date_visa_sg',
                            'value' => $demande->date_visa_sg,
                            'required'=>true
                        ])
                        @if ($demande->type != "PROROGATION")
                            @include('partials.form-group',[
                                'title'=>__('Date de Visa DG'),
                                'type'=>'date',
                                'name'=>'date_visa_dg',
                                'value' => $demande->date_visa_dg,
                                'required'=>true
                            ])
                        @endif
                       
                    @endif
                @endif
                    @if (!isset($demande->date_cloture))
                        @include('partials.form-group',[
                        'title'=>__('Date de Cloture'),
                        'type'=>'date',
                        'name'=>'date_cloture',
                        'value' => $demande->date_cloture,
                        'required'=>true
                        ])
                    @endif
                    @if (!isset($demande->date_transmission))
                         @include('partials.form-group',[
                            'title'=>__('Date de transmission'),
                            'type'=>'date',
                            'name'=>'date_transmission',
                            'value' => $demande->date_transmission,
                            'required'=>true,
                        ])
                    @endif
                    @if (!isset($demande->date_saisir_hr))
                    @include('partials.form-group',[
                        'title'=>__('Date de saisir HR'),
                        'type'=>'date',
                        'name'=>'date_saisir_hr',
                        'value' => $demande->date_saisir_hr,
                        'required'=>true
                    ])
                    @endif
                    @if (!isset($demande->date_archive))
                        @include('partials.form-group',[
                            'title'=>__('Date Archivage'),
                            'type'=>'date',
                            'name'=>'date_archive',
                            'value' => $demande->date_archive,
                            'required'=>true
                        ])
                    @endif
                
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>

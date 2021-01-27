<div class="modal fade" id="suivre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Mise a jour du suivie <span style="color: blue" id="type" ></span> de <span style="color: blue" id="nom"></span>&nbsp; <span style="color: blue" id="prenom"></span> </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <input type="hidden" name="id" id="dde_id" value="">   
        </div>

        <form action=" {{route('suivie', $dde->id)}}" method="post">
                @method('put')
                {{csrf_field()}}
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
                                   
                       
                    </div>
                  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
      </div>
    </div>
</div>



<script>
  
    $('#suivre').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) 
          var date_reception = button.data('mydatereception') 
          var date_remise = button.data('mydateremise') 
          var date_traitement = button.data('mydatetraitement') 
          var date_visa_ce = button.data('mydatevisace');
          var date_visa_cser = button.data('mydatevisacser')
          var date_visa_sdap = button.data('mydatevisasdap')
          var date_visa_darh = button.data('mydatevisadarh')
          var date_visa_dcrh = button.data('mydatevisadcrh')
          var date_visa_sg = button.data('mydatevisasg')
          var date_visa_dg = button.data('mydatevisadg')
          var dde_id = button.data('ddeid') 
          var type = button.data('mytype')
          var nom = button.data('mynom')
          var prenom = button.data('myprenom')
          var modal = $(this)
  
          modal.find('.modal-header #type').html(type);
          modal.find('.modal-header #nom').html(nom);
          modal.find('.modal-header #prenom').html(prenom);
          modal.find('.modal-body #date_reception').val(date_reception);
          modal.find('.modal-body #date_remise_ra').val(date_remise);
          modal.find('.modal-body #date_traitement').val(date_traitement);
          modal.find('.modal-body #date_visa_ce').val(date_visa_ce);
          modal.find('.modal-body #date_visa_cser').val(date_visa_cser);
          modal.find('.modal-body #date_visa_sdap').val(date_visa_sdap);
          modal.find('.modal-body #date_visa_darh').val(date_visa_darh);
          modal.find('.modal-body #date_visa_dcrh').val(date_visa_dcrh);
          modal.find('.modal-body #date_visa_sg').val(date_visa_sg);
          modal.find('.modal-body #date_visa_dg').val(date_visa_dg);
          modal.find('.modal-body #dde_id').val(dde_id);
      })
  </script>
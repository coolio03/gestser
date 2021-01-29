@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> <i class="nav-icon fas fa-file"></i>&nbsp;Demandes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href=" {{route('admin')}} ">Acceuil</a></li>
                <li class="breadcrumb-item active">Listes des Demandes Non Traitees</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
  <!-- /.content-header -->
      <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            @if ($message = Session::get('success'))
            <div class="alert alert-success  ">
                <p> 
                    {{$message}}  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </p>
            </div>
            @endif
        <div class="card">
        
        <div class="card-body">
            <div class="row">
                
                <div class="col-sm-6">
                
                    <form action="/search" method="post" role="search" style="text-align: right">
                        {{csrf_field()}}
                        <div class="input-group">
                            <input type="text" class="form-control text" name="q" placeholder="Rechercher les demandes"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <span class="fas fa-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            </div>
           
            <table id="example1" class="table table-bordered table-striped">
                <tr>
                    <th>#</th>
                    <th>N* Dossier</th>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Type de demande</th>
                    <th>Motif demande</th>
                    <th>Date de demande</th>
                    <th>Responsable Traitement</th>
                    <th>Statut</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                </tr {{$i=1}}>
                @if (count($demandes))
                    @foreach ($demandes as $dde)
                       
                        <tr>              
                            <td> {{$i++}} </td>
                            <td> {{$dde->numero_dossier}} </td>
                            <td> {{$dde->collaborateur->matricule}}</td>
                            <td> {{$dde->collaborateur->nom}} </td>
                            <td>{{$dde->collaborateur->prenoms}} </td>
                            <td> {{$dde->type}} </td>
                            <td> {{$dde->motif_demande}} </td>
                            <td> {{date('d/m/Y',strtotime($dde->date_reception))}} </td>
                            <td>
                                @if ($dde->responsable_id == null)
                                    Pas encore Affecté
                                @else 
                                    {{$dde->user->name}}
                                @endif
                            </td>
                            <td  @if ($dde->date_traitement == null))
                                style="background-color: gray"
                            @else
                                style="background-color: green"
                            @endif> 
                                @if ($dde->date_traitement == false)
                                    Non Traite
                                @else 
                                    Traite
                                @endif
                                /
                                @if ($dde->statut == false)
                                    En Cours
                                @else 
                                    Complet
                                @endif    
                            </td>
    
                            <td> 
                                <a href=" {{route('admin')}} " class="btn btn-info" title="Modifier la demande de {{$dde->collaborateur->nom.' '. $dde->collaborateur->prenoms}}"> <i class="nav-icon fas fa-edit"></i></a>
                               &nbsp; 
                                @if (!$dde->responsable_id == null)
                                    <button class="btn btn-success" data-mydatereception="{{$dde->date_reception}}" data-mydateremise="{{$dde->date_remise_ra}}" data-mydatetraitement="{{$dde->date_traitement}}" 
                                        data-mydatevisace="{{$dde->date_visa_ce}}" data-mydatevisacser="{{$dde->date_visa_cser}}" data-mydatevisasdap="{{$dde->date_visa_sdap}}" data-mydatevisadarh="{{$dde->date_visa_darh}}" 
                                        data-mydatevisadcrh="{{$dde->date_visa_dcrh}}" data-mydatevisasg="{{$dde->date_visa_sg}}" data-mydatevisadg="{{$dde->date_visa_dg}}" data-ddeid={{$dde->id}} 
                                        data-mytype=" {{$dde->type}} "  data-mynom= " {{$dde->collaborateur->nom}} " data-myprenom= " {{$dde->collaborateur->prenoms}} " data-toggle="modal" data-target="#suivre"><i class="nav-icon fas fa-chart-pie"></i>
                                    </button>     
                                @else 
                                    <a href="  {{route('affectation', $dde->id)}} "  class="btn btn-success" title="Affectation de la demande de {{$dde->collaborateur->nom.' '. $dde->collaborateur->prenoms}}"> <i class="nav-icon fas fa-angle-right"></i></a>     
                                @endif
                                &nbsp; <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger"  title="Supprimer la demande de {{$dde->type}}"><i class="nav-icon fas fa-trash"></i></a>
                                <form action="{{route('admin.demandes.destroy', $dde->id)}}" method="POST">
                                    @method('DELETE')
                                    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                                </form>
                            </td>
                        </tr>
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
                                               
                                                @if ($dde->date_reception==null)
                                                    @include('partials.form-group',[
                                                        'title'=>__('Date reception'),
                                                        'type'=>'date',
                                                        'name'=>'date_reception',
                                                        'required'=>false
                                                    ])
                                                @else
                                                    @include('partials.form-group-d',[
                                                        'title'=>__('Date reception'),
                                                        'type'=>'date',
                                                        'name'=>'date_reception',
                                                        'value'=>$demande->date_reception,
                                                        'required'=>false
                                                    ])
                                                @endif
                                                    
                                                
                                                @if ($dde->date_remise_ra==null)
                                                    @include('partials.form-group',[
                                                        'title'=>__('Date de remise RA'),
                                                        'type'=>'date',
                                                        'name'=>'date_remise_ra',
                                                        'required'=>false,
                                                    ])
                                                @else
                                                    @include('partials.form-group-d',[
                                                        'title'=>__('Date de remise RA'),
                                                        'type'=>'date',
                                                        'name'=>'date_remise_ra',
                                                        'required'=>false,
                                                    ])
                                                @endif     
                                            
                                                @if ($dde->date_traitement==null)
                                                    @include('partials.form-group',[
                                                        'title'=>__('Date de traitement'),
                                                        'type'=>'date',
                                                        'name'=>'date_traitement',
                                                        'required'=>false
                                                    ])
                                                @else 
                                                    @include('partials.form-group-d',[
                                                        'title'=>__('Date de traitement'),
                                                        'type'=>'date',
                                                        'name'=>'date_traitement',
                                                        'required'=>false
                                                    ])
                                                @endif
                                                @if (!empty($dde->date_traitement))
                                                    @if (!empty($dde->date_visa_ce))
                                                        @include('partials.form-group',[
                                                            'title'=>__('Date de Visa CE'),
                                                            'type'=>'date',
                                                            'name'=>'date_visa_ce',
                                                            'required'=>false
                                                        ])
                                                    @else 
                                                        @include('partials.form-group-d',[
                                                            'title'=>__('Date de Visa CE'),
                                                            'type'=>'date',
                                                            'name'=>'date_visa_ce',
                                                            'required'=>false
                                                        ])
                                                    @endif
                                                    @if (!empty($dde->date_visa_cser))
                                                        @include('partials.form-group',[
                                                            'title'=>__('Date de Visa CSER'),
                                                            'type'=>'date',
                                                            'name'=>'date_visa_cser',
                                                            'required'=>false
                                                        ])
                                                    @else
                                                        @include('partials.form-group-d',[
                                                            'title'=>__('Date de Visa CSER'),
                                                            'type'=>'date',
                                                            'name'=>'date_visa_cser',
                                                            'required'=>false
                                                        ])
                                                        
                                                    @endif
                                                    @include('partials.form-group',[
                                                        'title'=>__('Date de Visa SDAP'),
                                                        'type'=>'date',
                                                        'name'=>'date_visa_sdap',
                                                        'required'=>false
                                                    ])
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
                    
                    @endforeach 
                @else
                <tr><td colspan="12"> Pas de Demandes Trouvees</td></tr>
                @endif
            </table>
            {{$demandes->render("pagination::bootstrap-4")}}

        </div>
        </div> 
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- Modal -->

@endsection
@push('scripts')
<!--<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>-->
<script src="{{asset('js/app.js')}}"></script>

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

@endpush
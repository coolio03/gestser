@extends('layouts.respo')
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
                <li class="breadcrumb-item"><a href=" {{route('home')}} ">Acceuil</a></li>
                <li class="breadcrumb-item active">Listes des Demandes</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
  <!-- /.content-header -->
      <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="example1" class="table table-bordered table-striped">
                <tr>
                    <th>#</th>
                    <th>N* Dossier</th>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Type de demande</th>
                    <th>Date de remise RA</th>
                    <th>Date de traitement</th>
                    <th>Delai traitement</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Statut&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

                </tr {{$i=1}}>
                @if (count($demandes))
                    @foreach ($demandes as $dde)
                       
                        <tr>              
                            <td> {{$i++}} </td>
                            <td> {{$dde->numero_dossier}}</td>
                            <td> {{$dde->collaborateur->matricule}}</td>
                            <td> {{$dde->collaborateur->nom}} </td>
                            <td>{{$dde->collaborateur->prenoms}} </td>
                            <td> {{$dde->type}} </td>
                            <td> {{date('d/m/Y',strtotime($dde->date_remise_ra))}} </td>
                            <td>
                                @if (!$dde->date_traitement == null)
                                    {{date('d/m/Y',strtotime($dde->date_traitement))}} 
                                @else 
                                    
                                @endif 
                            </td>
                            <td>
                                {{$delai = new DateTime($dde->date_remise_ra)->diff(new DateTime($dde->date_traitement))}}
                            </td>
                            <td  @if ($dde->date_traitement == null))
                                style="background-color: silver"
                            @else
                                style="background-color: lime"
                            @endif> 
                                @if (empty($dde->date_traitement))
                                    Non traite
                                @else 
                                    Traite
                                @endif /
                                 @if (empty($dde->date_saisir_hr))
                                    Non saisie
                                @else 
                                    Saisie
                                @endif    
                            </td>
    
                            <td>
                               
                                <button class="btn btn-success" data-mydatereception="{{$dde->date_reception}}" data-mydateremise="{{$dde->date_remise_ra}}" data-mydatetraitement="{{$dde->date_traitement}}" 
                                    data-ddeid={{$dde->id}} data-mytype=" {{$dde->type}} "  data-mynom= " {{$dde->collaborateur->nom}} " data-myprenom= " {{$dde->collaborateur->prenoms}} " data-toggle="modal" data-target="#traite" >
                                    <i title="Voir Detail de la demande de {{$dde->collaborateur->nom.' '. $dde->collaborateur->prenoms}}" class="nav-icon fas fa-eye"></i>
                                </button>
                                &nbsp;
                                <a class="btn btn-success" data-toggle="modal" id="signeButton"  class="btn btn-success" data-target="#signeModal" data-attr="{{ route('signalTraiter', $dde->id) }}" title="Continuer le suivie ">
                                    <i class="nav-icon fas fa-chart-pie"></i> 
                                </a> 

                                
                            </td>
                        </tr>
                        <div class="modal fade" id="traite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Detail de la demande de <span style="color: blue" id="type" ></span> de <span style="color: blue" id="nom"></span>&nbsp; <span style="color: blue" id="prenom"></span> </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                        
                                <form action=" {{route('traiter', $dde->id)}}" method="post">
                                    <div class="modal-body">
                                            <input type="hidden" name="id" id="dde_id" value="">
                                            <div class="row">                                               
                                                @include('partials.form-group-d',[
                                                    'title'=>__('Date reception'),
                                                    'type'=>'date',
                                                    'name'=>'date_reception',
                                                    'required'=>false
                                                ])
                                                 @include('partials.form-group-d',[
                                                    'title'=>__('Date de remise RA'),
                                                    'type'=>'date',
                                                    'name'=>'date_remise_ra',
                                                    'required'=>false,
                                                ])       
                                                @include('partials.form-group-d',[
                                                    'title'=>__('Date de traitement'),
                                                    'type'=>'date',
                                                    'name'=>'date_traitement',
                                                    'required'=>false
                                                ])
                                                @include('partials.form-group-d',[
                                                    'title'=>__('Date de Saisie dan HR'),
                                                    'type'=>'date',
                                                    'name'=>'date_saisir_hr',
                                                    'required'=>false
                                                ]) 
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
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <div class="modal fade" id="signeModal" tabindex="-1" role="dialog" aria-labelledby="signeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="signeContent" >
            
                
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<!--<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
<script>
     $(document).on('click', '#signeButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#signeModal').modal("show");
                    $('#signeContent').html(result).show();
                    
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
        $(document).on('click', '#consulterButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#consulterModal').modal("show");
                    $('#consulterContent').html(result).show();
                    
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
        $('#traite').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var date_reception = button.data('mydatereception') 
        var date_remise = button.data('mydateremise') 
        var date_traitement = button.data('mydatetraitement') 
        var date_visa_ce = button.data('mydatevisace');
        var date_visa_cser = button.data('mydatevisacser')
        var date_vsa_sdap = button.data('mydatevisasdap')
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
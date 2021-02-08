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
            
            @if ($message = Session::get('success'))
            <div class="alert alert-success  ">
                <p> 
                    {{$message}}  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </p>
            </div>
            @endif
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <form action="/search " method="get" role="search" style="text-align: right">
                        {{csrf_field()}}
                        <div class="input-group">
                            <input type="search" class="form-control text" name="search" placeholder="Rechercher Demandes"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <span class="fas fa-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        
        <div class="card-body"> 
            <p>
                <a href="# " class="btn btn-primary"><i class="nav-icon fas fa-plus"></i>&nbsp;&nbsp;Ajouter une demande</a>
            </p>
            <table id="example1" class="table table-bordered table-striped">
                <tr>
                    <th>#</th>
                    <th>N* Dossier</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Type de demande</th>
                    <th>Direction</th>
                    <th>Date de demande</th>
                    <th>Responsable Traitement</th>
                    <th>Statut</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actions&nbsp;&nbsp;&nbsp;&nbsp;</th>
                </tr {{$i=1}}>
                @if (count($demandes))
                    @foreach ($demandes as $dde)
                       
                        <tr>              
                            <td> {{$i++}} </td>
                            <td> {{$dde->numero_dossier}} </td>
                            <td> {{$dde->collaborateur->nom}} </td>
                            <td>{{$dde->collaborateur->prenoms}} </td>
                            <td> {{$dde->type}} </td>
                            <td> {{$dde->direction}} </td>
                            <td> {{date('d/m/Y',strtotime($dde->date_reception))}} </td>
                            <td>
                                @if ($dde->responsable_id == null)
                                    Pas encore Affecté
                                @else 
                                    {{$dde->user->name}}
                                @endif
                            </td>
                            <td @if ($dde->status == false)
                                style="background-color: silver"
                            @else
                                style="background-color: lime"
                            @endif> 
                                @if ($dde->status == false)
                                    En Cours
                                @else 
                                    Validé
                                @endif    
                            </td>
    
                            <td> 
                                @if (!isset($dde->date_traitement))
                                    <a href=" {{route('admin.demandes.edit', $dde->id)}} " class="btn btn-info" title="Modifier la demande de {{$dde->collaborateur->nom.' '. $dde->collaborateur->prenoms}}"> <i class="nav-icon fas fa-edit"></i></a>

                                @else
                                    <a class="btn btn-info" data-toggle="modal" id="consulterButton"  class="btn btn-success" data-target="#consulterModal" data-attr="{{ route('detailVisa', $dde->id) }}" title="Voir les details">
                                        <i class="nav-icon fas fa-eye"></i>
                                    </a>
                                @endif
                                @if ($dde->responsable_id != null)
                                    <a class="btn btn-success" data-toggle="modal" id="signeButton"  class="btn btn-success" data-target="#signeModal" data-attr="{{ route('suivreSigne', $dde->id) }}" title="Continuer le suivie ">
                                        <i class="nav-icon fas fa-chart-pie"></i> 
                                    </a>  
                                @else 
                                    <a href="  {{route('affectation', $dde->id)}} "  class="btn btn-success" title="Affectation de la demande de {{$dde->collaborateur->nom.' '. $dde->collaborateur->prenoms}}"> <i class="nav-icon fas fa-angle-right"></i></a>     
                                @endif
                                <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger"  title="Supprimer la demande de {{$dde->type}}"><i class="nav-icon fas fa-trash"></i></a>
                                <form action="{{route('admin.demandes.destroy', $dde->id)}}" method="POST">
                                    @method('DELETE')
                                    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                                </form>
                            </td>
                        </tr>
                    
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
    <div class="modal fade" id="signeModal" tabindex="-1" role="dialog" aria-labelledby="signeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="signeContent" >
            
                
            </div>
        </div>
    </div>

    <div class="modal fade" id="consulterModal" tabindex="-1" role="dialog" aria-labelledby="consulterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="consulterContent" >
            
                
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
</script>

@endpush
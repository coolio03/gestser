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
                    <th>Documents à rediger</th>
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
                            <td>
                               @if ($dde->type == "STAGE ECOLE" or $dde->type == "STAGE QUALIFICATION" or $dde->type == "STAGE IMMERSION")
                               <a class="btn btn-warning" data-toggle="modal" id="redigeButton"  class="btn btn-success" data-target="#redigeModal" data-attr="{{ route('attestationStage', $dde->id) }}" title="Attestation de stage ">
                                    <i class="nav-icon fas fa-file"></i>
                                </a>&nbsp;
                                <a class="btn btn-success" data-toggle="modal" id="redigeButton"  class="btn btn-success" data-target="#redigeModal" data-attr=" {{route('noteStage', $dde->id)}} " title="Note de stage ">
                                    <i class="nav-icon fas fa-file"></i>
                                </a>
                               @endif
                               @if ($dde->type == "EMBAUCHE A L ESSAI")
                               <a class="btn btn-warning" data-toggle="modal" id="redigeButton"  class="btn btn-success" data-target="#redigeModal" data-attr="{{route('noteEmbauche', $dde->id)}} " title="Note d'information embauche">
                                    <i class="nav-icon fas fa-file"></i>
                                </a>&nbsp;
                                <a class="btn btn-success" data-toggle="modal" id="redigeButton"  class="btn btn-success" data-target="#redigeModal" data-attr=" {{route('reglementInterieur', $dde->id)}} " title="Fiche d'attribution de Reglement Interieur">
                                    <i class="nav-icon fas fa-file"></i>
                                </a>&nbsp;
                                <a class="btn btn-success" data-toggle="modal" id="redigeButton"  class="btn btn-success" data-target="#redigeModal" data-attr=" {{route('contratEmbauche', $dde->id)}} " title="Contrat Embauche a l'essai ">
                                    <i class="nav-icon fas fa-file"></i>
                                </a>&nbsp;
                                <a class="btn btn-success" data-toggle="modal" id="redigeButton"  class="btn btn-success" data-target="#redigeModal" data-attr=" {{route('renouvellementEmbEssai', $dde->id)}} " title="Lettre renouvellement periode essai ">
                                    <i class="nav-icon fas fa-file"></i>
                                </a>
                               @endif

                               @if ($dde->type == "CDI")
                                    <a class="btn btn-warning" data-toggle="modal" id="redigeButton"  class="btn btn-success" data-target="#redigeModal" data-attr="{{route('noteEmbauche', $dde->id)}} " title="Note d'information embauche">
                                        <i class="nav-icon fas fa-file"></i>
                                    </a>&nbsp;
                                    <a class="btn btn-success" data-toggle="modal" id="redigeButton"  class="btn btn-success" data-target="#redigeModal" data-attr=" {{route('reglementInterieur', $dde->id)}} " title="Fiche d'attribution de Reglement Interieur">
                                        <i class="nav-icon fas fa-file"></i>
                                    </a>&nbsp;
                                    <a class="btn btn-success" data-toggle="modal" id="redigeButton"  class="btn btn-success" data-target="#redigeModal" data-attr=" {{route('contratCDI', $dde->id)}} " title="Contrat Embauche CDI">
                                        <i class="nav-icon fas fa-file"></i>
                                    </a>&nbsp;
                                    <a class="btn btn-success" data-toggle="modal" id="redigeButton"  class="btn btn-success" data-target="#redigeModal" data-attr=" {{route('renouvellementEmbEssai', $dde->id)}} " title="Lettre renouvellement periode essai ">
                                        <i class="nav-icon fas fa-file"></i>
                                    </a>
                                    <a class="btn btn-success" data-toggle="modal" id="redigeButton"  class="btn btn-success" data-target="#redigeModal" data-attr=" {{route('titularisation',$dde->id)}} " title="Avis de Titularisation">
                                        <i class="nav-icon fas fa-file"></i>
                                    </a>
                                    <a class="btn btn-success" data-toggle="modal" id="redigeButton"  class="btn btn-success" data-target="#redigeModal" data-attr=" {{route('avisTitularisation', $dde->id)}} " title="Titularisation">
                                        <i class="nav-icon fas fa-file"></i>
                                    </a>
                               @endif

                                
                            </td>
                        </tr>
                        
                    @endforeach 
                @else
                <tr><td colspan="12"> Pas de Demandes Trouvees</td></tr>
                @endif
            </table>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
     <!-- Modal -->
     <div class="modal fade" id="redigeModal" tabindex="-1" role="dialog" aria-labelledby="redigeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="redigeContent" >
            
                
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
<script>
     $(document).on('click', '#redigeButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#redigeModal').modal("show");
                    $('#redigeContent').html(result).show();
                    
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
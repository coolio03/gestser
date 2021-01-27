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
                <li class="breadcrumb-item"><a href=" {{route('home')}} ">Acceuil</a></li>
                <li class="breadcrumb-item active">Listes des Demandes Non Affectées</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
  <!-- /.content-header -->
      <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">     
                <div class="card-header">
                    <div class="card-tools">
                        <form action="/search" method="post" role="search" style="text-align: right">
                            {{csrf_field()}}
                            <div class="input-group">
                                <input type="text" class="form-control text" name="q" placeholder="Rechercher collaborateurs"> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        <span class="fas fa-search"></span>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>  
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <tr>
                            <th>#</th>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prénoms</th>
                            <th>Type de demande</th>
                            <th>Motif demande</th>
                            <th>Date de demande</th>
                            <th>Responsable Traitement</th>
                            <th>Statut</th>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

                        </tr {{$i=1}}>
                        @if (count($demandes))
                            @foreach ($demandes as $dde)
                            
                                <tr>              
                                    <td> {{$i++}} </td>
                                    <td> {{$dde->collaborateur->matricule}}</td>
                                    <td> {{$dde->collaborateur->nom}} </td>
                                    <td>{{$dde->collaborateur->prenoms}} </td>
                                    <td> {{$dde->type}} </td>
                                    <td> {{$dde->motif_demande}} </td>
                                    <td> {{$dde->date_reception}} </td>
                                    <td>
                                        @if ($dde->responsable_id == null)
                                            Pas encore Affecté
                                        @else 
                                            {{$dde->user->name}}
                                        @endif
                                    </td>
                                    <td> 
                                        @if ($dde->statut == false)
                                            En Cours
                                        @else 
                                            Validé
                                        @endif    
                                    </td>
            
                                    <td> 
                                        <a href=" # " class="btn btn-info"> <i class="nav-icon fas fa-edit"></i></a>
                                    &nbsp; <a href="  {{route('affectation', $dde->id)}} " class="btn btn-success" ho> <i class="nav-icon fas fa-angle-right"></i></a>  
                                        &nbsp; <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></a>
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
                    <!-- /.row (main row) -->
                    {{$demandes->render("pagination::bootstrap-4")}}
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

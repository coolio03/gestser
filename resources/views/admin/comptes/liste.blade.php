@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> <i class="nav-icon fas fa-file"></i>&nbsp;Comptes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href=" {{route('admin')}} ">Acceuil</a></li>
                <li class="breadcrumb-item active">Listes des comptes</li>
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
                    {{ $message}}  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </p>
            </div>
            @endif
        <div class="card">
            <p>
                <a href=" {{route('admin.comptes.create')}} " class="btn btn-primary"><i class="nav-icon fas fa-plus"></i>&nbsp;&nbsp;Ajouter un compte</a>
            </p>
            <a href=" {{url('admin.comptes.create')}} ">Acceuil</a>
        <div class="card-body"> 
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <h2>Liste des Comptes de Responsables Administratifs</h2>
                </thead>
                <tr>
                    <th>#</th>
                    <th>Nom et prenoms</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr {{$i=1}}>
                @if (count($users) )
                    @foreach ($users as $user)
                       
                        <tr>              
                            <td> {{$i++}} </td>
                            <td> {{$user->name}} </td>
                            <td> {{$user->email}}</td>
                            <th>@if($user->status == 0) Inactif @else Actif @endif</th>
                            <th><a href="{{ route('status', $user->id) }}">@if($user->status == 1) <small class="badge badge-danger"> Bloquer</small> @else<small class="badge badge-success">Activer</small>  @endif</a></th>
                        </tr>
                        @endforeach
                @else
                    <tr><td colspan="5"> Pas de comptes trouves</td></tr>
                @endif
            </table>  
            
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <h2>Liste des Comptes de Cadre</h2>
                </thead>
                <tr>
                    <th>#</th>
                    <th>Nom et prenoms</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr {{$i=1}}>
                @if (count($cadres) )
                    @foreach ($cadres as $cadre)
                        <tr>              
                            <td> {{$i++}} </td>
                            <td> {{$cadre->name}} </td>
                            <td> {{$cadre->email}}</td>
                            <th>@if($cadre->role == 0) Inactif @else Actif @endif</th>
                            <th><a href="{{ route('statusCadre', $cadre->id) }}">@if($cadre->role == 1) <small class="badge badge-danger"> Bloquer</small> @else<small class="badge badge-success">Activer</small>  @endif</a></th>
                        </tr>
                        @endforeach
                @else
                    <tr><td colspan="5"> Pas de comptes trouves</td></tr>
                @endif
            </table>             
        </div>
        </div> 
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- Modal -->

@endsection

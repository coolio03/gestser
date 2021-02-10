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
                <li class="breadcrumb-item active">Création de comptes</li>
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
                <div class="card-header">
                    <h3>Formulaire de creation de comptes</h3>
                </div>
        
                <div class="card-body"> 
                    <form method="post" action="">
                        <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="col-md-6">Type d'utilistateur</label>
                                    <div class="col-md-14">
                                        <select name="type_user" id="" class="form-control" required>
                                                <option value="">Choisir type</option>
                                                <option value="Responsable Adm">Responsable Adm</option>
                                                <option value="Cadre">Cadre</option>
                                                <option value="Admin">Administrateur</option>                                                                       
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            @include('partials.form-group',[
                            'title'=>__('Nom et prenoms'),
                            'type'=>'text',
                            'name'=>'nom',
                            'required'=>true
                            ])
                            @include('partials.form-group',[
                                'title'=>__('Email'),
                                'type'=>'text',
                                'name'=>'email',
                                'required'=>true
                            ])
                            @include('partials.form-group',[
                                'title'=>__('Mot de passe'),
                                'type'=>'password',
                                'name'=>'mot_de_passe',
                                'required'=>true
                            ])
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>  
                    </form>
            </div> 
                     

        </div>

        <!-- /.row (main row) -->
<!-- /.container-fluid -->
    </section>
    <!-- Modal -->

@endsection

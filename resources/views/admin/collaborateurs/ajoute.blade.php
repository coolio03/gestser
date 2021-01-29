@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <i class="nav-icon fas fa-users"></i>Collaborateurs</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{route('admin')}} ">Acceuil</a></li>
            <li class="breadcrumb-item active">Ajouter Collaborateurs</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
  <!-- /.content-header -->
      <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Formulaire d'ajout de collaborateurs</h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <form method="post" action=" {{route('admin.collaborateurs.store')}} ">
                  <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                  <input type="hidden" name="cadre_id" value=" {{ Auth::user()->id }} ">
                    
                  <div class="row">
                    @include('partials.form-group',[
                      'title'=>__('Matricule'),
                      'type'=>'text',
                      'name'=>'matricule',
                      'required'=>true
                    ])
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="" class="col-md-6">Civilité</label>
                          <div class="col-md-14">
                              <select name="civilite" id="" class="form-control">
                                      <option value="">Choisir civilité</option>
                                      <option value="Monsieur">Monsieur</option>
                                      <option value="Madame">Madame</option>
                                      <option value="Mademoiselle">Mademoiselle</option>                                                                       
                              </select>
                          </div>
                          <div class="clearfix"></div>
                      </div>
                  </div>
                    @include('partials.form-group',[
                        'title'=>__('Nom'),
                        'type'=>'text',
                        'name'=>'nom',
                        'required'=>true
                    ]) 
                    @include('partials.form-group',[
                        'title'=>__('Prénoms'),
                        'type'=>'text',
                        'name'=>'prenoms',
                        'required'=>true
                    ]) 
                    @include('partials.form-group',[
                      'title'=>__('Date de naisssance'),
                      'type'=>'date',
                      'name'=>'date_de_naissance',
                      'required'=>true
                    ]) 
                    @include('partials.form-group',[
                      'title'=>__('Lieu de Naissance'),
                      'type'=>'text',
                      'name'=>'lieu_de_naissance',
                      'required'=>true
                    ]) 
                    @include('partials.form-group',[
                      'title'=>__('Ancienne Fonction'),
                      'type'=>'text',
                      'name'=>'ancienne_fonction',
                      'required'=>true
                    ])
                    @include('partials.form-group',[
                      'title'=>__('Nouvelle Fonction'),
                      'type'=>'text',
                      'name'=>'nouvelle_fonction',
                      'required'=>true
                    ])
                    @include('partials.form-group',[
                      'title'=>__('Catégorie'),
                      'type'=>'text',
                      'name'=>'categorie',
                      'required'=>true
                    ])
                    @include('partials.form-group',[
                      'title'=>__('Contacts'),
                      'type'=>'text',
                      'name'=>'contact',
                      'required'=>true
                    ])
                  </div>          
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</section>
@endsection


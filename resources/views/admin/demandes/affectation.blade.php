@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <i class="nav-icon fas fa-users"></i>Demandes</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{route('admin')}} ">Acceuil</a></li>
            <li class="breadcrumb-item active">Ajouter Demandes</li>
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
                <h3 class="card-title">Affectation de la demande de {{$demande->type}} du collaborateur {{$demande->collaborateur->nom.' '. $demande->collaborateur->prenoms}} </h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <form method="post" action=" {{route('affecter', $demande->id)}} ">
                     @method('PUT')
                  <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                  <input type="hidden" name="cadre_id" value=" {{ Auth::user()->id }} ">
                    @include('partials.form-group-d',[
                      'title'=>__('Matricule'),
                      'type'=>'text',
                      'name'=>'matricule',
                      'value'=>$demande->collaborateur->matricule,
                      'required'=>true, 
                    ])   
                    @include('partials.form-group-d',[
                        'title'=>__('Nom'),
                        'type'=>'text',
                        'name'=>'nom',
                      'value'=>$demande->collaborateur->nom,
                        'required'=>true
                    ])
                    <div class="row">   
                      @include('partials.form-group-d',[
                          'title'=>__('Prénoms'),
                          'type'=>'text',
                          'name'=>'prenoms',
                        'value'=>$demande->collaborateur->prenoms,
                          'required'=>true
                      ])                  
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="" class="col-md-6">Responsable de Traitement</label>
                              <div class="col-md-14">
                                  <select name="responsable_id" id="" class="form-control">
                                          <option value="">Choisir Responsable</option>
                                          @foreach ($users as $user)
                                              <option value="{{$user->id}} " class="">{{$user->name}}</option>
                                                                      
                                          @endforeach                                    
                                  </select>
                              </div>
                              <div class="clearfix"></div>
                          </div>
                      </div>
                    </div>
                  </div>   
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                  </div>       
                </div>
                <!-- /.card-body -->
               
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


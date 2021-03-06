@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <i class="nav-icon fas fa-file"></i>Demandes</h1>
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
                <h3 class="card-title">Formulaire de demandes</h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <form method="post" action=" {{route('admin.demandes.update',$demande->id)}} ">
                    @method('PUT')
                  <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                  <input type="hidden" name="cadre_id" value=" {{ Auth::user()->id }} ">
                  @include('partials.form-group',[
                    'title'=>__('Direction'),
                    'type'=>'text',
                    'name'=>'direction',
                    'value'=>$demande->direction,
                    'required'=>true
                  ])
                    @include('partials.form-group',[
                      'title'=>__('Matricule'),
                      'type'=>'text',
                      'name'=>'matricule',
                      'value'=>$demande->collaborateur->matricule,
                      'required'=>true
                    ])
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="" >Type de demande</label>
                          <select name="type" id="" class="form-control">
                              <option value="">Choisir type</option>
                              <option value="STAGE ECOLE">STAGE ECOLE</option>
                              <option value="STAGE IMMERSION">STAGE IMMERSION</option>
                              <option value="STAGE QUALIFICATION">STAGE QUALIFICATION</option>
                              <option value="CDD">CDD</option>
                              <option value="CDI">CDI</option>
                              <option value="EMBAUCHE A L ESSAI">EMBAUCHE A L'ESSAI</option>
                              <option value="CONSULTANCE">CONSULTANCE</option>
                              <option value="PROROGATION">PROROGATION</option>
                              <option value="PROMOTION">PROMOTION</option>
                              <option value="NOMINATION">NOMINATION</option>
                              <option value="RECLASSEMENT">RECLASSEMENT</option>
                              <option value="RECLAMATION">RECLAMATION</option>                                      
                          </select>
                      </div>
                          <div class="clearfix"></div>
                    </div>
                    @include('partials.form-group',[
                        'title'=>__('Motif de la demande'),
                        'type'=>'text',
                        'name'=>'motif_demande',
                      'value'=>$demande->motif_demande,
                        'required'=>true
                    ]) 
                     @include('partials.form-group',[
                      'title'=>__('Date de debut'),
                      'type'=>'date',
                      'name'=>'date_debut',
                      'value'=>$demande->date_debut,
                      'required'=>false
                    ]) 
                    @include('partials.form-group',[
                      'title'=>__('Date de Fin'),
                      'type'=>'date',
                      'name'=>'date_fin',
                      'value'=>$demande->date_fin,
                      'required'=>true
                  ]) 
                    @include('partials.form-group',[
                        'title'=>__('Date Reception'),
                        'type'=>'date',
                        'name'=>'date_reception',
                      'value'=>$demande->date_reception,
                        'required'=>true
                    ]) 
                   <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="col-md-6">Responsable de Traitement</label>
                            <div class="col-md-14">
                                <select name="responsable_id"  class="form-control">
                                        <option value="">Choisir Responsable</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}} " class="" 
                                                >{{$user->name}}</option>
                                                                    
                                        @endforeach                                    
                                </select>
                            </div>
                            <div class="clearfix"></div>
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


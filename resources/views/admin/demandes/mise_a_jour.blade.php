@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <i class="nav-icon fas fa-users"></i>Suivis des Demandes</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{route('admin')}} ">Acceuil</a></li>
            <li class="breadcrumb-item active">Mise à jour demande</li>
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
                <h3 class="card-title">Formulaire de Mise à jour Demande ( Référence Demandeur )</h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <form method="post" action=" # ">
                  <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                  <input type="hidden" name="cadre_id" value=" {{ Auth::user()->id }} ">
                  <div class="row">
                    @include('partials.form-group',[
                        'title'=>__('Matricule'),
                        'type'=>'text',
                        'name'=>'nom',
                        'required'=>true
                    ]) 
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" >Type de demande</label>
                            <select name="type" id="" class="form-control">
                                <option value="">Choisir type</option>
                                <option value="STAGE">STAGE</option>
                                <option value="CDD">CDD</option>
                                <option value="CDI">CDI</option>
                                <option value="EMBAUCHE A L ESSAI">EMBAUCHE A L'ESSAI</option>
                                <option value="CONSULTANCE">CONSULTANCE</option>
                                <option value="PROMOTION">PROMOTION</option>
                                <option value="RECLAMATION">RECLAMATION</option>                                      
                            </select>
                        </div>
                            <div class="clearfix"></div>
                    </div>
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


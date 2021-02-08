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
                <div class="row">
                    <form method="post" action=" {{route('admin.comptes.store')}} ">
                        <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                        <input type="hidden" name="cadre_id" value=" {{ Auth::user()->id }} ">
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
                        'name'=>'name',
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
                            'name'=>'password',
                            'required'=>true
                        ])
                    </form>
                </div> 
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                  </div>       

            </div>
        </div> 
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- Modal -->

@endsection
@push('scripts')
<script src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script>
    $(function() {
      $('.toggle-class').change(function() {
          var role = $(this).prop('checked') == true ? 1 : 0; 
          var cadre_id = $(this).data('id'); 
           
          $.ajax({
              type: "GET",
              dataType: "json",
              url: '/updateStatus',
              data: {'role': role, 'id': cadre_id},
              success: function(data){
                console.log(data.success)
              }
          });
      })
    })
  </script>
  

@endpush
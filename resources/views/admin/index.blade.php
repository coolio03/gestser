@extends('layouts.admin')
@section('css')
{!! Charts::styles() !!}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <i class="ion ion-home"></i>Acceuil</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{route('home')}} ">Acceuil</a></li>
            <li class="breadcrumb-item active">Tableau de Bord</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
    
      <div class="row">
        <div class="col-3">
          <div class="card ">
              <div class="card-body py-6 px-6">
                {!! $traitement->html() !!}
              </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card rounded">
              <div class="card-body py-6 px-6">
                {!! $signature->html() !!}
              </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card rounded">
              <div class="card-body py-6 px-6">
                {!! $cloture->html() !!}
              </div>
          </div>
        </div>
        
        <div class="col-3" >
          <div class="card rounded">
              <div class="card-header">
                <h3 style="text-align: center">Bilan Du Suivies</h2>
              </div>
              <div class="card-body py-3 px-3">
                    <div></div>
                    <div> <h6>Traitements</h6></div>
                    <div style="margin-left: 5%">
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href="{{route('admin.demandes.index')}}">Demandes Enregistrées :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{count($demandes)}}</span>
                      </div>
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href="{{route('traites')}}">Demandes Traitées :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{ count($demandes->where('date_traitement','<>',Null)) }} </span> 
                      </div>
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href="{{route('non_traites')}}">Demandes Non Traitées :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{ count($demandes->where('date_traitement','=',Null)) }} </span> 
                      </div>
                    </div>
                    <div> <h6>Circuit de signature</h6></div>
                    <div style="margin-left: 5%">
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href="{{route('visa')}}">Demandes En visa :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;<span>{{count($demandes->where('visa',false)->where('date_traitement','<>',Null))}}</span>
                      </div>
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href="{{route('signe')}}">Demandes Signées :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{count($demandes->where('visa',True)->where('date_traitement','<>',Null))}}</span> 
                      </div>
                    </div>
                    <div> <h6>Validation de demandes</h6></div>
                    <div style="margin-left: 5%">
                      
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href=" {{route('non_cloture')}} ">Demandes non Cloturées :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{count($demandes->where('visa',True)->where('date_cloture','=',Null))}}</span> 
                      </div>
                      
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href=" {{route('non_transmisClient')}} ">Demandes non Transmises :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{count($demandes->where('visa',true)->where('date_transmission','=',Null))}}</span> 
                      </div>
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href=" {{route('non_saisieHr')}} ">Demandes Non Saisies :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{count($demandes->where('visa',true)->where('date_saisir_hr','=',Null))}}</span> 
                      </div>
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href=" {{route('non_archive')}} ">Demandes Non Archivées :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{count($demandes->where('date_archive','=',Null)->->where('visa',true))}}</span> 
                      </div>
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href=" {{route('complet')}} ">Demandes Completes :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{count($demandes->where('status',true))}}</span> 
                      </div>
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href=" {{route('non_complet')}} ">Demandes Non Completes :</a>&nbsp;&nbsp;&nbsp;&nbsp;<span>{{count($demandes->where('status',false))}}</span> 
                      </div>
                    </div>
              </div>
          </div>
        </div>
      </div>
      <!-- /.row (main row) -->
      <div class="row">
        <div class="col-3">
          <div class="card rounded">
              <div class="card-body py-6 px-6">
                {!! $transmission->html() !!}
              </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card rounded">
              <div class="card-body py-6 px-6">
                {!! $saisie->html() !!} 
              </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card rounded">
              <div class="card-body py-6 px-6" >
                {!! $archive->html() !!}
              </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card rounded">
              <div class="card-body py-6 px-6">
                {!! $complet->html() !!}
              </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card rounded">
              <div class="card-body py-6 px-6">
                {!! $ddeRa->html() !!}
              </div>
          </div>
        </div>
      </div>
      
      
    </div><!-- /.container-fluid -->
  </section>
  {!! Charts::scripts() !!}
  {!! $traitement->script() !!}
  {!! $signature->script() !!}
  {!! $cloture->script() !!}
  {!! $transmission->script() !!}
  {!! $saisie->script() !!}
  {!! $archive->script() !!}
  {!! $complet->script() !!}
  {!! $ddeRa->script() !!}
@endsection
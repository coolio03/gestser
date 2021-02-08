@extends('layouts.respo')
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
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
              <div class="card ">
                  <div class="card-body py-6 px-6">
                    {!! $traitement->html() !!}
                  </div>
              </div>
            </div>
            <div class="col-6">
              <div class="card ">
                  <div class="card-header">
                    <h4 style="text-align: center">Bilan Du Traitement</h4>
                  </div>
                  <div class="card-body py-6 px-6">
                    <div> <h6>Traitements</h6></div>
                    <div style="margin-left: 5%">
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href="{{route('admin.demandes.index')}}">Demandes Reçus :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{count($demandes->where('responsable_id',Auth::user()->id)->where('date_remise_ra','<>',null))}}</span>
                      </div>
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href="{{route('traites')}}">Demandes Traitées :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{ count($demandes->where('responsable_id',Auth::user()->id)->where('date_traitement','<>',Null)) }} </span> 
                      </div>
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href="{{route('non_traites')}}">Demande Non Traitées :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{ count($demandes->where('responsable_id',Auth::user()->id)->where('date_traitement','=',Null)) }} </span> 
                      </div>
                    </div>
                    <div> <h6>Saisie Hra</h6></div>
                    <div style="margin-left: 5%">
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href="{{route('admin.demandes.index')}}">Demandes Saisies :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{count($demandes->where('responsable_id',Auth::user()->id)->where('date_saisir_hr','<>',null))}}</span>
                      </div>
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href="{{route('traites')}}">Demandes Non Saisies :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{ count($demandes->where('responsable_id',Auth::user()->id)->where('date_saisir_hr',null)) }} </span> 
                      </div>
                    </div>
                    <div> <h6>Archivage</h6></div>
                    <div style="margin-left: 5%">
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href="{{route('admin.demandes.index')}}">Demandes Archivées :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{count($demandes->where('responsable_id',Auth::user()->id)->where('date_archive','<>',null))}}</span>
                      </div>
                      <div>
                        <i class="nav-icon fas fa-file"></i>&nbsp;<a href="{{route('traites')}}">Demandes Non Archivées :</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{ count($demandes->where('responsable_id',Auth::user()->id)->where('date_archive','=',null)) }} </span> 
                      </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="card rounded">
                <div class="card-body py-6 px-6">
                  {!! $saisie->html() !!} 
                </div>
            </div>
          </div>
            <div class="col-6">
              <div class="card rounded">
                  <div class="card-body py-6 px-6">
                    {!! $archive->html() !!} 
                  </div>
              </div>
            </div>
        </div>
    </div>
</section>
{!! Charts::scripts() !!}
{!! $traitement->script() !!}
{!! $saisie->script() !!}
{!! $archive->script() !!}
@endsection

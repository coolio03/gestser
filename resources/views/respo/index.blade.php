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
                <div class="card rounded">
                    <div class="card-body py-6 px-6">
                      {!! $saisie->html() !!} 
                    </div>
                </div>
              </div>
        </div>
    </div>
</section>
{!! Charts::scripts() !!}
{!! $traitement->script() !!}
{!! $saisie->script() !!}
@endsection

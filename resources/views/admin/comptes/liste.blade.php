@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> <i class="nav-icon fas fa-file"></i>&nbsp;Demandes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href=" {{route('admin')}} ">Acceuil</a></li>
                <li class="breadcrumb-item active">Listes des Demandes</li>
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
                    {{$message}}  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </p>
            </div>
            @endif
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <form action="/search " method="get" role="search" style="text-align: right">
                        {{csrf_field()}}
                        <div class="input-group">
                            <input type="search" class="form-control text" name="search" placeholder="Rechercher Demandes"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <span class="fas fa-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        
        <div class="card-body"> 
            <p>
                <a href=" {{route('admin.demandes.create')}} " class="btn btn-primary"><i class="nav-icon fas fa-plus"></i>&nbsp;&nbsp;Ajouter une demande</a>
            </p>
          
            {{$demandes->render("pagination::bootstrap-4")}}

        </div>
        </div> 
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- Modal -->
  
@endsection
@push('scripts')
<!--<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
<script>
     $(document).on('click', '#signeButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#signeModal').modal("show");
                    $('#signeContent').html(result).show();
                    
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
        $(document).on('click', '#consulterButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#consulterModal').modal("show");
                    $('#consulterContent').html(result).show();
                    
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
</script>

@endpush
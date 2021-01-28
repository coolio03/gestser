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
                <li class="breadcrumb-item"><a href=" {{route('home')}} ">Acceuil</a></li>
                <li class="breadcrumb-item active">Listes des Collaborateurs</li>
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
            <div class="alert alert-success ">
                <p>
                    {{$message}} 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </p>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                
                        <form action="/search" method="post" role="search" style="text-align: right">
                            {{csrf_field()}}
                            <div class="input-group">
                                <input type="text" class="form-control text" name="q" placeholder="Rechercher collaborateurs"> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        <span class="fas fa-search"></span>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>Matricule</th>
                                <th>Nom</th>
                                <th>Prénoms</th>
                                <th>Date de naissance</th>
                                <th>Lieu de naissance</th>
                                <th>Ancienne Fonction</th>
                                <th>Nouvelle Fonction</th>
                                <th>Catégories</th>
                                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($collaborateurs))
                            @foreach ($collaborateurs as $collabo)
                            
                                <tr>              
                                    <td> {{$loop->index+1}} </td>
                                    <td> {{$collabo->matricule}} </td>
                                    <td> {{$collabo->nom}} </td>
                                    <td> {{$collabo->prenoms}} </td>
                                    <td> {{date('d/m/Y',strtotime($collabo->date_de_naissance))}} </td>
                                    <td> {{$collabo->lieu_de_naissance}} </td>
                                    <td> {{$collabo->ancienne_fonction}} </td>
                                    <td> {{$collabo->nouvelle_fonction}} </td>
                                    <td> {{$collabo->categorie}} </td>
                                    <td> 
                                        <a href="{{route('admin.collaborateurs.edit', $collabo->id)}}" class="btn btn-info" title="Editer Collaborateur de {{$collabo->nom.' '. $collabo->prenoms}}" > <i class="nav-icon fas fa-edit"></i>
                                        </a>
                                        &nbsp; 
                                        <a class="btn btn-success" data-toggle="modal" id="consulterButton"  class="btn btn-success" data-target="#consulterModal" data-attr="{{ route('detail', $collabo->id) }}" title="Demande(s) du Collaborateur {{$collabo->nom.' '. $collabo->prenoms}}">
                                                    <i class="nav-icon fas fa-eye"></i>
                                        </a>
                                        &nbsp;
                                        <a class="btn btn-danger" data-toggle="modal" id="supprimerButton" data-target="#supprimerModal" data-attr="{{ route('delete', $collabo->id) }}" title="Supprimer Collaborateur de {{$collabo->nom.' '. $collabo->prenoms}}">
                                            <i class="nav-icon fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="consulterModal" tabindex="-1" role="dialog" aria-labelledby="consulterModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content"  id="consulterContent">
                                           
                                             
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                            @endforeach 
                        @else
                        <tr><td colspan="12"> Pas de Collaborateurs Trouvees</td></tr>
                        @endif
                    </tbody>
                    
                    </table>                        
                </div>
               

            </div>
        <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
       {{$collaborateurs->render("pagination::bootstrap-4")}} 
        
    </section>
    

    <!-- small modal -->
<div class="modal fade" id="supprimerModal" tabindex="-1" role="dialog" aria-labelledby="supprimerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="supprimerBody">
                <div>
                    <!-- the result to be displayed apply here -->
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        // display a modal (small modal)
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
        // display a modal (small modal)
        $(document).on('click', '#supprimerButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href
                , beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#supprimerModal').modal("show");
                    $('#supprimerBody').html(result).show();
                }
                , complete: function() {
                    $('#loader').hide();
                }
                , error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                }
                , timeout: 8000
            })
        });
        $(function () {
            $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
            "paging": true,
            "searching": true,


            });
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            });
        });
    </script>

@endpush
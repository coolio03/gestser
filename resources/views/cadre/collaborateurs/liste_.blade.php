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
            <p>
                <a href=" {{route('admin.collaborateurs.create')}} " class="btn btn-primary"><i class="nav-icon fas fa-plus"></i>&nbsp;&nbsp;Ajouter un collaborateur</a>
            </p>
            @if ($message = Session::get('success'))
            <div class="alert alert-success ">
                <p>
                    {{$message}} 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </p>
            </div>
            @endif
            <table id="example1" class="table table-bordered table-striped">
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
                                <a href="{{route('admin.collaborateurs.edit', $collabo->id)}}" class="btn btn-info" title="Editer Collaborateur de {{$collabo->nom.' '. $collabo->prenoms}}" > <i class="nav-icon fas fa-edit"></i></a>
                               &nbsp;      
                                    {!! '<a id="voir" href="' . route('detail', $collabo->id). '" class="btn btn-success" role="button"><i class="nav-icon fas fa-list"></i></a>' !!}
                                
                                &nbsp; <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger" title="Supprimer Collaborateur de {{$collabo->nom.' '. $collabo->prenoms}}">
                                    <i class="nav-icon fas fa-trash"></i>
                                </a>
                                <form action="{{route('admin.collaborateurs.destroy', $collabo->id)}}" method="POST">
                                    @method('DELETE')
                                    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                                </form>
                            </td>
                        </tr>
                        
                        
                    @endforeach 
                @else
                <tr><td colspan="12"> Pas de Collaborateurs Trouvees</td></tr>
                @endif
            </table>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
        {{$collaborateurs->render()}}
        <div  id="consulterModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="consulterLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="consulterBody">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    
    <script>
        $(document).ready(() => {
            $('#voir').click(e => {
            let that = e.currentTarget;
            e.preventDefault();
            $.ajax({
                method: $(that).attr('method'),
                url: $(that).attr('href'),
                data: $(that).serialize()
            })
            .done((data) => {
                $('#detail').html(data),
                $('.modal').appendTo('body').modal('show'),
            })
            .fail((data) => {
                console.log(data),
            });
            });
        });
        
    </script>
@endpush
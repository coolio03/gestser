<?php 
                  $segment = Request::segment(2);
                ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GestSer  | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
   <!-- DataTables -->
   <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
   <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- CSS only -->
 @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="{{asset('dist/img/user.png')}}" class="user-image img-square elevation-2" alt="User Image">
        <span class="d-none d-md-inline">{{Auth::user()->name}}</span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-primary">
          <img src="{{asset('dist/img/user.png')}}" class="img-circle elevation-2" alt="User Image">

          <p>
            {{Auth::user()->name}}
            <small>Chef de Service Emploi et reglementation</small>
          </p>
        </li>
        <!-- Menu Body -->
       
        <!-- Menu Footer-->
        <li class="user-footer">
          <a href="#" class="btn btn-default btn-flat">Profile</a>
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();" class="btn btn-default btn-flat float-right">
                   <i class="nav-icon far fa-circle text-danger"></i>
          Se Déconnexion
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href=" {{ route('admin') }} " class="brand-link">
      <img src="{{asset('dist/img/cie.jpg')}}" alt="cie Logo" class="brand-image  elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">GestSer V1.0</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <div class="row">
          <img src="{{asset('dist/img/user.png')}}" class="img-square elevation-2" alt="User Image">
          <div class="info">
            <a href="" class="d-block">{{Auth::user()->name}}</a>
            <span style="color: white">(Administrateur)</span>
  
          </div>
          </div>
        </div>
        
      </div>
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <h4 style="color: white" > General</h4>
          <li class="nav-item ">
            <a href="{{route('admin')}}" class="nav-link @if(!$segment)
            active
          @endif">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Acceuil
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Comptes
              </p>
            </a>
          </li>
          <h4 style="color: white" > Menu</h4>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link @if($segment=='collaborateurs')
              active
            @endif ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Collaborateurs
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{route('admin.collaborateurs.create')}} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ajouter</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ route('admin.collaborateurs.index')}} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lister</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link @if($segment=='demandes')
            active
          @endif ">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Demandes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{route('admin.demandes.index')}} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Toutes les demandes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{route('affecte')}} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Demandes Affectées</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{route('non_affecte')}} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Demandes Non Affectées</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link @if($segment=='visa')
            active
          @endif">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Suivis des demandes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{route('visa')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Demandes En visa</p>
                </a>
              </li>
            </li>
            <li class="nav-item">
              <a href=" {{route('signe')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Demandes Signées</p>
              </a>
            </li>
          </li>
              <li class="nav-item">
                <a href=" {{route('cloture')}} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Demandes Cloturées</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{route('transmisClient')}} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Demandes Transmises</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ route('saisieHr')}} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Demandes Saisies dans HRa</p>
                </a>
              </li>
            </ul>
          </li>
         
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper col-sm-12">
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019-2020 <a href="http://adminlte.io">GestSer</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@stack('scripts')

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>

{{-- template --}}
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Proyecto') }}</title>

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<?php $idperfil = Sentry::getUser()->id_perfil; ?> 
    <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                  
                    
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Activos <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          @if($idperfil == 1 || $idperfil == 5  || $idperfil == 2 )        <!-- solo admin, ventas, compras -->
          <li><a class="dropdown-item"  href="{{ url('productos') }}">Productos</a></li>
          <li class="divider"></li>
          @endif 
          @if($idperfil == 1 || $idperfil == 3  || $idperfil == 2 )   <!-- solo admin, produccion, compras -->
          <li><a class="dropdown-item" href="{{ url('materiaprima') }}">Materia primas</a></li>
          <li class="divider"></li>
          @endif 
          @if($idperfil == 1)  <!-- solo admin -->
          <li><a class="dropdown-item" href="{{ url('categorias ') }}">Categorias</a></li>
          @endif 
          
        </ul>
      </li>
  </li>
  @if($idperfil == 1 )  <!-- solo admin -->
   <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Usuarios <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a  class="dropdown-item" href="{{ url('user') }}">Usuarios</a></li>
          <li class="divider"></li>
          <li><a class="dropdown-item" href="{{ url('perfiles') }}">Perfiles</a></li>
          
          
        </ul>
      </li>
   @endif 

    @if($idperfil == 1 || $idperfil == 5 || $idperfil == 4)  <!-- solo admin, vents y finanzas -->
     <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Ventas <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a  class="dropdown-item" href="{{ url('pedidos') }}">Lista de Pedidos</a></li>
           <li><a class="dropdown-item" href="{{ url('pedidos/create') }}">Nuevo pedido</a></li>
          
          
          
        </ul>
      </li>
   @endif 
  @if($idperfil == 1 || $idperfil == 5)  <!-- solo admin, ventas-->
  <li><a href="{{ url('clientes') }}">Clientes</a></li>
  @endif

 @if($idperfil == 1 || $idperfil == 2)  <!-- solo admin, compras-->
  <li><a href="{{ url('proveedores') }}">Proveedores</a></li>
      {{--    <li class="nav-item dropdown">
  </li> --}}
  @endif
     

 @if($idperfil == 1 || $idperfil == 3 || $idperfil == 2) <!-- solo admin, compras, produccion  p-->
     <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Inventarios <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('inventarios') }}">Inventarios</a></li>
         
          <li class="divider"></li>
          <li><a class="dropdown-item" href="{{ url('almacenes') }}">Almacenes</a></li>
          
          
        </ul>
      </li>
 @endif

@if($idperfil == 1 || $idperfil == 3) <!-- solo admin y produccion -->
   <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Producción <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item"  href="{{ url('produccion') }}">Listado de producción</a></li>
          <li class="divider"></li>
          <li><a  class="dropdown-item" href="{{ url('produccion/create') }}">Nueva orden de producción</a></li>
          <li class="divider"></li>
          <li><a  class="dropdown-item" href="{{ url('billMaterials') }}">Configuración de Bill of materials</a></li>
          
          
        </ul>
      </li> 
@endif



@if($idperfil == 1 || $idperfil == 2) <!-- solo admin y compras -->
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Compras <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ url('compras') }}">Lista de ordenes de compra</a></li>
          <li class="divider"></li>
          <li><a class="dropdown-item"  href="{{ url('compras/create') }}">Nueva Orden de compra</a></li>
          
          
        </ul>
      </li>

@endif
                    </ul>

                    <!-- Right Side Of Navbar -->

                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="#"> <i class= "fa fa-user"> </i>  {{Sentry::getUser()->first_name}}</a></li>
                             <li><a href="{{ url('/logout') }}"> <i class= "glyphicon glyphicon-log-out"> </i>  Salir</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('Tecnologias') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @if (session()->has('flash_message'))
            <div class="container">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session()->get('flash_message') }}
                </div>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->


  <!--  <script src="{{ asset('js/app.js') }}"></script>  -->
<script src="<?= env('APP_URL'); ?>/js/jquery-3.3.1.js" type="text/javascript"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

 <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

 <script> 

$(document).ready(function() {

$('.select2').select2();

})

 </script>







</body>
</html>

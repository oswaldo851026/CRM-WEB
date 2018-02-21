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
          <li><a href="{{ url('productos') }}">Productos</a></li>
          <li class="divider"></li>
          <li><a href="{{ url('materiaprima') }}">Materia prima</a></li>
          <li class="divider"></li>
          <li><a href="{{ url('categorias ') }}">Categoria</a></li>
          
          
        </ul>
      </li>
  </li>
   <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Usuarios <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('user') }}">Usuarios</a></li>
          <li class="divider"></li>
          <li><a href="{{ url('perfiles') }}">Perfiles</a></li>
          
          
        </ul>
      </li>
     <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Ventas <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('inventarios') }}">Pedidos</a></li>
          
          
          
        </ul>
      </li>
  <li><a href="{{ url('clientes') }}">Clientes</a></li>
  <li><a href="{{ url('proveedores') }}">Proveedores</a></li>
      {{--    <li class="nav-item dropdown">
  </li> --}}

     <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Inventarios <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('inventarios') }}">Inventarios</a></li>
          <li class="divider"></li>
          <li><a href="{{ url('almacen') }}">Almacenes</a></li>
          <li class="divider"></li>
          <li><a href="{{ url('movimientos') }}">Registrar Movimientos</a></li>
          
          
        </ul>
      </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          solicitud de compras <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="compras/solicitud.php">Nueva Solicitud</a></li>
          <li class="divider"></li>
          <li><a href="compras/Revisar.php">Revisar solicitudes realizadas</a></li>
          
          
        </ul>
      </li>


                    </ul>

                    <!-- Right Side Of Navbar -->

                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
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
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

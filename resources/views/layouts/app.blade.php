<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Blogs</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">--}}
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{ url('lib/css/plugins/boostrap/3.3.6/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('lib/css/plugins/datatables/dataTables.bootstrap.min.css') }}">

    <!-- Jquery UI -->
    <link rel="stylesheet" type="text/css" href="{{ url('lib/css/plugins/jquery-ui/jquery-ui.css') }}">

    {{--<!-- Dropzone -->--}}
    <link rel="stylesheet" type="text/css" href="{{ url('lib/css/plugins/dropzone/css/dropzone.min.css') }}">

    <!-- Customize -->
    <link rel="stylesheet" type="text/css" href="{{ url('customize/css/style.css') }}">

</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Home
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('admin/blogs') }}">Blogs Management</a></li>
                    <li><a href="{{ url('admin/users') }}">Users Management</a></li>
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
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>--}}
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <script type="text/javascript" src="{{ url('lib/js/plugins/jquery-1.12.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('lib/js/plugins/jquery-ui-1.11.4.js') }}"></script>
    <script type="text/javascript" src="{{ url('lib/js/plugins/bootstrap/bootstrap.min.js') }}"></script>

    <!-- Datatables JS -->
    <script type="text/javascript" src="{{ url('lib/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ url('lib/js/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

    <!-- Dropzone JS -->
    <script type="text/javascript" src="{{ url('lib/js/dropzone/dropzone.js') }}"></script>

    <!-- Jquery validation -->
    <script type="text/javascript" src="{{ url('lib/js/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('lib/js/plugins/jquery-validation/dist/additional-methods.min.js') }}"></script>

    <!-- Customize -->
    <script type="text/javascript" src="{{ url('customize/js/common.js') }}"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>

    @if (isset($dataTable))
    {!! $dataTable->scripts() !!}
    @endif

</body>
</html>

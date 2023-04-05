<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">
    <link rel="shortcut icon" href="{{ url('/images/favicon.png') }}" type="image/png" />
    <link rel="apple-touch-icon" href="{{ url('/images/favicon.png') }}" type="image/png" />
    <title>KiiBo</title>
    <link rel="stylesheet" href="{{ url('/admin-assets/css/lib/lobipanel/lobipanel.min.css') }}">
    <link rel="stylesheet" href="{{ url('/admin-assets/css/separate/vendor/lobipanel.min.css') }}">
    <link rel="stylesheet" href="{{ url('/admin-assets/css/lib/jqueryui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ url('/admin-assets/css/separate/pages/widgets.min.css') }}">
    <link rel="stylesheet" href="{{ url('/admin-assets/css/separate/pages/chat.min.css?v=3') }}">

    <!--link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet"-->

    <link rel="stylesheet" href="{{ url('/admin-assets/css/lib/bootstrap-table/bootstrap-table.min.css') }}">
    <link rel="stylesheet" href="{{ url('/admin-assets/css/lib/bootstrap/bootstrap.min.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/admin-assets/css/ekko-lightbox.css') }}">
    <link rel="stylesheet" href="{{ url('/admin-assets/css/main.css') }}?v=2">
    <link rel="stylesheet" href="{{ url('/admin-assets/css/fontawesome-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('/admin-assets/css/admin.css') }}?v=3">


    <script src="{{ url('/admin-assets/js/lib/jquery/jquery-3.2.1.min.js') }}"></script>




</head>

<body class="with-side-menu-compact">

    <header class="site-header">
        <div class="container-fluid">


            <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
                <span>toggle menu</span>
            </button>

            <button class="hamburger hamburger--htla">
                <span>toggle menu</span>
            </button>
            <div class="site-header-content">

                <div class="site-header-content-in">

                    <div class="site-header-shown">


                        <div class="dropdown user-menu">
                            <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">

                                <a class="dropdown-item" href="#" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span
                                        class="font-icon glyphicon glyphicon-log-out"></span>Salir</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>

                        <button type="button" class="burger-right">
                            <i class="font-icon-menu-addl"></i>
                        </button>
                    </div>
                    <!--.site-header-shown-->

                    <div class="mobile-menu-right-overlay"></div>
                    <div class="site-header-collapsed">
                        <div class="site-header-collapsed-in">

                            <div class="dropdown dropdown-typical">
                                <a href="#" class="dropdown-toggle no-arr">
                                    <span class="font-icon font-icon-notebook"></span>

                                    <span class="lbl" style="font-size: 18px">kiibo Prueba </span>

                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <!--site-header-content-in-->
            </div>
            <!--.site-header-content-->
        </div>
        <!--.container-fluid-->
    </header>
    <!--.site-header-->

    <div class="mobile-menu-left-overlay"></div>
    <nav class="side-menu side-menu-compact">
        <ul class="side-menu-list">


            @if (auth()->user()->rol == 1)
                <li class="blue-dirty">
                    <a href="{{ route('admin.usuarios') }}">
                        <i class="font-icon font-icon-users"></i>
                        <span class="lbl">Usuarios</span>
                    </a>
                </li>
            @endif


        </ul>
    </nav>
    <!--.side-menu-->

    @yield('content')


    <script src="{{ url('/admin-assets/js/lib/popper/popper.min.js') }}"></script>
    <script src="{{ url('/admin-assets/js/lib/tether/tether.min.js') }}"></script>
    <script src="{{ url('/admin-assets/js/lib/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ url('/admin-assets/js/ekko-lightbox.min.js') }}"></script>
    <script src="{{ url('/admin-assets/js/plugins.js') }}"></script>
    <script src="{{ url('/admin-assets/js/lib/bootstrap-table/bootstrap-table.js') }}"></script>
    <script src="{{ url('/admin-assets/js/lib/bootstrap-table/bootstrap-table-export.min.js') }}"></script>
    <script src="{{ url('/admin-assets/js/lib/bootstrap-table/tableExport.min.js') }}"></script>

    <script type="text/javascript" src="{{ url('/admin-assets/js/lib/jqueryui/jquery-ui.min.js') }}"></script>



    <script src="{{ url('/admin-assets/js/admin.js') }}"></script>


    <script type="text/javascript" src="{{ url('/js/select2.min.js') }}"></script>





    @yield('scripts')


</body>

</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link href="{{ asset('assets/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <span>Hello, &nbsp;{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</span>
                        <i class="fas fa-angle-down" style="margin: 5px;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                        <a class="dropdown-item" href="#">
                            Profile
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
            <a href="#" class="brand-link">
                <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link" title="Dashboard">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('news') }}" class="nav-link" title="News">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    News
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category') }}" class="nav-link" title="Category">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Category
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Tags
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('tag') }}" class="nav-link" title="News Tag">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>News Tag</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('trendingtag') }}" class="nav-link" title="Trending Tag">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Trending Tag</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Update
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('headline') }}" class="nav-link" title="Headline">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Headline</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('recommended') }}" class="nav-link" title="Recommended">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Recommended</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('breakingnews') }}" class="nav-link" title="Breaking News">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Breaking News</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Report
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('contactus') }}" class="nav-link" title="Contact Us">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Contact Us</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('newsletter') }}" class="nav-link" title="Newsletter">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Newsletter</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Setting
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('user') }}" class="nav-link" title="Users">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('group') }}" class="nav-link" title="Group">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Group</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content-header">
                <!-- <div class="container-fluid">
                    <div class="col-sm-6">
                        <h4>Title Tables</h4>
                    </div>
                </div> -->
            </section>
            <section class="content">
                @yield('content')
            </section>
        </div>

        <footer class="main-footer text-sm">
            <strong>Copyright &copy; 2020 <a href="http://adminlte.io">Admin</a>.</strong> All rights reserved.
        </footer>
    </div>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" ></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}" ></script>
    <script src="{{ asset('assets/dist/js/demo.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/datetimepicker/js/bootstrap-datetimepicker.js') }}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/datetimepicker/js/locales/bootstrap-datetimepicker.fr.js') }}" charset="UTF-8"></script>
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    @stack('scripts')
</body>
</html>
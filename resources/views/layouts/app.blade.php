<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @yield('title')
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('assets/img/icon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Quicksand:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    {{-- iMask JS --}}
    <script src="{{ asset('assets/js/plugin/imaskjs/imask.js') }}"></script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/atlantis2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/colorPick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    @livewireStyles
</head>

<body>
    <div class="wrapper">
        <div class="main-header" data-background-color="purple">

            <div class="nav-top">
                <div class="container d-flex flex-row">
                    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                        data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="icon-menu"></i>
                        </span>
                    </button>
                    <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                    <!-- Logo Header -->
                    <a href="{{ route('dashboard') }}"
                        class="logo d-flex align-items-center navbar-brand fw-bold text-white">
                        {{-- <img src="{{asset('../assets/img/logo.svg')}}" alt="navbar brand" class="navbar-brand"> --}}
                        DAINO TL SYSTEM
                    </a>
                    <!-- End Logo Header -->
                    <!-- Navbar Header -->
                    <nav class="navbar navbar-header navbar-expand-lg p-0">
                        <div class="container-fluid p-0">
                            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                                <li id="live-date-time" class="nav-item dropdown hidden-caret text-white mr-5">
                                    
                                </li>
                                <li class="nav-item dropdown hidden-caret">
                                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                        aria-expanded="false">
                                        <div class="row justify-content-center align-items-center">
                                            <span class="text-white fw-bold mr-2">{{ Auth::user()->name }}</span>
                                            <div class="avatar-sm">
                                                <span
                                                    class="avatar-title bg-primary rounded-circle border border-white">{{ Auth::user()->getNameInitials() }}</span>
                                            </div>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                                        <div class="dropdown-user-scroll scrollbar-outer">
                                            <li>
                                                <div class="user-box">
                                                    <div class="avatar"><span
                                                            class="avatar-title bg-primary rounded-circle border border-white">{{ Auth::user()->getNameInitials() }}</span>
                                                    </div>
                                                    <div class="u-text">
                                                        <h4>{{ Auth::user()->name }}</h4>
                                                        <p class="text-muted">
                                                            {{ Auth::user()->roles->first()->name }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ route('profile.index') }}">Edit
                                                    Profil</a>
                                                <a class="dropdown-item" href="{{ route('password.edit') }}">Ubah
                                                    Password</a>
                                                <div class="dropdown-divider"></div>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault();
                                                    this.closest('form').submit();">Keluar</a>
                                                </form>
                                            </li>
                                        </div>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <!-- End Navbar -->
                </div>
            </div>
            <div class="nav-bottom bg-white">
                <h3 class="title-menu d-flex d-lg-none">
                    Menu
                    <div class="close-menu"> <i class="flaticon-cross"></i></div>
                </h3>
                <div class="container d-flex flex-row">
                    <ul class="nav page-navigation page-navigation-secondary">
                        <li class="nav-item submenu1 {{ Request::is('dashboard') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="link-icon icon-screen-desktop"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item submenu dropdown">
                            <a class="nav-link" href="#">
                                <i class="link-icon icon-grid"></i>
                                <span class="menu-title">Menu Utama</span>
                            </a>
                            <div class="navbar-dropdown animated fadeIn">
                                <ul>
                                    <li>
                                        <a href="{{ '#' }}">Gaji Karyawan</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('employee-loan.index') }}">Piutang Karyawan</a>
                                    </li>
                                    {{-- <li>
                                        <a href="{{ route('supply.index') }}">Penebusan BBM</a>
                                    </li> --}}
                                    <li>
                                        <a href="{{ route('stock.index') }}">Stok BBM</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('roles.index') }}">Role Management</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('users.index') }}">User Management</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @can('Master')
                         @endcan
                            <li class="nav-item submenu {{ Request::is('product*') || Request::is('employee*') || Request::is('nozzle*') ? 'active' : '' }}">
                                <a class="nav-link" href="#">
                                    <i class="link-icon icon-folder-alt"></i>
                                    <span class="menu-title">Data Master</span>
                                </a>
                                <div class="navbar-dropdown animated fadeIn">
                                    <ul>
                                        <li>
                                            <a href="{{ route('product.index') }}">Produk</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('employee.index') }}">Karyawan</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('nozzle.index') }}">Nozzle</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('customer.index') }}">Pelanggan</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item submenu {{ Request::is('shift*') ? 'active' : '' }}">
                                <a class="nav-link" href="#">
                                    <i class="link-icon icon-briefcase"></i>
                                    <span class="menu-title">Management SPBU</span>
                                </a>
                                <div class="navbar-dropdown animated fadeIn">
                                    <ul>
                                        <li>
                                            <a href="{{route('shift.first')}}">Shift 1</a>
                                        </li>
                                        <li>
                                            <a href="{{route('shift.second')}}">Shift 2</a>
                                        </li>
                                        <li>
                                            <a href="{{route('shift.third')}}">Shift 3</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                       
                        @can('Administrasi')
                        @endcan
                        
                        <li class="nav-item submenu1 {{ Request::is('log-kegiatan') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="link-icon icon-notebook"></i>
                                <span class="menu-title">Log Kegiatan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-panel">
            <div class="container">
                <div class="page-inner">
                    @yield('breadcrumb')
                    <div class="page-category">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <nav class="pull-left">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Sitem Informasi Management Laporan Keuangan
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright ml-auto">
                    2022, made by Tiara Laju</a>
                </div>
            </div>
        </footer>
        <div class="quick-sidebar">
            <a href="#" class="close-quick-sidebar">
                <i class="flaticon-cross"></i>
            </a>
            <div class="quick-sidebar-wrapper">
                <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                    <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#messages"
                            role="tab" aria-selected="true">Messages</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tasks" role="tab"
                            aria-selected="false">Tasks</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab"
                            aria-selected="false">Settings</a> </li>
                </ul>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="{{ asset('assets/js/plugin/moment/moment.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/date-euro.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- Bootstrap Toggle -->
    <script src="{{ asset('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

    <!-- Google Maps Plugin -->
    <script src="{{ asset('assets/js/plugin/gmaps/gmaps.js') }}"></script>

    <!-- Dropzone -->
    <script src="{{ asset('assets/js/plugin/dropzone/dropzone.min.js') }}"></script>

    <!-- Fullcalendar -->
    <script src="{{ asset('assets/js/plugin/fullcalendar/fullcalendar.min.js') }}"></script>

    <!-- DateTimePicker -->
    <script src="{{ asset('assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Bootstrap Tagsinput -->
    <script src="{{ asset('assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

    <!-- Bootstrap Wizard -->
    <script src="{{ asset('assets/js/plugin/bootstrap-wizard/bootstrapwizard.js') }}"></script>

    <!-- jQuery Validation -->
    <script src="{{ asset('assets/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('assets/js/plugin/summernote/summernote-bs4.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('assets/js/plugin/select2/select2.full.min.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    {{-- Color Pick --}}
    {{-- <script src="{{asset('assets/js/plugin/colorpick/colorPick.min.js')}}"></script> --}}
    <script src="{{ asset('assets/js/plugin/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>

    <!-- Atlantis JS -->
    <script src="{{ asset('assets/js/atlantis2.min.js') }}"></script>

    @livewireScripts
    
    @yield('script')

    <script>
        $( document ).ready(function() {
            setInterval(() => {
                $("#live-date-time").text(moment().format('DD-MM-YYYY HH:mm:ss'));
            }, 1000);
        });
    </script>

    {{-- @stack('js') --}}
    {{-- <!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{asset('assets/js/demo.js')}}"></script> --}}
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- image icon web -->
    <link rel="shortcut icon" href="{{ asset('image/mdh.png') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    
    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
</head>

<body id="page-top">


    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
            </a>
            <div class="sidebar-heading">
                @if (Auth::user()->level == 'pic')
                Menu PIC
                @elseif (Auth::user()->role == 'kap_teknisi')
                Menu Kepala Teknisi
                @elseif(Auth::user()->level == 'teknisi')
                Menu Teknisi
                @elseif(Auth::user()->level == 'surveyor')
                Menu surveyor
                @elseif(Auth::user()->level == 'admin')
                Menu Admin
                @elseif(Auth::user()->level == 'sub_service')
                Menu Sub Service
                @endif
            </div>

            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <div class="slide-right"></div>
                <a class="nav-link" href="{{url('home')}}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>

            <!-- Nav Item - List Peralatan -->
            <li class="nav-item">
                <div class="slide-right"></div>
                <a class="nav-link"
                    href="@if (Auth::user()->level == 'pic_rs'){{route('peralatan.index')}}@else{{route('peralatan.index')}}@endif">
                    <i class="fas fa-fw fa-server"></i>
                    <span>List Peralatan @if(Auth::user()->level == 'pic_rs')RS @endif</span></a>
            </li>


            @if(Auth::user()->level == 'admin' || Auth::user()->level == 'surveyor' )
            <!-- Nav Item - List Peralatan -->
            <li class="nav-item">
                <div class="slide-right"></div>
                <a class="nav-link" href="{{route('instansi.index')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Data Instansi</span></a>
            </li>

            @endif
            @if(Auth::user()->level == 'admin' )
            <li class="nav-item">
                <div class="slide-right"></div>
                <a class="nav-link" href="{{url('users')}}">
                    <i class="fas fa-wrench"></i>
                    <span>User Configuration</span></a>
            </li>
            @endif

            <li class="nav-item">
                <div class="slide-right"></div>
                <a class="nav-link" href="{{route('profile.index')}}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profile User</span></a>
            </li>


            <!-- Nav Item Layanan Service-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#layananCollapse"
                    aria-expanded="false" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Layanan Service</span>
                </a>
                <div id="layananCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('/status')}}">Status</a>
                        <a class="collapse-item" href="{{route('jadwal.index')}}">Jadwal</a>
                        <a class="collapse-item" href="{{route('survey.index')}}">Laporan</a>
                        @if(Auth::user()->level != 'teknisi')
                        <a class="collapse-item" href="{{route('progres.index')}}">Pengajuan & Progress</a>
                        @endif
                        <a class="collapse-item" href="{{route('estimate.index')}}">Estimasi Biaya</a>
                    </div>
                </div>
            </li>

            @if(Auth::user()->level == 'admin')
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                PRODUCT & PART
            </div>

            <!-- Nav Item informasi -->
            <li class="nav-item">
                <div class="slide-right"></div>
                <a class="nav-link" href="{{url('merek')}}">
                    <i class="fas fa-asterisk"></i>
                    <span>Merk</span></a>
            </li>
            <!-- Nav Item informasi -->
            <li class="nav-item">
                <div class="slide-right"></div>
                <a class="nav-link" href="{{url('kategori')}}">
                    <i class="fas fa-list"></i>
                    <span>Kategori</span></a>
            </li>

            <!-- Nav Item informasi -->
            <li class="nav-item">
                <div class="slide-right"></div>
                <a class="nav-link" href="{{url('part')}}">
                    <i class="fas fa-tools"></i>
                    <span>Suku Cadang</span></a>
            </li>

            <!-- Nav Item informasi -->
            <li class="nav-item">
                <div class="slide-right"></div>
                <a class="nav-link" href="{{url('produk')}}">
                    <i class="fas fa-box"></i>
                    <span>Product</span></a>
            </li>

            <!-- Nav Item informasi -->
            <li class="nav-item">
                <div class="slide-right"></div>
                <a class="nav-link" href="{{route('dep.index')}}">
                    <i class="fas fa-sitemap"></i>
                    <span>Departement</span></a>
            </li>


            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Information
            </div>

            <!-- Nav Item informasi -->
            <li class="nav-item">
                <div class="slide-right"></div>
                <a class="nav-link" href="{{url('informasi')}}">
                    <i class="fas fa-newspaper"></i>
                    <span>Informasi</span></a>
            </li>



            <!-- Nav Item Logout-->
            <li class="nav-item">
                <a class="nav-link" href="" data-toggle="modal" data-target="#logoutModal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out"></i>
                    <span>logout</span></a>
            </li>


            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <img src="{{ asset('image/mdh_logo.png') }}" class="image-thumbnail" style="width: 180px;"
                        alt="Gambar">


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @else
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item">
                            <a class="nav-link" id="userDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="mr-4 d-lg-inline text-gray-600 small">{{ Auth::user()->nama_user }}</span>
                            </a>
                        </li>
                        @endguest
                    </ul>
                </nav>

                <div class="container-fluid my-5">
                    @yield('content')
                </div>

            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
</body>

@yield('custom-js')

<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
<!-- Content Row -->
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace('editor');
</script>

</html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- image icon web -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/icon-web.png') }}">

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

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar - Brand -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('home')}}">
            </a>
            <!-- Heading -->
            <div class="sidebar-heading">
                @if (Auth::user()->level == 'pic_rs')
                Menu PIC
                @elseif (Auth::user()->level == 'surveyor')
                Menu Surveyor
                @elseif(Auth::user()->level == 'teknisi')
                Menu Teknisi
                @elseif(Auth::user()->level == 'admin')
                Menu Admin
                @elseif(Auth::user()->level == 'sub_service')
                Menu Sub Service
                @endif
            </div>

            <hr class="sidebar-divider">

            @if(Auth :: user()->level != 'pic_rs')
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('home')}}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>
            @endif

            <!-- Nav Item - List Peralatan -->
            <li class="nav-item">
                <a class="nav-link"
                    href="@if (Auth::user()->level == 'pic_rs'){{route('peralatan.index')}}@else{{route('peralatan.index')}}@endif">
                    <i class="fas fa-fw fa-server"></i>
                    <span>List Peralatan @if(Auth::user()->level == 'pic_rs')RS @endif</span></a>
            </li>


            @if(Auth::user()->level == 'admin')
            <!-- Nav Item - List Peralatan -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('instansi.index')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Data Instansi</span></a>
            </li>
            @endif

            <!-- Nav Item Profile-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usercollaps"
                    aria-expanded="false" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profile</span>
                </a>
                <div id="usercollaps" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @if(Auth::user()->level == 'pic_rs')
                        <a class="collapse-item" href="{{url('/home')}}">Rumah Sakit</a>
                        @endif
                        <a class="collapse-item" href="{{route('profile.index')}}">Account</a>
                    </div>
                </div>
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
                        <a class="collapse-item" href="{{url('/')}}">Status</a>
                        <a class="collapse-item" href="{{url('/')}}">Jadwal</a>
                        <a class="collapse-item" href="{{url('/')}}">Laporan</a>
                        <a class="collapse-item" href="{{route('progres.index')}}">Progress Perbaikan</a>
                        <a class="collapse-item" href="{{url('/')}}">Estimasi Biaya</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item configuration Service-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#configurationCollapse"
                    aria-expanded="false" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>User Configuration</span>
                </a>
                <div id="configurationCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('users')}}">user config</a>
                        <a class="collapse-item" href="{{url('urgently')}}">urgently setting</a>
                    </div>
                </div>
            </li>

            @if(Auth::user()->level == 'pic_rs')
            @if(Auth::user()->role == 'gizi' || Auth::user()->role == 'manager')
            <!-- Nav Item informasi -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('merke')}}">
                    <i class="fas fa-fw fa-universal-access"></i>
                    <span>Dapur</span></a>
            </li>
            @endif

            @if(Auth::user()->role == 'alkes' || Auth::user()->role == 'manager')
            <!-- Nav Item informasi -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('part')}}">
                    <i class="fas fa-fw fa-universal-access"></i>
                    <span>Alkes</span></a>
            </li>
            @endif

            @if(Auth::user()->role == 'cssd' || Auth::user()->role == 'manager')
            <!-- Nav Item informasi -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('create-user')}}">
                    <i class="fas fa-fw fa-universal-access"></i>
                    <span>CSSD</span></a>
            </li>
            @endif
            @endif


            @if(Auth::user()->level == 'admin')
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                PRODUCT & PART
            </div>

            <!-- Nav Item informasi -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('merek')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Merk</span></a>
            </li>
            <!-- Nav Item informasi -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('kategori')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Kategori</span></a>
            </li>
            
            <!-- Nav Item informasi -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('part')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Suku Cadang</span></a>
            </li>

            <!-- Nav Item informasi -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('produk')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Product</span></a>
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
                <a class="nav-link" href="{{url('informasi')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Informasi</span></a>
            </li>

            <!--Nav Itemm News -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('create-user')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>News</span></a>
            </li>


            <!-- Nav Item Logout-->
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#logoutModal" data-target="#logoutModal">
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

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <img src="{{ asset('image/medhigen.jpg') }}" class="image-thumbnail" style="width: 100px;"
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
                                <span class="mr-4 d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            </a>
                        </li>
                        @endguest
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid my-5">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- CKEditor from CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/30.1.0/classic/ckeditor.js"></script>
    <script>
    ClassicEditor
        .create(document.querySelector('#alamat'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
    </script>

</body>

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
<script>
function updateNomorUrut() {
    const rows = document.querySelectorAll('tr[data-nomor]');
    rows.forEach((row, index) => {
        row.querySelector('td:first-child').textContent = index + 1;
    });
}

document.addEventListener('DOMContentLoaded', () => {
    updateNomorUrut();
});

// Fungsi ini akan dipanggil ketika data dihapus, contoh: setelah submit form hapus
function onDataDeleted() {
    updateNomorUrut();
}
</script>

</html>
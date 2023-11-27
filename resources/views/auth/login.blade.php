<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>

    <!-- image icon web -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/icon-web.png') }}">

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Custome Boostrap -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="vh-100 d-flex align-items-center">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-6 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg ">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="p-5 ">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900 p-0 m-0">Login to member</h1>
                                    <img src="{{ asset('image/mdh_logo.png') }}" class="image-thumbnail" style="width: 200px;" alt="Gambar">
                                </div>
                                <form class="user" method="POST" action="{{route('login')}}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control @error('nama_user') is-invalid @enderror form-control-user"
                                            id="exampleInputEmail" name="nama_user" autocomplete="email" required
                                            aria-describedby="emailHelp" placeholder="Enter Username...">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror form-control-user"
                                            id="exampleInputPassword" name="password" required id="password"
                                            placeholder="Password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                @if (Route::has('password.request'))
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>


</html>
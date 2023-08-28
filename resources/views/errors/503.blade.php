<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Unavailable</title>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>
<body class="bg-secondary">
    <div class="d-flex flex-column justify-content-center vh-100 align-items-center">
        <div class="card ">
            <div class="card-header d-flex p-2">
                <div class="circle bg-danger"></div>
                <div class="circle mx-2 bg-warning"></div>
                <div class="circle bg-success"></div>
            </div>
            <div class="card-body">
                <p class="h3 text-center error-503" data-text="503">503</p>
                <h3 class="text-center">Service Unavailable</h3>
                <p class="text-center">Saat ini kami sedang mengalami beberapa masalah teknis. <br> Silakan coba lagi nanti..
                </p>
            </div>
        </div>
    </div>
</body>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>


</html>
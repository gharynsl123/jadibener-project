@section('content')
<div class="row">
    <!-- Earnings (Annual) Card Example -->
    <a class="col-xl-6 col-md-6 mb-4 text-decoration-none" href="{{ route('instansi.group') }}">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pilih Instansi Untuk melihat data instansi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Member Rumah Sakit</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-building fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <!-- Earnings (Annual) Card Example -->
    <a class="col-xl-6 col-md-6 mb-4 text-decoration-none" href="{{ route('survey.creat-data') }}">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Buat Data Baru untuk instansi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Daftar member baru</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hospital fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<!-- table history untuk setiap updata dan creating yang di lakukan oleh surveyor dan yang di setujui oleh andmin -->
<div class="card shadow border-left-primary p-3 mt-4">
    <h2>History Table</h2><hr>
    <h4>under maintemance please pe pation</h4>
</div>
@endsection
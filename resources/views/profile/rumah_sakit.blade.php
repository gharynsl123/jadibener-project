
@if ($instansi)
<!-- Code to display the hospital profile -->
<h1 class="h3 mb-0 text-gray-800 d-sm-inline-block mb-4">Profile Rumah Sakit</h1>
<div class="border-0">
    <!-- Your existing code to display the hospital profile here -->
    <div class="card shadow border-0 ">
        <div class="row">
            <div class="col-md-3 d-flex justify-content-center">
                <img src="{{ asset('storage/rumahsakit/'.$instansi->photo_instansi) }}" alt="Hospital Logo" class="img-fluid rounded"
                    style="width: 100%;">
            </div>
            <div class="col-md-9 my-4 px-4">
                <h4 class="mb-3">{{$instansi->nama_instansi}}</h4>
                <p>
                    <strong>Alamat:</strong>
                    {{$instansi->alamat_instansi}}
                </p>
                <div class="text-capitalize">
                    <strong>PIC:</strong> {{$user->nama_user}} <br>
                    <!-- jika divisi belumm ada maka muncul kan text belum ada -->
                    <strong>Divisi:</strong> {{$user->role ? $user->role : 'Belum ada'}}
                </div>
                <div class="contact-info">
                    <strong>HP:</strong> {{$user->nomor_telepon}}<br>
                    <strong>Email:</strong> {{$user->email}}
                </div>
            </div>
        </div>
    </div>

    <div class="card border-left-primary mt-5">
        <div class="card-header">BUSINESS INFORMATION</div>
        <div class="card-body">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td>JUMLAH BED</td>
                        <td>:</td>
                        <td>{{$instansi->jumlah_kasur}}</td>
                    </tr>
                    <tr>
                        <td>Jenis Instansi</td>
                        <td>:</td>
                        <td>{{$instansi->jenis_instansi}}</td>
                    </tr>
                    <tr>
                        <td>NO. MEMBER</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<h1 class="h3 mb-0 text-gray-800 d-sm-inline-block d-flex mb-4">Kamu Belum Menangani Rumah Sakit</h1>
@endif
<?php
date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Rumah Sakit</title>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body>
    <table>
        <tr>
            <td>
                <img src="{{ asset('image/mdh_logo.png') }}" class="image-thumbnail" style="width: 180px;"
                    alt="Gambar">
            </td>
            <td>
                <h4 class="small mt-4">data di ambil dari www.jadibener.com</h4>
            </td>
        </tr>

    </table>

    <hr>
    
    <p>Tanggal Print:

        <strong>
            <?php echo date("l"); ?>
        </strong>
        <?php echo date("d-m-Y H:i"); ?>
    </p>

    <h1 class="h3 mb-4">Profile Rumah Sakit</h1>
    <div class="card shadow">
        <div class="row">
            <div class="col-md-9 my-4 px-4">
                @if($instansi->photo_instansi)
                <img src="{{ asset('storage/rumahsakit/'.$instansi->photo_instansi) }}" style="width:250px;">
                @endif
                <h4 class="mb-3">{{ $instansi->nama_instansi }}</h4>
                <p>
                    <strong>Alamat:</strong>
                    {!! $instansi->alamat_instansi !!}
                </p>
                <div class="text-capitalize">
                    <strong>PIC:</strong> {{ $user->nama_user }} <br>
                    <strong>Divisi:</strong>
                    {{ $user->departement ? $user->departement : 'Belum ada' }}
                </div>
                <div class="contact-info">
                    <strong>HP:</strong> {{ $user->nomor_telepon }}<br>
                    <strong>Email:</strong> {{ $user->email }}
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">BUSINESS INFORMATION</div>
        <div class="card-body">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td>JUMLAH BED</td>
                        <td>:</td>
                        <td>{{ $instansi->jumlah_kasur }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Instansi</td>
                        <td>:</td>
                        <td>{{ $instansi->jenis_instansi }}</td>
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
</body>

</html>

@extends('layouts.main-view')

@section('title', 'Pengajuan Keluhan')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 d-sm-inline-block"> Progress Perbaikan
    </h1>
    <div class="d-none d-sm-inline-block">
        <a href="{{url('pengajuan')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-ticket fa-sm text-white-50"></i> Ajukan Perbaikan</a>
    </div>
</div>


<!-- Progress DataTales -->
<div class="card shadow mb-4">
    <div class="p-3">
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start">Tanggal Proses</th>
                        <th>Reportet By</th>
                        <th>Instansi</th>
                        <th>Teknisi</th>
                        <th>Product Name</th>
                        <th>Serial Nummber</th>
                        <th class="th-end">Progress</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2022-12-9 17:00:00</td>
                        <td>Ihsan</td>
                        <td>RSUD Koja</td>
                        <td>RAHMATSAH</td>
                        <td>COLD ROOM FREEZER MODULAR 1800</td>
                        <td>MED202200014</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: 75%;">75%</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2022-12-9 17:00:00</td>
                        <td>Ihsan</td>
                        <td>RSUD Koja</td>
                        <td>RAHMATSAH</td>
                        <td>COLD ROOM FREEZER MODULAR 1800</td>
                        <td>MED202200014</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: 75%;">75%</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2022-12-9 17:00:00</td>
                        <td>Ihsan</td>
                        <td>RSUD Koja</td>
                        <td>RAHMATSAH</td>
                        <td>COLD ROOM FREEZER MODULAR 1800</td>
                        <td>MED202200014</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: 75%;">75%</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2022-12-9 17:00:00</td>
                        <td>Ihsan</td>
                        <td>RSUD Koja</td>
                        <td>RAHMATSAH</td>
                        <td>COLD ROOM FREEZER MODULAR 1800</td>
                        <td>MED202200014</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: 75%;">75%</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2022-12-9 17:00:00</td>
                        <td>Ihsan</td>
                        <td>RSUD Koja</td>
                        <td>RAHMATSAH</td>
                        <td>COLD ROOM FREEZER MODULAR 1800</td>
                        <td>MED202200014</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: 75%;">75%</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2022-12-9 17:00:00</td>
                        <td>Ihsan</td>
                        <td>RSUD Koja</td>
                        <td>RAHMATSAH</td>
                        <td>COLD ROOM FREEZER MODULAR 1800</td>
                        <td>MED202200014</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: 75%;">75%</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2022-12-9 17:00:00</td>
                        <td>Ihsan</td>
                        <td>RSUD Koja</td>
                        <td>RAHMATSAH</td>
                        <td>COLD ROOM FREEZER MODULAR 1800</td>
                        <td>MED202200014</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: 75%;">75%</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2022-12-9 17:00:00</td>
                        <td>Ihsan</td>
                        <td>RSUD Koja</td>
                        <td>RAHMATSAH</td>
                        <td>COLD ROOM FREEZER MODULAR 1800</td>
                        <td>MED202200014</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: 75%;">75%</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2022-12-9 17:00:00</td>
                        <td>Ihsan</td>
                        <td>RSUD Koja</td>
                        <td>RAHMATSAH</td>
                        <td>COLD ROOM FREEZER MODULAR 1800</td>
                        <td>MED202200014</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: 75%;">75%</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2022-12-9 17:00:00</td>
                        <td>Ihsan</td>
                        <td>RSUD Koja</td>
                        <td>RAHMATSAH</td>
                        <td>COLD ROOM FREEZER MODULAR 1800</td>
                        <td>MED202200014</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: 75%;">75%</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2022-12-9 17:00:00</td>
                        <td>Ihsan</td>
                        <td>RSUD Koja</td>
                        <td>RAHMATSAH</td>
                        <td>COLD ROOM FREEZER MODULAR 1800</td>
                        <td>MED202200014</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: 75%;">75%</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2022-12-9 17:00:00</td>
                        <td>Ihsan</td>
                        <td>RSUD Koja</td>
                        <td>RAHMATSAH</td>
                        <td>COLD ROOM FREEZER MODULAR 1800</td>
                        <td>MED202200014</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: 75%;">75%</div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
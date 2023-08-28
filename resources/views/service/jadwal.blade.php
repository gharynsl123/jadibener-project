@extends('layouts.main-view')
@section('content')

<!-- table menggunakan dataTable -->
<div class="card p-2 shadow border-left-primary">
    <div class="table-responsive">
        <table class="table table-borderless table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>trait_exists</th>
                    <th>trait_exists2</th>
                    <th>trait_exists3</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>trait_exists</td>
                    <td>trait_exists2</td>
                    <td>trait_exists3</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@endsection
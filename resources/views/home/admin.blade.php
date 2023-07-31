@extends('layouts.main-view')

@if (Auth::user()->level == 'pic_rs')
@include('home.pic_rs')
@elseif (Auth::user()->level == 'surveyor')
@include('home.surveyor')
@elseif(Auth::user()->level == 'teknisi')
@include('home.teknisi')
@else

@section('content')
<!-- Page Heading -->

<h1 class="h3 mb-0 text-gray-800 d-sm-inline-block  mb-4"> Status Service</h1>

<div class="row gap-2">
    <div class="col-md-3 my-1">
        <div class="card d-flex text-center border-left-primary" style="min-height: 150px; padding: 10px;">
            <p class="fix-bottom m-0">
                Tickets Solved
            </p>
        </div>
    </div>
    <div class="col-md-3 my-1">
        <div class="card text-center border-left-primary" style="min-height: 150px; padding: 10px;">
            <p class="fix-bottom m-0">
                Tickets On Process
            </p>
        </div>
    </div>
    <div class="col-md-3 my-1">
        <div class="card text-center border-left-primary" style="min-height: 150px; padding: 10px;">
            Tickets Waiting Approval By Admin
        </div>
    </div>
    <div class="col-md-3 my-1">
        <div class="card text-center border-left-primary" style="min-height: 150px; padding: 10px;">
            Tickets Waiting Approval Technition
        </div>
    </div>
</div>
<h1 class="h3 mb-0 text-gray-800 d-sm-inline-block  my-4"> Request Approval</h1>

<!-- table untuk mengabil data pengajuan -->



@endsection

@endif
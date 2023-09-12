<?php

namespace App\Http\Controllers;

use App\Status;
use App\Progress;
use App\Peralatan;
use App\Pengajuan;
use App\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }
     
     public function index()
     {
            
            // Jika user level bukan 'pic', maka tampilkan semua progress status.
            // Jika user adalah 'pic', maka tampilkan progress yang dimiliki oleh user 'pic' tersebut.
            if (Auth::user()->level == 'admin') {
                $progressList = Progress::with(['history' => function ($query) {
                    $query->orderByDesc('created_at')->take(1);
                }])->get();
            } else if(Auth::user()->level == 'teknisi' || Auth::user()->level == 'sub_service') {
                $progressList = Progress::where('id_user', Auth::id())
                    ->with(['history' => function ($query) {
                        $query->orderByDesc('created_at')->take(1);
                    }])->get();
            } else {
               // Mendapatkan progress dengan history terbaru yang terkait
                $progressList = Progress::with(['history' => function ($query) {
                    $query->orderByDesc('created_at')->take(1);
                }])->get();
         
           }

            return view('service.status', compact('progressList'));
     }
     



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        //
    }
}
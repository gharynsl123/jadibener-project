<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peralatan;
use App\Survey;
use App\User;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
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
        // jika level dari user itu pic maka tampilkan data yang sesui dengan barangnya saya jika selain dari pic maka tampikan semua data
        if (auth()->user()->level == 'pic') {
            $survey = Survey::where('id_instansi', Auth::user()->id_instansi)->get();
        } else {
            $survey = Survey::all();
        }
        return view('service.laporan', compact('survey'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $peralatan = Peralatan::find($id);
        $user = User::where('level', 'teknisi')->get();
        $survey = Survey::all();
        return view('peralatan.create_survey', compact('peralatan', 'survey', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Survey::create($request->all());
        return redirect('/peralatan')->with('status', 'Data Survey Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

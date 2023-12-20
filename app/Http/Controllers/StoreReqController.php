<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instansi;
use App\ReqMember;
use App\Part;

class StoreReqController extends Controller
{
    public function create() {
        $instansi = Instansi::all();
        return view('zone-non-auth.request_member', compact('instansi'));
    }

    public function store(Request $request) {
        $data = $request->all();
        ReqMember::create($data);

        return redirect('/',)->with('success', 'Data berhasil disimpan. silahkan menunggu');
    }

    public function viewPart() {
        $part = Part::all();
        return view('zone-non-auth.spare_part_guest', compact('part'));
    }
    
    public function showPart($slug) {
        $part = Part::where('slug', $slug)->first();
        return view('zone-non-auth.detail_part_guest', compact('part'));
    }
}

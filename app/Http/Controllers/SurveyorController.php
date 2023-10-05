<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Departement;
use Carbon\Carbon;
use App\Peralatan;
use App\Instansi;
use App\Kategori;
use App\Produk;
use App\Merek;
use App\History;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SurveyorController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createData() {
        $peralatan = Peralatan::all();
        $instansi = Instansi::all();
        $kategori = Kategori::all();
        $produk = Produk::all();
        $merek = Merek::all();
        $user = User::all();
        $departement = Departement::all();

        return view('surveyor-form.create_data_surveyor', compact('peralatan', 'instansi', 'kategori','produk','merek','user','departement'));
    }


    public function storeData(Request $request) {
        // Validation rules for PIC data
        $picRules = [
            'nama_user' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'user_departement' => 'sometimes|integer|exists:departement,id',
            'alamat_user' => 'nullable|string|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'password' => 'nullable|string|min:8',
        ];

        // Validation rules for Peralatan data
        $peralatanRules = [
            'id_merek.*' => 'required|integer|exists:merek,id',
            'id_kategori.*' => 'required|integer|exists:kategori,id',
            'id_user.*' => 'required|integer|exists:users,id',
            'id_product.*' => 'required|integer|exists:produk,id',
            'id_departement.*' => 'sometimes|integer|exists:departement,id',
            'serial_number.*' => 'required|string|max:255',
            'tahun_pemasangan.*' => 'nullable|string|max:255',
            'usia_barang.*' => 'nullable|integer|min:5|max:10',
        ];


        // Combine all validation rules
        $validator = Validator::make($request->all(), array_merge(
            $picRules,
            $peralatanRules,
        ));

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validated data
        $validatedData = $validator->validated();

        $instansi = Instansi::find($id);

        $today = Carbon::now();
        $formattedDate = $today->format('y-m-d');

        $dataUser = [
            'id_instansi' => $instansi->id,
            'id_departement' => $request->user_departement,
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'alamat_user' => $request->alamat_user,
            'nomor_telepon' => $request->nomor_telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'level' => 'pic',
            'password' => $request->password,
            'created_at' => $today->format('Y-m-d'),
        ];

        $AddPIC = User::create($dataUser);

        // Process Peralatan data
        $alatData = [];

        foreach ($validatedData['id_merek'] as $key => $idMerek) {
            // Create Peralatan data array
            $slug = strtoupper(Str::slug($validatedData['serial_number'][$key]) . '-' . $formattedDate);

            $alatData[] = [
                'id_instansi' => $instansi->id,
                'id_user' => $validatedData['id_user'][$key] ?? null,
                'id_departement' => $validatedData['id_departement'][$key] ?? null,
                'id_merek' => $idMerek,
                'id_kategori' => $validatedData['id_kategori'][$key] ?? null,
                'id_product' => $validatedData['id_product'][$key] ?? null,
                'serial_number' => $validatedData['serial_number'][$key],
                'tahun_pemasangan' => $validatedData['tahun_pemasangan'][$key] ?? null,
                'usia_barang' => $validatedData['usia_barang'][$key] ?? null,
                'created_at' => $today->format('Y-m-d') ?? null,
                'slug' => $slug,
            ];
        }

        // Save all Peralatan data at once and get the inserted IDs
        DB::table('peralatan')->insert($alatData);

        $insertedIds = DB::getPdo()->lastInsertId();
            
            
        $historyData[] = [
            'status_history' => 'Pendataan Alat',
            'deskripsi' => 'Disurvey oleh ' . Auth::user()->nama_user,
            'tanggal' => $formattedDate,
            'id_peralatan' => $insertedIds,
            'id_user' => Auth::user()->id,
        ];
        
        // Insert history records
        History::insert($historyData);
        
        return redirect()->route('home')->with('success', 'Data successfully stored.');
    }

}

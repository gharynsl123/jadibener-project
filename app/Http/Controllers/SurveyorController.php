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
use App\Provinsi;
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

        return view('surveyor-form.create_data_surveyor', compact('peralatan', 'instansi', 'kategori','produk','merek','user'));
    }

    public function getAjaxInstansi(Request $request) {
        $query = $request->input('q');

        $instansi = Instansi::whereNull('jumlah_kasur')
        ->where('nama_instansi', 'LIKE', '%'.$query.'%')
        ->get();
        return response()->json($instansi);
    }


    public function storeData(Request $request) { 
        // Validation rules for Instansi data
        $instansiRules = [
            'id_instansi' => 'required|integer|exists:instansi,id',
            'jumlah_kasur' => 'required|integer|min:0',
            'jenis_instansi' => 'required|string|max:255',
            'photo_instansi' => 'nullable|image|mimes:jpeg,jpg,png|max:4120', // Maksimal 5MB
            'alamat_instansi' => 'required|string|max:255',
        ];
    
        // Validation rules for PIC data
        $picRules = [
            'nama_user' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'user_departement' => 'nullable|in:Hospital Kitchen,CSSD,Purcashing,IPS-RS',
            'alamat_user' => 'nullable|string|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'password' => 'nullable|string|min:8',
        ];


        // Combine all validation rules
        $validator = Validator::make($request->all(), array_merge(
            $instansiRules,
            $picRules,
        ));

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validated data
        $validatedData = $validator->validated();

        // Cek apakah instansi yang dipilih sudah ada
        $instansi = Instansi::find($request->input('id_instansi'));
            
        if ($request->hasFile('photo_instansi')) {
            $image = $request->file('photo_instansi');
            $image_name = $image->getClientOriginalName();
            $image->storeAs('public/rumahsakit', $image_name);
            $validatedData['photo_instansi'] =  $image_name;
        }

        if ($instansi) {
            // Instansi sudah ada, perbarui data jika perlu
            $instansi->update([
                'nama_instansi' => $instansi->nama_instansi,
                'jumlah_kasur' => $validatedData['jumlah_kasur'],
                'jenis_instansi' => $validatedData['jenis_instansi'],
                'alamat_instansi' => $validatedData['alamat_instansi'],
                'photo_instansi' => $validatedData['photo_instansi'],
            ]);
            
        } else {
            // Instansi belum ada, buat instansi baru
            $instansi = Instansi::create([
                'nama_instansi' => $request->input('nama_instansi'),
                'jumlah_kasur' => $validatedData['jumlah_kasur'],
                'jenis_instansi' => $validatedData['jenis_instansi'],
                'alamat_instansi' => $validatedData['alamat_instansi'],
                'photo_instansi' => $validatedData['photo_instansi'], 
            ]);
        }

        $today = Carbon::now();
        $formattedDate = $today->format('y-m-d');

        $dataUser = [
            'id_instansi' => $instansi->id,
            'departement' => $request->user_departement,
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
        
        return redirect()->route('home')->with('success', 'Data successfully stored.');
    }

    public function existData($id) {
        $peralatan = Peralatan::all();
        $instansi = Instansi::find($id);
        $kategori = Kategori::all();
        $produk = Produk::all();
        $merek = Merek::all();
        $user = User::all();

        return view('surveyor-form.existing_data_suveyor', compact('peralatan', 'instansi', 'kategori','produk','merek','user'));
    }

    public function existStore(Request $request, $id) {
        // Validation rules for PIC data
        
        $picRules = [
            'nama_user' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'departement' => 'nullable|in:Hospital Kitchen,CSSD,Purcashing,IPS-RS',
            'alamat_user' => 'nullable|string|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'password' => 'nullable|string|min:8',
        ];
        
        
        // Combine all validation rules
        $validator = Validator::make($request->all(), array_merge(
            $picRules,
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
            'departement' => $request->departement,
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

        return redirect()->route('instansi.index')->with('success', 'Data successfully stored.');
    }

    public function addAlat($id) {
        $kategori = Kategori::all();
        $merek = Merek::all();
        $user = User::find($id);
        $peralatan = Peralatan::all();
        $produk = Produk::all();
        $instansi = Instansi::all();
        return view('surveyor-form.add_peralatan_survey', compact('kategori','produk','merek','user','peralatan','instansi',));
    }

    public function storeAlatSurvey(Request $request, $id) {
         // Validation rules for Peralatan data
         $peralatanRules = [
            'id_merek.*' => 'required|integer|exists:merek,id',
            'id_kategori.*' => 'required|integer|exists:kategori,id',
            'id_instansi.*' => 'required|integer|exists:instansi,id',
            'id_user.*' => 'required|integer|exists:users,id',
            'id_product.*' => 'required|integer|exists:produk,id',
            'id_departement.*' => 'nullable|in:Hospital Kitchen,CSSD,Purcashing,IPS-RS',
            'serial_number.*' => 'required|string|max:255',
            'tahun_pemasangan.*' => 'nullable|string|max:255',
            'usia_barang.*' => 'nullable|integer|min:5|max:10',
        ];

        $validator = Validator::make($request->all(), array_merge(
            $peralatanRules,
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validated data
        $validatedData = $validator->validated();

        // Cek apakah instansi yang dipilih sudah ada

        $today = Carbon::now();
        $formattedDate = $today->format('y-m-d');

        $alatData = [];

        foreach ($validatedData['id_merek'] as $key => $idMerek) {
            // Create Peralatan data array            
            $slug = strtoupper(Str::slug($validatedData['serial_number'][$key]) . '-' . $formattedDate);

            $alatData[] = [
                'id_instansi' => $validatedData['id_instansi'][$key]?? null,
                'departement' => $validatedData['id_departement'][$key] ?? null,
                'id_user' => $validatedData['id_user'][$key] ?? null,
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
        return redirect()->route('instansi.index')->with('success', 'Data successfully stored.');
    }

}
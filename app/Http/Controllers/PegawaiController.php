<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Departemen;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;


class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $datas = DB::table('pegawais')
            ->join('departemens', 'pegawais.id_departemen', '=', 'departemens.id_departemen')
            ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id_jabatan')
            ->select('pegawais.*', 'departemens.nama_departemen', 'jabatans.nama_jabatan')
            ->get();


        if ($request->ajax()) {
            $data = DB::table('pegawais')
                ->join('departemens', 'pegawais.id_departemen', '=', 'departemens.id_departemen')
                ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id_jabatan')
                ->select('pegawais.*', 'departemens.nama_departemen', 'jabatans.nama_jabatan')
                ->get();

                $data->transform(function ($pegawai) {
                    $pegawai->foto_pegawai_url = asset('storage/images/' . $pegawai->foto_pegawai);
                    return $pegawai;
                });
    
                return Datatables::of($data)->make(true);
        }

        return view(
            '/pegawai',
            [
                'datas' => $datas,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departemens = Departemen::all();
        $jabatans = Jabatan::all();
        return view('pegawai.create', compact('departemens', 'jabatans'));
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nip' => 'required|string|unique:pegawais,nip',
            'nama_depan' => 'required|string',
            'nama_belakang' => 'required|string',
            'tanggal_lahir' => 'nullable|date',
            'tanggal_masuk' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki,Perempuan',
            'alamat' => 'nullable|string',
            'kota' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'kode_pos' => 'nullable|string',
            'nomor_telepon' => 'nullable|string',
            'email' => 'required|email|unique:pegawais,email',
            'id_departemen' => 'required|exists:departemens,id_departemen',
            'id_jabatan' => 'required|exists:jabatans,id_jabatan',
            'foto_pegawai' => 'nullable|image|max:2048', // Max 2MB
        ]);

        // Mengambil semua input kecuali _token dan foto_pegawai
        $input = $request->except('_token', 'foto_pegawai');

        // Menyimpan foto pegawai ke storage jika ada
        if ($request->hasFile('foto_pegawai')) {
            $fotoPath = $request->file('foto_pegawai')->store('public/images');
            $input['foto_pegawai'] = basename($fotoPath);
        }

        // Menyimpan data pegawai ke database
        Pegawai::create($input);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $departemens = Departemen::all();
        $jabatans = Jabatan::all();
        return view('pegawai.edit', compact('pegawai', 'departemens', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        // Validasi
        $request->validate([
            'nama_depan' => 'required|string|max:50',
            'nama_belakang' => 'required|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'tanggal_masuk' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki,Perempuan',
            'alamat' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'nomor_telepon' => 'nullable|string|max:15',
            'email' => 'required|email|max:100|unique:pegawais,email,' . $pegawai->id,
            'nip' => 'required|string|max:20',
            'id_departemen' => 'nullable|exists:departemens,id_departemen',
            'id_jabatan' => 'nullable|exists:jabatans,id_jabatan',
            'foto_pegawai' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update data pegawai
        $pegawai->update($request->except(['foto_pegawai']));

        if ($request->hasFile('foto_pegawai')) {
            // Hapus foto_pegawai lama jika ada
            if ($pegawai->foto_pegawai) {
                Storage::disk('public')->delete('images/' . $pegawai->foto_pegawai);
            }

            // Simpan foto_pegawai baru
            $file = $request->file('foto_pegawai');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $filename);
            $pegawai->foto_pegawai = $filename;
            $pegawai->save();
        }

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diupdate 👍');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        
        // Hapus foto pegawai jika ada
        if ($pegawai->foto_pegawai) {
            Storage::delete('public/images/' . $pegawai->foto_pegawai);
        }

        $pegawai->delete();

        return response()->json(['success' => 'Data pegawai berhasil dihapus 👍']);
    }

    public function show($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.show', compact('pegawai'));
    }

    public function downloadReport()
    {
        $pegawais = Pegawai::with(['departemen', 'jabatan'])->get();

        $pegawaiData = $pegawais->map(function ($pegawai) {
            return [
                'NO' => $pegawai->id,
                'Nama Depan' => $pegawai->nama_depan,
                'Nama Belakang' => $pegawai->nama_belakang,
                'Tanggal Lahir' => $pegawai->tanggal_lahir,
                'Tanggal Masuk' => $pegawai->tanggal_masuk,
                'Jenis Kelamin' => $pegawai->jenis_kelamin,
                'Alamat' => $pegawai->alamat,
                'Kota' => $pegawai->kota,
                'Provinsi' => $pegawai->provinsi,
                'Kode Pos' => $pegawai->kode_pos,
                'Nomor Telepon' => $pegawai->nomor_telepon,
                'Email' => $pegawai->email,
                'NIP' => $pegawai->nip,
                'Departemen' => optional($pegawai->departemen)->nama_departemen,
                'Jabatan' => optional($pegawai->jabatan)->nama_jabatan,
            ];
        });

        return (new FastExcel($pegawaiData))->download('pegawai_report.xlsx');
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Departemen;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

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
        //
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $departemens = Departemen::all();
        $jabatans = Jabatan::all();
        return view('pegawais.edit', compact('pegawai', 'departemens', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        // Validasi input
        $request->validate([
            'nama_depan' => 'required|string|max:50',
            'nama_belakang' => 'required|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'tanggal_masuk' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'nomor_telepon' => 'nullable|string|max:15',
            'email' => 'required|email|max:100|unique:pegawais,email,' . $pegawai->id_pegawai,
            'id_departemen' => 'nullable|exists:departemens,id_departemen',
            'id_jabatan' => 'nullable|exists:jabatans,id_jabatan',
        ]);

        // Update data pegawai
        $pegawai->update([
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'id_departemen' => $request->id_departemen,
            'id_jabatan' => $request->id_jabatan,
        ]);

        // Redirect atau response setelah update
        return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}

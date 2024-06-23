<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Departemen;
use App\Models\Jabatan;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Rap2hpoutre\FastExcel\FastExcel;

class GajiController extends Controller
{
    public function index(Request $request)
    {
        $datas = DB::table('pegawais')
            ->join('departemens', 'pegawais.id_departemen', '=', 'departemens.id_departemen')
            ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id_jabatan')
            ->select('pegawais.nama_depan', 'pegawais.nama_belakang', 'pegawais.email', 'pegawais.nip', 'pegawais.nomor_telepon', 'departemens.nama_departemen', 'jabatans.nama_jabatan')
            ->get();

        if ($request->ajax()) {
            $data = DB::table('pegawais')
                ->join('departemens', 'pegawais.id_departemen', '=', 'departemens.id_departemen')
                ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id_jabatan')
                ->select('pegawais.nama_depan', 'pegawais.nama_belakang', 'pegawais.email', 'pegawais.nip', 'pegawais.nomor_telepon', 'departemens.nama_departemen', 'jabatans.nama_jabatan')
                ->get();

            return Datatables::of($data)->make(true);
        }

        return view(
            '/gaji',
            [
                'datas' => $datas,
            ]
        );
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
                'Email' => $pegawai->email,
                'NIP' => $pegawai->nip,
                'Nomor Telepon' => $pegawai->nomor_telepon,
                'Departemen' => optional($pegawai->departemen)->nama_departemen,
                'Jabatan' => optional($pegawai->jabatan)->nama_jabatan,
            ];
        });

        return (new FastExcel($pegawaiData))->download('pegawai_report.xlsx');
    }
}

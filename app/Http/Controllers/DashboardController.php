<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\Gaji;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Rap2hpoutre\FastExcel\FastExcel;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // dd(auth()->user());
        // $userId = Auth::id();
        $hr = DB::table('pegawais')
            ->join('departemens', 'pegawais.id_departemen', '=', 'departemens.id_departemen')
            ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id_jabatan')
            ->where('departemens.nama_departemen', 'HR')
            ->count();

        $it = DB::table('pegawais')
            ->join('departemens', 'pegawais.id_departemen', '=', 'departemens.id_departemen')
            ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id_jabatan')
            ->where('departemens.nama_departemen', 'IT')
            ->count();

        $marketing = DB::table('pegawais')
            ->join('departemens', 'pegawais.id_departemen', '=', 'departemens.id_departemen')
            ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id_jabatan')
            ->where('departemens.nama_departemen', 'Marketing')
            ->count();

        $manajer = DB::table('pegawais')
            ->join('departemens', 'pegawais.id_departemen', '=', 'departemens.id_departemen')
            ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id_jabatan')
            ->where('jabatans.nama_jabatan', 'Manager')
            ->count();

        $staff = DB::table('pegawais')
            ->join('departemens', 'pegawais.id_departemen', '=', 'departemens.id_departemen')
            ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id_jabatan')
            ->where('jabatans.nama_jabatan', 'Staff')
            ->count();

        $intern = DB::table('pegawais')
            ->join('departemens', 'pegawais.id_departemen', '=', 'departemens.id_departemen')
            ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id_jabatan')
            ->where('jabatans.nama_jabatan', 'Intern')
            ->count();

        $datas = DB::table('pegawais')
            ->join('departemens', 'pegawais.id_departemen', '=', 'departemens.id_departemen')
            ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id_jabatan')
            ->select('pegawais.nama_depan', 'pegawais.nama_belakang', 'pegawais.email', 'pegawais.nip', 'pegawais.nomor_telepon', 'departemens.nama_departemen', 'jabatans.nama_jabatan', 'jabatans.gaji')
            ->get();

        if ($request->ajax()) {
            $data = DB::table('pegawais')
                ->join('departemens', 'pegawais.id_departemen', '=', 'departemens.id_departemen')
                ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id_jabatan')
                ->select('pegawais.nama_depan', 'pegawais.nama_belakang', 'pegawais.email', 'pegawais.nip', 'pegawais.nomor_telepon', 'departemens.nama_departemen', 'jabatans.nama_jabatan', 'jabatans.gaji')
                ->get();

            return Datatables::of($data)->make(true);
        }

        return view(
            '/dashboard',
            [
                'hr' => $hr,
                'it' => $it,
                'marketing' => $marketing,
                'manajer' => $manajer,
                'staff' => $staff,
                'intern' => $intern,
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
                'gaji' => $pegawai->jabatan->gaji,
            ];
        });

        return (new FastExcel($pegawaiData))->download('pegawai_report.xlsx');
    }
}

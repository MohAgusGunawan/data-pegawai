<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Departemen;
use App\Models\Jabatan;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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
            ->select('pegawais.nama_depan', 'pegawais.nama_belakang', 'pegawais.email', 'pegawais.nomor_telepon', 'departemens.nama_departemen', 'jabatans.nama_jabatan')
            ->get();

        if ($request->ajax()) {
            $data = DB::table('pegawais')
                ->join('departemens', 'pegawais.id_departemen', '=', 'departemens.id_departemen')
                ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id_jabatan')
                ->select('pegawais.nama_depan', 'pegawais.nama_belakang', 'pegawais.email', 'pegawais.nomor_telepon', 'departemens.nama_departemen', 'jabatans.nama_jabatan')
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
}

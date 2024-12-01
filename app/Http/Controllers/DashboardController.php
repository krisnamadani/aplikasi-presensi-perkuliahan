<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $dosenId = Auth::guard('dosen')->id();

        $dosen = Dosen::where('id', $dosenId)->first();
        $totalMengajar = Jadwal::where('dosen_id', $dosenId)->count();
        $jmlPresensi = Presensi::where('dosen_id', $dosenId)->count();
        // $listMakul = Jadwal::with('matakuliah')->where('dosen_id', $dosenId)->get();
        $listMakul = Jadwal::where('dosen_id', $dosenId)
                    ->join('matakuliahs', 'jadwals.matakuliah_id', '=', 'matakuliahs.id')
                    ->select('jadwals.*', 'matakuliahs.kode_matakuliah as kode_mk', 'matakuliahs.nama as nama_mk', 'matakuliahs.sks as sks_mk', 'matakuliahs.jenis as jenis_mk')
                    ->get();
        // return $listMakul;

        return view('dashboard.index', compact('dosen','totalMengajar','jmlPresensi','listMakul'));
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function index()
    {
        return view('presensi.index');
    }

    public function presensi_masuk(Request $request)
    {
        $dosenId = Auth::guard('dosen')->id();
        $jadwal = Jadwal::find($request->jadwal_id);

        Presensi::updateOrCreate(
            [
                'jadwal_id' => $jadwal->id,
                'dosen_id' => $dosenId,
            ],
            [
                'waktu_presensi_mulai' => Carbon::now(),
            ]
        );

        return redirect()->back()->with('success', 'Presensi masuk berhasil');
    }

    public function presensi_pulang(Request $request)
    {
        $dosenId = Auth::guard('dosen')->id();
        $jadwal = Jadwal::find($request->jadwal_id);

        Presensi::updateOrCreate(
            [
                'jadwal_id' => $jadwal->id,
                'dosen_id' => $dosenId,
            ],
            [
                'waktu_presensi_selesai' => Carbon::now(),
            ]
        );

        return redirect()->back()->with('success', 'Presensi pulang berhasil');
    }
}

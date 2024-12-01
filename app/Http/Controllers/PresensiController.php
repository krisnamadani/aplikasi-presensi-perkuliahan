<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        $dosen = Dosen::find(5);

        $hariIni = Carbon::now()->locale('id');
        $hariIni->settings(['formatFunction' => 'translatedFormat']);
        $hariIniIndonesia = $hariIni->translatedFormat('l');

        $hariIniIndonesia = 'Senin';

        $jadwals = Jadwal::where('hari', $hariIniIndonesia)
            ->where('dosen_id', $dosen->id)
            ->get();

        $jadwals->each(function ($jadwal) {
            $jadwal->jam_sekarang = Carbon::now()->format('H:i:s');

            $jadwal->jam_mulai_10 = Carbon::parse($jadwal->jam_mulai)->subMinutes(10)->format('H:i:s');
            $jadwal->jam_mulai_presensi = $jadwal->jam_sekarang < $jadwal->jam_mulai_10;

            $jadwal->jam_selesai_min_10 = Carbon::parse($jadwal->jam_selesai)->subMinutes(10)->format('H:i:s');
            $jadwal->jam_selesai_plus_10 = Carbon::parse($jadwal->jam_selesai)->addMinutes(10)->format('H:i:s');
            $jadwal->sudah_presensi_mulai = Presensi::where('jadwal_id', $jadwal->id)->whereNotNull('waktu_presensi_mulai')->exists();
            $jadwal->jam_selesai_presensi = $jadwal->jam_sekarang > $jadwal->jam_selesai_min_10 && $jadwal->jam_sekarang < $jadwal->jam_selesai_plus_10 && $jadwal->sudah_presensi_mulai;
        });

        return view('presensi.index', compact('jadwals'));
    }

    public function presensi_masuk(Request $request)
    {
        $jadwal = Jadwal::find($request->jadwal_id);
        $dosen = Dosen::find(5);

        Presensi::updateOrCreate(
            [
                'jadwal_id' => $jadwal->id,
                'dosen_id' => $dosen->id,
            ],
            [
                'waktu_presensi_mulai' => Carbon::now(),
            ]
        );

        return redirect()->back()->with('success', 'Presensi masuk berhasil');
    }

    public function presensi_pulang(Request $request)
    {
        $jadwal = Jadwal::find($request->jadwal_id);
        $dosen = Dosen::find(5);

        Presensi::updateOrCreate(
            [
                'jadwal_id' => $jadwal->id,
                'dosen_id' => $dosen->id,
            ],
            [
                'waktu_presensi_selesai' => Carbon::now(),
            ]
        );

        return redirect()->back()->with('success', 'Presensi pulang berhasil');
    }
}

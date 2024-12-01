<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPresensi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $dosenId = Auth::guard('dosen')->id();

        $hariIni = Carbon::now()->locale('id');
        $hariIni->settings(['formatFunction' => 'translatedFormat']);
        $hariIniIndonesia = $hariIni->translatedFormat('l');
        // $hariIniIndonesia = 'Rabu';

        $jadwals = Jadwal::where('hari', $hariIniIndonesia)
            ->where('dosen_id', $dosenId)
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

        $request->merge([
            'jadwals' => $jadwals,
        ]);

        return $next($request);
    }
}

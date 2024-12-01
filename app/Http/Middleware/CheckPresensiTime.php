<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPresensiTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $jadwal = Jadwal::find($request->jadwal_id);
        $jam_sekarang = Carbon::now()->format('H:i:s');

        $jam_mulai_10 = Carbon::parse($jadwal->jam_mulai)->subMinutes(10)->format('H:i:s');
        $jam_mulai_presensi = $jam_sekarang < $jam_mulai_10;

        $jam_selesai_min_10 = Carbon::parse($jadwal->jam_selesai)->subMinutes(10)->format('H:i:s');
        $jam_selesai_plus_10 = Carbon::parse($jadwal->jam_selesai)->addMinutes(10)->format('H:i:s');
        $jam_selesai_presensi = $jadwal->jam_sekarang > $jam_selesai_min_10 && $jam_sekarang < $jam_selesai_plus_10;

        if ($jam_mulai_presensi || $jam_selesai_presensi) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'Presensi diluar waktu yang ditentukan');
    }
}

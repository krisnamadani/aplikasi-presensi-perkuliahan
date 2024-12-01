@extends('layouts.main')

@section('main-location')

    <div class="container">

        @include('layouts.navbar')

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Mata Kuliah</th>
                    <th scope="col">Jam Mulai</th>
                    <th scope="col">Jam Selesai</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwals as $jadwal)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $jadwal->matakuliah->nama }}</td>
                        <td>{{ $jadwal->jam_mulai }}</td>
                        <td>{{ $jadwal->jam_selesai }}</td>
                        <td>
                            <a href="{{ route('presensi_masuk', ['jadwal_id' => $jadwal->id]) }}"
                                class="btn btn-primary @if ($jadwal->jam_mulai_presensi) disabled @endif">Presensi
                                Masuk</a>
                            <a href="{{ route('presensi_pulang', ['jadwal_id' => $jadwal->id]) }}"
                                class="btn btn-danger @if ($jadwal->jam_selesai_presensi) @else disabled @endif">Presensi
                                Pulang</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

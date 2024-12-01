@extends('layouts.main')

@section('main-location')

<div class="container">

    @include('layouts.navbar')

    <div class="row mt-4">
        <div class="col-6">
            <div class="alert alert-primary" role="alert">
                Jadwal Mengajar : {{ $totalMengajar }}
            </div>
        </div>
        <div class="col-6">
            <div class="alert alert-danger" role="alert">
                Jumlah Presensi : {{ $jmlPresensi }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama</th>
                    <th scope="col">SKS</th>
                    <th scope="col">Jenis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listMakul as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->kode_mk }}</td>
                        <td>{{ $item->nama_mk }}</td>
                        <td>{{ $item->sks_mk }}</td>
                        <td>{{ $item->jenis_mk }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

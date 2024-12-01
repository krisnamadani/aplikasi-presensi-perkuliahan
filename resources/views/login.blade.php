@extends('layouts.main')

@section('main-location')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-4">
             <form action="/login" method="POST">
                @csrf
                <h2 class="text-center my-5">Login</h2>

                <!-- Pesan Error Login -->
                @if(session()->has('loginSalah'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('loginSalah') }}</strong>
                </div>
                @endif

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>

@endsection

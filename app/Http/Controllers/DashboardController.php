<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $dosenId = Auth::guard('dosen')->id();
        $data = Dosen::with('jadwal')->where('id', $dosenId)->first();

        return view('dashboard.index', compact('data'));
    }
}

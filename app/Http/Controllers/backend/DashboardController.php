<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;

class DashboardController extends Controller
{

    public function index()
    {

        // statistik
        $totalBuku = Buku::count();

        $totalAnggota = Anggota::count();

        $peminjamanAktif = Peminjaman::where('status','dipinjam')->count();

        $totalDenda = Peminjaman::sum('denda');


        // peminjaman terbaru
        $peminjamanTerbaru = Peminjaman::with([
            'anggota',
            'buku'
        ])
        ->latest()
        ->limit(5)
        ->get();


        return view('backend.dashboard.index',compact(
            'totalBuku',
            'totalAnggota',
            'peminjamanAktif',
            'totalDenda',
            'peminjamanTerbaru'
        ));

    }

}
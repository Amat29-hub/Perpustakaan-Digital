<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;

class LaporanController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | LAPORAN PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    public function peminjaman(Request $request)
    {

        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        $tanggal_awal = $request->tanggal_awal 
            ?? Carbon::now()->startOfMonth()->format('Y-m-d');

        $tanggal_akhir = $request->tanggal_akhir 
            ?? Carbon::now()->endOfMonth()->format('Y-m-d');


        /*
        |--------------------------------------------------------------------------
        | DATA PEMINJAMAN
        |--------------------------------------------------------------------------
        */

        $peminjamans = Peminjaman::with(['anggota','buku'])
            ->whereBetween('tanggal_pinjam', [$tanggal_awal, $tanggal_akhir])
            ->orderBy('tanggal_pinjam','desc')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK LAPORAN
        |--------------------------------------------------------------------------
        */

        $totalTransaksi = $peminjamans->count();

        $anggotaAktif = $peminjamans
            ->pluck('id_anggota')
            ->unique()
            ->count();

        $totalDipinjam = $peminjamans
            ->whereIn('status', ['dipinjam','terlambat','dikembalikan'])
            ->count();

        $masihDipinjam = $peminjamans
            ->whereIn('status', ['dipinjam','terlambat'])
            ->count();


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('backend.laporan.peminjaman', [
            'peminjamans'    => $peminjamans,
            'tanggal_awal'   => $tanggal_awal,
            'tanggal_akhir'  => $tanggal_akhir,
            'totalTransaksi' => $totalTransaksi,
            'anggotaAktif'   => $anggotaAktif,
            'totalDipinjam'  => $totalDipinjam,
            'masihDipinjam'  => $masihDipinjam
        ]);
    }


    public function pengembalian(Request $request)
    {
    
        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */
    
        $tanggal_awal = $request->tanggal_awal 
            ?? Carbon::now()->startOfMonth()->format('Y-m-d');
    
        $tanggal_akhir = $request->tanggal_akhir 
            ?? Carbon::now()->endOfMonth()->format('Y-m-d');
    
    
        /*
        |--------------------------------------------------------------------------
        | DATA PENGEMBALIAN
        |--------------------------------------------------------------------------
        */
    
        $pengembalians = Peminjaman::with(['anggota','buku'])
            ->whereNotNull('tanggal_kembali')
            ->whereBetween('tanggal_kembali',[$tanggal_awal,$tanggal_akhir])
            ->orderBy('tanggal_kembali','desc')
            ->get();
    
    
        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */
    
        $totalPengembalian = $pengembalians->count();
    
        $tepatWaktu = $pengembalians
            ->where('status','dikembalikan')
            ->count();
    
        $terlambat = $pengembalians
            ->where('status','terlambat')
            ->count();
    
        $totalDenda = $pengembalians->sum('denda');
    
    
        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */
    
        return view('backend.laporan.pengembalian',[
            'pengembalians'=>$pengembalians,
            'tanggal_awal'=>$tanggal_awal,
            'tanggal_akhir'=>$tanggal_akhir,
            'totalPengembalian'=>$totalPengembalian,
            'tepatWaktu'=>$tepatWaktu,
            'terlambat'=>$terlambat,
            'totalDenda'=>$totalDenda
        ]);
    
    }


    /*
    |--------------------------------------------------------------------------
    | CETAK LAPORAN PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    public function cetakPeminjaman(Request $request)
    {

        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        $tanggal_awal = $request->tanggal_awal 
            ?? Carbon::now()->startOfMonth()->format('Y-m-d');

        $tanggal_akhir = $request->tanggal_akhir 
            ?? Carbon::now()->endOfMonth()->format('Y-m-d');


        /*
        |--------------------------------------------------------------------------
        | DATA PEMINJAMAN
        |--------------------------------------------------------------------------
        */

        $peminjamans = Peminjaman::with(['anggota','buku'])
            ->whereBetween('tanggal_pinjam', [$tanggal_awal, $tanggal_akhir])
            ->orderBy('tanggal_pinjam','desc')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalTransaksi = $peminjamans->count();

        $anggotaAktif = $peminjamans
            ->pluck('id_anggota')
            ->unique()
            ->count();

        $totalDipinjam = $peminjamans
            ->whereIn('status', ['dipinjam','terlambat','dikembalikan'])
            ->count();

        $masihDipinjam = $peminjamans
            ->whereIn('status', ['dipinjam','terlambat'])
            ->count();


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW CETAK
        |--------------------------------------------------------------------------
        */

        return view('backend.laporan.cetak', [
            'peminjamans'    => $peminjamans,
            'tanggal_awal'   => $tanggal_awal,
            'tanggal_akhir'  => $tanggal_akhir,
            'totalTransaksi' => $totalTransaksi,
            'anggotaAktif'   => $anggotaAktif,
            'totalDipinjam'  => $totalDipinjam,
            'masihDipinjam'  => $masihDipinjam
        ]);
    }


    public function cetakPengembalian(Request $request)
    {
    
        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */
    
        $tanggal_awal = $request->tanggal_awal 
            ?? Carbon::now()->startOfMonth()->format('Y-m-d');
    
        $tanggal_akhir = $request->tanggal_akhir 
            ?? Carbon::now()->endOfMonth()->format('Y-m-d');
    
    
        /*
        |--------------------------------------------------------------------------
        | DATA PENGEMBALIAN
        |--------------------------------------------------------------------------
        */
    
        $pengembalians = Peminjaman::with(['anggota','buku'])
            ->whereNotNull('tanggal_kembali')
            ->whereBetween('tanggal_kembali', [$tanggal_awal,$tanggal_akhir])
            ->orderBy('tanggal_kembali','desc')
            ->get();
    
    
        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */
    
        $totalPengembalian = $pengembalians->count();
    
        $tepatWaktu = $pengembalians
            ->where('status','dikembalikan')
            ->count();
    
        $terlambat = $pengembalians
            ->where('status','terlambat')
            ->count();
    
        $totalDenda = $pengembalians->sum('denda');
    
    
        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */
    
        return view('backend.laporan.cetak_pengembalian',[
            'pengembalians'=>$pengembalians,
            'tanggal_awal'=>$tanggal_awal,
            'tanggal_akhir'=>$tanggal_akhir,
            'totalPengembalian'=>$totalPengembalian,
            'tepatWaktu'=>$tepatWaktu,
            'terlambat'=>$terlambat,
            'totalDenda'=>$totalDenda
        ]);
    
    }

}
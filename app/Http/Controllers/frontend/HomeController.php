<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Anggota;

class HomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | HOME
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $buku = Buku::where('stok','>',0)
                ->latest()
                ->paginate(12);

        return view('frontend.index.index', compact('buku'));
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL BUKU
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {

        $buku = Buku::where('id_buku',$id)
                ->where('stok','>',0)
                ->firstOrFail();

        $bukulain = Buku::where('id_buku','!=',$id)
                    ->where('stok','>',0)
                    ->latest()
                    ->limit(5)
                    ->get();

        return view('frontend.buku.detail', compact('buku','bukulain'));
    }


    /*
    |--------------------------------------------------------------------------
    | PINJAM BUKU
    |--------------------------------------------------------------------------
    */

    public function pinjam($id)
    {
    
        $buku = Buku::where('id_buku',$id)->firstOrFail();
    
        if ($buku->stok <= 0) {
            return back()->with('error','Stok buku habis');
        }
    
        $user = Auth::user();
    
        $anggota = Anggota::where('user_id',$user->id)->first();
    
        if (!$anggota) {
            return back()->with('error','Akun belum terdaftar sebagai anggota');
        }
    
        $exists = Peminjaman::where('id_anggota',$anggota->id_anggota)
                    ->where('id_buku',$buku->id_buku)
                    ->whereIn('status',['menunggu','dipinjam','terlambat'])
                    ->exists();
        
        if ($exists) {
            return back()->with('error','Anda sudah meminjam buku ini. Silakan kembalikan terlebih dahulu sebelum meminjam lagi.');
        }
    
        Peminjaman::create([
            'id_anggota' => $anggota->id_anggota,
            'id_petugas' => null,
            'id_buku' => $buku->id_buku,
            'tanggal_pinjam' => now(),
            'tanggal_jatuh_tempo' => now()->addDays(7),
            'status' => 'menunggu',
            'denda' => 0
        ]);
    
        return redirect()->route('buku.saya')
                ->with('success','Peminjaman berhasil diajukan');
    }



    /*
    |--------------------------------------------------------------------------
    | HALAMAN BUKU SAYA
    |--------------------------------------------------------------------------
    */

    public function bukuSaya()
    {

        $user = Auth::user();

        $anggota = Anggota::where('user_id',$user->id)->first();

        if (!$anggota) {
            return redirect()->route('home');
        }


        /*
        |--------------------------------------------------------------------------
        | OTOMATIS UBAH STATUS TERLAMBAT
        |--------------------------------------------------------------------------
        */

        Peminjaman::where('id_anggota',$anggota->id_anggota)
        ->where('status','dipinjam')
        ->whereDate('tanggal_jatuh_tempo','<',now())
        ->update([
            'status' => 'terlambat'
        ]);


        /*
        |--------------------------------------------------------------------------
        | DATA PEMINJAMAN
        |--------------------------------------------------------------------------
        */

        $menunggu = Peminjaman::with('buku')
                    ->where('id_anggota',$anggota->id_anggota)
                    ->where('status','menunggu')
                    ->latest()
                    ->get();

        $dipinjam = Peminjaman::with('buku')
                    ->where('id_anggota',$anggota->id_anggota)
                    ->where('status','dipinjam')
                    ->latest()
                    ->get();

        $terlambat = Peminjaman::with('buku')
                    ->where('id_anggota',$anggota->id_anggota)
                    ->where('status','terlambat')
                    ->latest()
                    ->get();

        $dikembalikan = Peminjaman::with('buku')
                    ->where('id_anggota',$anggota->id_anggota)
                    ->where('status','dikembalikan')
                    ->latest()
                    ->get();

        $ditolak = Peminjaman::with('buku')
                    ->where('id_anggota',$anggota->id_anggota)
                    ->where('status','ditolak')
                    ->latest()
                    ->get();


        return view('frontend.kelolapeminjaman.index',[
            'menunggu'=>$menunggu,
            'dipinjam'=>$dipinjam,
            'terlambat'=>$terlambat,
            'dikembalikan'=>$dikembalikan,
            'ditolak'=>$ditolak
        ]);
    }



    /*
    |--------------------------------------------------------------------------
    | BAYAR DENDA
    |--------------------------------------------------------------------------
    */

    public function bayarDenda(Request $request,$id)
    {
    
        $user = Auth::user();
    
        $anggota = Anggota::where('user_id',$user->id)->first();
    
        if(!$anggota){
            return back()->with('error','Data anggota tidak ditemukan');
        }
    
        $peminjaman = Peminjaman::where('id_peminjaman',$id)
            ->where('id_anggota',$anggota->id_anggota)
            ->where('status','terlambat')
            ->first();
    
        if(!$peminjaman){
            return back()->with('error','Data peminjaman tidak ditemukan');
        }
    
        $peminjaman->update([
    
            'metode_bayar' => $request->metode_bayar,
            'status_bayar' => 'sudah',
            'status' => 'dipinjam'   // ⬅️ ini yang penting
    
        ]);
    
        return back()->with('success','Denda berhasil dibayar, silahkan kembalikan buku');
    
    }



    /*
    |--------------------------------------------------------------------------
    | KEMBALIKAN BUKU
    |--------------------------------------------------------------------------
    */

    public function kembalikan($id)
    {

        $user = Auth::user();

        $anggota = Anggota::where('user_id',$user->id)->first();

        if (!$anggota) {
            return back()->with('error','Data anggota tidak ditemukan');
        }

        $peminjaman = Peminjaman::where('id_peminjaman',$id)
                    ->where('id_anggota',$anggota->id_anggota)
                    ->whereIn('status',['dipinjam','terlambat'])
                    ->first();

        if (!$peminjaman) {
            return back()->with('error','Data peminjaman tidak ditemukan');
        }

        $today = now();
        $jatuhTempo = Carbon::parse($peminjaman->tanggal_jatuh_tempo);

        $telat = $jatuhTempo->diffInDays($today,false);

        $denda = $peminjaman->denda;

        if ($telat > 0 && $denda == 0) {

            $denda = $telat * 2000;

        }

        $peminjaman->update([
            'tanggal_kembali'=>$today,
            'status'=>'dikembalikan',
            'denda'=>$denda
        ]);

        Buku::where('id_buku',$peminjaman->id_buku)->increment('stok');

        return back()->with('success','Buku berhasil dikembalikan');

    }



    /*
    |--------------------------------------------------------------------------
    | HAPUS RIWAYAT
    |--------------------------------------------------------------------------
    */

    public function hapus($id)
    {

        $user = Auth::user();

        $anggota = Anggota::where('user_id',$user->id)->first();

        if (!$anggota) {
            return back()->with('error','Data anggota tidak ditemukan');
        }

        $peminjaman = Peminjaman::where('id_peminjaman',$id)
                    ->where('id_anggota',$anggota->id_anggota)
                    ->where('status','dikembalikan')
                    ->first();

        if (!$peminjaman) {
            return back()->with('error','Data tidak ditemukan');
        }

        $peminjaman->delete();

        return back()->with('success','Riwayat peminjaman berhasil dihapus');

    }

}
<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{

    /*
    ==========================
    LIST DATA PEMINJAMAN
    ==========================
    */

    public function index(Request $request)
    {

        /*
        ==========================
        AUTO CEK TERLAMBAT
        ==========================
        */

        $data = Peminjaman::where('status','dipinjam')->get();

        foreach($data as $p){

            if(Carbon::now()->gt($p->tanggal_jatuh_tempo)){

                $hari = Carbon::parse($p->tanggal_jatuh_tempo)
                        ->diffInDays(Carbon::now());

                if($hari < 1){
                    $hari = 1;
                }

                $denda = $hari * 2000;

                $p->update([
                    'status' => 'terlambat',
                    'denda' => $denda
                ]);

            }

        }


        /*
        ==========================
        QUERY DATA
        ==========================
        */

        $query = Peminjaman::with(['anggota','buku','petugas']);


        if($request->search){

            $query->where(function($q) use ($request){

                $q->whereHas('anggota',function($a) use ($request){

                    $a->where('nama','like','%'.$request->search.'%');

                })
                ->orWhereHas('buku',function($b) use ($request){

                    $b->where('judul','like','%'.$request->search.'%');

                });

            });

        }


        if($request->status){

            $query->where('status',$request->status);

        }


        $peminjaman = $query->latest()->paginate(10)->withQueryString();

        return view('backend.peminjaman.index',compact('peminjaman'));

    }



    /*
    ==========================
    CREATE
    ==========================
    */

    public function create()
    {

        $anggota = Anggota::all();
        $buku = Buku::where('stok','>',0)->get();

        return view('backend.peminjaman.create',compact('anggota','buku'));

    }



    /*
    ==========================
    STORE
    ==========================
    */

    public function store(Request $request)
    {

        $request->validate([
            'id_anggota' => 'required',
            'id_buku' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date'
        ]);

        Peminjaman::create([

            'id_anggota' => $request->id_anggota,
            'id_buku' => $request->id_buku,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'status' => 'menunggu',
            'denda' => 0,
            'status_bayar' => 'belum'

        ]);

        return redirect()->route('admin.peminjaman.index')
        ->with('success','Peminjaman berhasil dibuat');

    }



    /*
    ==========================
    SETUJUI
    ==========================
    */

    public function setujui($id)
    {

        $peminjaman = Peminjaman::findOrFail($id);

        if($peminjaman->status != 'menunggu'){
            return back()->with('error','Status tidak valid');
        }

        $buku = Buku::findOrFail($peminjaman->id_buku);

        if($buku->stok <= 0){
            return back()->with('error','Stok buku habis');
        }

        $petugas = Petugas::where('user_id',auth()->id())->first();

        $buku->decrement('stok');

        $peminjaman->update([

            'status' => 'dipinjam',
            'id_petugas' => $petugas->id_petugas,
            'tanggal_pinjam' => Carbon::now(),
            'tanggal_jatuh_tempo' => Carbon::now()->addDays(7)

        ]);

        return back()->with('success','Peminjaman disetujui');

    }



    /*
    ==========================
    TOLAK
    ==========================
    */

    public function tolak($id)
    {

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'ditolak'
        ]);

        return back()->with('success','Peminjaman ditolak');

    }



    /*
    ==========================
    TERLAMBAT MANUAL
    ==========================
    */

    public function terlambat($id)
    {

        $peminjaman = Peminjaman::findOrFail($id);

        if($peminjaman->status != 'dipinjam'){
            return back()->with('error','Status tidak valid');
        }

        $hari = Carbon::parse($peminjaman->tanggal_jatuh_tempo)
                ->diffInDays(Carbon::now());

        if($hari < 1){
            $hari = 1;
        }

        $denda = $hari * 2000;

        $peminjaman->update([

            'status' => 'terlambat',
            'denda' => $denda

        ]);

        return back()->with('success','Status diubah menjadi terlambat');

    }



    /*
    ==========================
    BAYAR DENDA
    ==========================
    */

    public function bayarDenda(Request $request, $id)
    {

        $peminjaman = Peminjaman::findOrFail($id);

        if($peminjaman->denda <= 0){
            return back()->with('error','Tidak ada denda yang harus dibayar');
        }

        $peminjaman->update([
            'status_bayar' => 'sudah',
            'metode_bayar' => $request->metode_bayar
        ]);

        return back()->with('success','Denda berhasil dibayar');

    }



    /*
    ==========================
    KEMBALIKAN
    ==========================
    */

    public function kembalikan($id)
    {

        $peminjaman = Peminjaman::findOrFail($id);
        $buku = Buku::findOrFail($peminjaman->id_buku);

        if($peminjaman->denda > 0 && $peminjaman->status_bayar != 'sudah'){
            return back()->with('error','Denda belum dibayar');
        }

        $peminjaman->update([

            'status' => 'dikembalikan',
            'tanggal_kembali' => now()

        ]);

        $buku->increment('stok');

        return back()->with('success','Buku berhasil dikembalikan');

    }



    /*
    ==========================
    DETAIL
    ==========================
    */

    public function show($id)
    {

        $peminjaman = Peminjaman::with(['anggota','buku','petugas'])
        ->findOrFail($id);

        return view('backend.peminjaman.show',compact('peminjaman'));

    }



    /*
    ==========================
    DELETE
    ==========================
    */

    public function destroy($id)
    {

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->delete();

        return back()->with('success','Data berhasil dihapus');

    }

}
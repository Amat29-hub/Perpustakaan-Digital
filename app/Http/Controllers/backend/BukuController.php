<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{

    public function index()
    {
        $buku = Buku::orderBy('id_buku','desc')->get();

        return view('backend.databuku.index', compact('buku'));
    }


    public function create()
    {
        $bukuTerakhir = Buku::orderBy('id_buku','desc')->first();

        if($bukuTerakhir){
            $angka = substr($bukuTerakhir->kode_buku, 2) + 1;
            $kode = 'BK'.str_pad($angka,3,'0',STR_PAD_LEFT);
        }else{
            $kode = 'BK001';
        }

        return view('backend.databuku.create', compact('kode'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok' => 'required|integer|min:0',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);


        $lastBuku = Buku::orderBy('kode_buku','desc')->first();

        if ($lastBuku) {
            $lastNumber = (int) substr($lastBuku->kode_buku, 2);
            $kode_buku = 'BK'.str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $kode_buku = 'BK001';
        }


        /*
        STATUS OTOMATIS
        */

        $status = $request->stok > 0 ? 'tersedia' : 'tidak_tersedia';


        /*
        UPLOAD COVER
        */

        $cover = null;

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover')->store('cover_buku','public');
        }


        Buku::create([
            'kode_buku' => $kode_buku,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'status' => $status,
            'cover' => $cover
        ]);


        return redirect()->route('admin.databuku.index')
        ->with('success','Data buku berhasil ditambahkan');
    }


    public function show($id)
    {
        $buku = Buku::findOrFail($id);

        return view('backend.databuku.show', compact('buku'));
    }


    public function edit($id)
    {
        $buku = Buku::findOrFail($id);

        return view('backend.databuku.edit', compact('buku'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok' => 'required|integer|min:0',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);


        $buku = Buku::findOrFail($id);


        $status = $request->stok > 0 ? 'tersedia' : 'tidak_tersedia';


        if($request->hasFile('cover')){

            if($buku->cover){
                Storage::disk('public')->delete($buku->cover);
            }

            $cover = $request->file('cover')->store('cover_buku','public');

            $buku->cover = $cover;
        }


        $buku->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'status' => $status
        ]);


        return redirect()->route('admin.databuku.index')
        ->with('success','Data buku berhasil diupdate');
    }


    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }

        $buku->delete();

        return redirect()->route('admin.databuku.index')
        ->with('success','Data buku berhasil dihapus');
    }

}
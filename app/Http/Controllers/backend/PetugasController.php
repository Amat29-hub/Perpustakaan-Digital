<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{

    public function index()
    {
        $petugas = Petugas::all();
        return view('backend.datapetugas.index', compact('petugas'));
    }


    public function create()
    {
        // generate kode otomatis
        $last = Petugas::orderBy('id_petugas', 'desc')->first();

        if ($last && $last->kode_petugas) {
            $number = (int) substr($last->kode_petugas, 4) + 1;
        } else {
            $number = 1;
        }

        $kode = 'PTG-' . str_pad($number, 3, '0', STR_PAD_LEFT);

        return view('backend.datapetugas.create', compact('kode'));
    }


    public function store(Request $request)
    {

        // VALIDASI
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ], [
            'email.unique' => 'Email sudah digunakan!'
        ]);


        // upload foto
        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('petugas', 'public');
        }


        // 🔥 BUAT USER LOGIN
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas'
        ]);


        // 🔥 SIMPAN DATA PETUGAS
        Petugas::create([
            'user_id' => $user->id,
            'kode_petugas' => $request->kode_petugas,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'foto' => $foto,
            'status' => $request->status ?? 'aktif'
        ]);


        return redirect()->route('admin.datapetugas.index')
            ->with('success', 'Data petugas berhasil ditambahkan');
    }


    public function show(string $id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('backend.datapetugas.show', compact('petugas'));
    }


    public function edit(string $id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('backend.datapetugas.edit', compact('petugas'));
    }


    public function update(Request $request, string $id)
    {

        $petugas = Petugas::findOrFail($id);

        // VALIDASI
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:petugas,email,' . $id . ',id_petugas'
        ], [
            'email.unique' => 'Email sudah digunakan!'
        ]);


        // update foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('petugas', 'public');
            $petugas->foto = $foto;
        }


        // update data petugas
        $petugas->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'status' => $request->status
        ]);


        // update password jika diisi
        if ($request->password) {

            $petugas->password = Hash::make($request->password);
            $petugas->save();

            // update password user juga
            $user = User::find($petugas->user_id);
            $user->password = Hash::make($request->password);
            $user->save();
        }


        // update user name & email
        $user = User::find($petugas->user_id);
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->save();


        return redirect()->route('admin.datapetugas.index')
            ->with('success', 'Data petugas berhasil diupdate');
    }


    public function destroy(string $id)
    {

        $petugas = Petugas::findOrFail($id);

        // hapus user juga
        User::where('id', $petugas->user_id)->delete();

        $petugas->delete();

        return redirect()->route('admin.datapetugas.index')
            ->with('success', 'Data petugas berhasil dihapus');
    }


    // 🔥 TOGGLE STATUS AKTIF / NONAKTIF
    public function toggle($id)
    {

        $petugas = Petugas::findOrFail($id);

        $petugas->status = $petugas->status === 'aktif' ? 'nonaktif' : 'aktif';

        $petugas->save();

        return redirect()->back()
            ->with('success', 'Status berhasil diubah');
    }

}
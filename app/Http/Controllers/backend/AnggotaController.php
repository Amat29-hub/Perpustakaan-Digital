<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::all();
        return view('backend.dataanggota.index', compact('anggota'));
    }

    public function create()
    {
        $last = Anggota::orderBy('id_anggota', 'desc')->first();

        if ($last && $last->kode_anggota) {
            $number = (int) substr($last->kode_anggota, 3) + 1;
        } else {
            $number = 1;
        }

        $kode = 'AG-' . str_pad($number, 4, '0', STR_PAD_LEFT);

        return view('backend.dataanggota.create', compact('kode'));
    }

        public function store(Request $request)
        {
            $request->validate([
                'nama' => 'required',
                'email' => 'nullable|email|unique:anggotas,email',
                'password' => 'required|min:6'
            ], [
                'email.unique' => 'Email sudah digunakan, silakan pakai email lain!'
            ]);
        
            $data = $request->all();
        
            // upload foto
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $data['foto'] = $file->store('anggota', 'public');
            }
        
            // hash password
            $data['password'] = bcrypt($request->password);
        
            Anggota::create($data);
        
            return redirect()->route('admin.dataanggota.index')
                             ->with('success', 'Data anggota berhasil ditambahkan');
        }

    public function show(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('backend.dataanggota.show', compact('anggota'));
    }

    public function edit(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('backend.dataanggota.edit', compact('anggota'));
    }

    public function update(Request $request, string $id)
    {
        $anggota = Anggota::findOrFail($id);
    
        $request->validate([
            'nama' => 'required',
            'email' => 'nullable|email|unique:anggotas,email,' . $id . ',id_anggota',
        ], [
            'email.unique' => 'Email sudah digunakan, silakan pakai email lain!'
        ]);
    
        $data = $request->all();
    
        // 📸 upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $data['foto'] = $file->store('anggota', 'public');
        }
    
        // 🔐 password opsional
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }
    
        $anggota->update($data);
    
        return redirect()->route('admin.dataanggota.index')
                         ->with('success', 'Data anggota berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('admin.dataanggota.index')
                         ->with('success', 'Data anggota berhasil dihapus');
    }

    public function toggle($id)
    {
        $anggota = Anggota::findOrFail($id);
    
        $anggota->status = $anggota->status == 'aktif' ? 'nonaktif' : 'aktif';
        $anggota->save();
    
        return redirect()->back();
    }
}
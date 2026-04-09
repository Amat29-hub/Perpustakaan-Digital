@extends('backend.layout.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-white mb-0">Tambah Petugas</h4>

            <a href="{{ route('admin.datapetugas.index') }}" class="btn btn-danger btn-sm">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.datapetugas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Kode Petugas --}}
            <div class="mb-3">
                <label class="form-label">Kode Petugas</label>
                <input 
                    type="text" 
                    class="form-control bg-dark text-white border-0"
                    value="{{ $kode }}"
                    readonly
                >
                <input type="hidden" name="kode_petugas" value="{{ $kode }}">
            </div>

            {{-- Nama --}}
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input 
                    type="text"
                    name="nama"
                    class="form-control bg-dark text-white border-0"
                    placeholder="Masukkan nama"
                    required
                >
            </div>

            {{-- Jenis Kelamin 🔥 --}}
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select 
                    name="jenis_kelamin" 
                    class="form-select bg-dark text-white border-0"
                    required
                >
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            {{-- Jabatan --}}
            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <select 
                    name="jabatan" 
                    class="form-select bg-dark text-white border-0"
                    required
                >
                    <option value="">-- Pilih Jabatan --</option>
            
                    <option value="admin" {{ old('jabatan') == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
            
                    <option value="petugas" {{ old('jabatan') == 'petugas' ? 'selected' : '' }}>
                        Petugas
                    </option>
                </select>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input 
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control bg-dark text-white border-0 @error('email') is-invalid @enderror"
                    placeholder="Masukkan email"
                >

                @error('email')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input 
                    type="password"
                    name="password"
                    class="form-control bg-dark text-white border-0"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            {{-- No Telepon --}}
            <div class="mb-3">
                <label class="form-label">No Telepon</label>
                <input 
                    type="text"
                    name="no_telp"
                    class="form-control bg-dark text-white border-0"
                    placeholder="08xxxxxxxxxx"
                >
            </div>

            {{-- Alamat --}}
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea 
                    name="alamat"
                    class="form-control bg-dark text-white border-0"
                    rows="3"
                    placeholder="Masukkan alamat lengkap"
                ></textarea>
            </div>

            {{-- Foto --}}
            <div class="mb-3">
                <label class="form-label">Foto</label>
                <input 
                    type="file"
                    name="foto"
                    class="form-control"
                    accept="image/*"
                    onchange="previewFoto(event)"
                >

                <img 
                    id="fotoPreview"
                    src="https://via.placeholder.com/120?text=Foto"
                    class="mt-3 rounded-circle"
                    style="height:120px; width:120px; object-fit:cover;"
                >
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="form-label d-block">Status</label>

                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="status" 
                        value="aktif" 
                        checked
                    >
                    <label class="form-check-label">Aktif</label>
                </div>

                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="status" 
                        value="nonaktif"
                    >
                    <label class="form-check-label">Nonaktif</label>
                </div>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i> Simpan Petugas
            </button>

        </form>

    </div>
</div>

{{-- Preview Foto --}}
<script>
function previewFoto(event) {
    const reader = new FileReader();

    reader.onload = function () {
        document.getElementById('fotoPreview').src = reader.result;
    };

    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
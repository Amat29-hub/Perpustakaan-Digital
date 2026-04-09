@extends('backend.layout.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4 shadow">

        {{-- Title --}}
        <h5 class="mb-4">Edit Petugas</h5>

        {{-- Back Button --}}
        <a 
            href="{{ route('admin.datapetugas.index') }}" 
            class="btn btn-danger btn-sm mb-3"
        >
            Kembali
        </a>

        <form 
            action="{{ route('admin.datapetugas.update', $petugas->id_petugas) }}" 
            method="POST" 
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- Kode Petugas --}}
            <div class="mb-3">
                <label class="form-label">Kode Petugas</label>
                <input 
                    type="text"
                    value="{{ $petugas->kode_petugas }}"
                    class="form-control bg-dark text-white border-0"
                    readonly
                >
            </div>

            {{-- Nama --}}
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input 
                    type="text"
                    name="nama"
                    value="{{ $petugas->nama }}"
                    class="form-control bg-dark text-white border-0"
                >
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input 
                    type="email"
                    name="email"
                    value="{{ old('email', $petugas->email) }}"
                    class="form-control bg-dark text-white border-0 @error('email') is-invalid @enderror"
                >
            
                @error('email')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label">Password (opsional)</label>
                <input 
                    type="password"
                    name="password"
                    class="form-control bg-dark text-white border-0"
                    placeholder="Kosongkan jika tidak ingin mengubah"
                >
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
            
                    <option value="admin" {{ $petugas->jabatan == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
            
                    <option value="petugas" {{ $petugas->jabatan == 'petugas' ? 'selected' : '' }}>
                        Petugas
                    </option>
                </select>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select 
                    name="jenis_kelamin" 
                    class="form-select bg-dark text-white"
                >
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ $petugas->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $petugas->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            {{-- No Telp --}}
            <div class="mb-3">
                <label class="form-label">No Telepon</label>
                <input 
                    type="text"
                    name="no_telp"
                    value="{{ $petugas->no_telp }}"
                    class="form-control bg-dark text-white border-0"
                >
            </div>

            {{-- Alamat --}}
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea 
                    name="alamat"
                    class="form-control bg-dark text-white border-0"
                >{{ $petugas->alamat }}</textarea>
            </div>

            {{-- Foto --}}
            <div class="mb-3">
                <label class="form-label">Foto</label>

                <div class="mb-2">
                    @if($petugas->foto)
                        <img 
                            src="{{ asset('storage/'.$petugas->foto) }}" 
                            width="70"
                            class="rounded-circle"
                            style="height:70px; object-fit:cover;"
                        >
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </div>

                <input 
                    type="file"
                    name="foto"
                    class="form-control"
                    onchange="previewFoto(event)"
                >

                <img 
                    id="preview"
                    class="mt-2 rounded-circle"
                    style="width:70px; height:70px; object-fit:cover; display:none;"
                >
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>

                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="status" 
                        value="aktif"
                        {{ $petugas->status == 'aktif' ? 'checked' : '' }}
                    >
                    <label class="form-check-label">Aktif</label>
                </div>

                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="status" 
                        value="nonaktif"
                        {{ $petugas->status == 'nonaktif' ? 'checked' : '' }}
                    >
                    <label class="form-check-label">Nonaktif</label>
                </div>
            </div>

            {{-- Submit --}}
            <button class="btn btn-success">
                Simpan Perubahan
            </button>

        </form>

    </div>
</div>

{{-- Preview Foto --}}
<script>
function previewFoto(event) {
    const reader = new FileReader();

    reader.onload = function () {
        const output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = 'block';
    };

    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
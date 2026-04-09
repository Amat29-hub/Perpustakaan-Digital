@extends('backend.layout.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4 shadow">

        {{-- Title --}}
        <h4 class="text-center mb-4">
            👨‍💼 Detail Petugas
        </h4>

        {{-- Foto --}}
        <div class="text-center mb-4">
            @if($petugas->foto)
                <img 
                    src="{{ asset('storage/'.$petugas->foto) }}"
                    class="img-fluid rounded-circle shadow"
                    style="width:120px; height:120px; object-fit:cover;"
                >
            @else
                <img 
                    src="https://via.placeholder.com/120?text=No+Image"
                    class="img-fluid rounded-circle shadow"
                    style="width:120px; height:120px; object-fit:cover;"
                >
            @endif
        </div>

        <hr>

        {{-- Detail --}}
        <div class="row">
            <div class="col-md-4 text-start">

                <div class="mb-3">
                    <small class="text-muted">Kode Petugas</small>
                    <div class="text-white fw-semibold">
                        {{ $petugas->kode_petugas ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Nama Lengkap</small>
                    <div class="text-white fw-semibold">
                        {{ $petugas->nama }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Email</small>
                    <div class="text-white fw-semibold">
                        {{ $petugas->email ?? '-' }}
                    </div>
                </div>

                {{-- ✅ TAMBAHAN JABATAN --}}
                <div class="mb-3">
                    <small class="text-muted">Jabatan</small>
                    <div class="text-white fw-semibold">
                        {{ $petugas->jabatan ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Jenis Kelamin</small>
                    <div class="text-white fw-semibold">
                        {{ $petugas->jenis_kelamin ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">No Telepon</small>
                    <div class="text-white fw-semibold">
                        {{ $petugas->no_telp ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Alamat</small>
                    <div class="text-white fw-semibold">
                        {{ $petugas->alamat ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Status</small>
                    <div class="text-white fw-semibold">
                        @if($petugas->status == 'aktif')
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <hr>

        {{-- Button --}}
        <div class="text-center mt-4">
            <a 
                href="{{ route('admin.datapetugas.index') }}" 
                class="btn btn-secondary px-4"
            >
                ← Kembali
            </a>

            <a 
                href="{{ route('admin.datapetugas.edit', $petugas->id_petugas) }}" 
                class="btn btn-warning px-4"
            >
                Edit
            </a>
        </div>

    </div>
</div>
@endsection
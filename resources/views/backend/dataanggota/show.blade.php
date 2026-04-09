@extends('backend.layout.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4 shadow">

        {{-- Title --}}
        <h4 class="text-center mb-4">
            👤 Detail Anggota
        </h4>

        {{-- Foto --}}
        <div class="text-center mb-4">
            @if($anggota->foto)
                <img 
                    src="{{ asset('storage/'.$anggota->foto) }}"
                    class="img-fluid rounded-circle shadow"
                    style="width:120px; height:120px; object-fit:cover;"
                >
            @else
                <img 
                    src="https://via.placeholder.com/120?text=No+Image"
                    class="img-fluid rounded shadow"
                >
            @endif
        </div>

        <hr>

        {{-- Detail --}}
        <div class="row">
            <div class="col-md-4 text-start">

                <div class="mb-3">
                    <small class="text-muted">Kode Anggota</small>
                    <div class="text-white fw-semibold">
                        {{ $anggota->kode_anggota }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Nama Lengkap</small>
                    <div class="text-white fw-semibold">
                        {{ $anggota->nama }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Email</small>
                    <div class="text-white fw-semibold">
                        {{ $anggota->email ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Kelas</small>
                    <div class="text-white fw-semibold">
                        {{ $anggota->kelas ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Jenis Kelamin</small>
                    <div class="text-white fw-semibold">
                        {{ $anggota->jenis_kelamin ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">No Telepon</small>
                    <div class="text-white fw-semibold">
                        {{ $anggota->no_telp ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Alamat</small>
                    <div class="text-white fw-semibold">
                        {{ $anggota->alamat ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Status</small>
                    <div class="text-white fw-semibold">
                        @if($anggota->status == 'aktif')
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
                href="{{ route('admin.dataanggota.index') }}" 
                class="btn btn-secondary px-4"
            >
                ← Kembali
            </a>

            <a 
                href="{{ route('admin.dataanggota.edit', $anggota->id_anggota) }}" 
                class="btn btn-warning px-4"
            >
                Edit
            </a>
        </div>

    </div>
</div>
@endsection
@extends('backend.layout.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4 shadow">

        {{-- Title --}}
        <h4 class="text-center mb-4">
            📖 Detail Buku
        </h4>

        {{-- Cover --}}
        <div class="text-center mb-4">
            <img 
                src="{{ asset('storage/'.$buku->cover) }}"
                class="img-fluid rounded shadow"
                style="width:120px; height:auto;"
            >
        </div>

        <hr>

        {{-- Detail --}}
        <div class="row">
            <div class="col-md-4 text-start">

                <div class="mb-3">
                    <small class="text-muted">Kode Buku</small>
                    <div class="text-white fw-semibold">
                        {{ $buku->kode_buku }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Judul Buku</small>
                    <div class="text-white fw-semibold">
                        {{ $buku->judul }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Kategori</small>
                    <div class="text-white fw-semibold">
                        {{ $buku->kategori }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Penulis</small>
                    <div class="text-white fw-semibold">
                        {{ $buku->penulis }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Penerbit</small>
                    <div class="text-white fw-semibold">
                        {{ $buku->penerbit }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Tahun Terbit</small>
                    <div class="text-white fw-semibold">
                        {{ $buku->tahun_terbit }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Status</small>
                    <div class="text-white fw-semibold">
                        {{ $buku->status }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Jumlah Stok</small>
                    <div class="text-white fw-semibold">
                        {{ $buku->stok ?? '10' }}
                    </div>
                </div>

            </div>
        </div>

        <hr>

        {{-- Button --}}
        <div class="text-center mt-4">
            <a 
                href="{{ route('admin.databuku.index') }}" 
                class="btn btn-secondary px-4"
            >
                ← Kembali
            </a>

            <a 
                href="{{ route('admin.databuku.edit', $buku->id_buku) }}" 
                class="btn btn-warning px-4"
            >
                Edit
            </a>
        </div>

    </div>
</div>
@endsection
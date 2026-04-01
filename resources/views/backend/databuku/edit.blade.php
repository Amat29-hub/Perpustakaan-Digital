@extends('backend.layout.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4 shadow">

        {{-- Title --}}
        <h5 class="mb-4">Edit Buku</h5>

        {{-- Back Button --}}
        <a 
            href="{{ route('admin.databuku.index') }}" 
            class="btn btn-danger btn-sm mb-3"
        >
            Kembali
        </a>

        <form 
            action="{{ route('admin.databuku.update', $buku->id_buku) }}" 
            method="POST" 
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- Kode Buku --}}
            <div class="mb-3">
                <label class="form-label">Kode Buku</label>
                <input 
                    type="text"
                    name="kode_buku"
                    value="{{ $buku->kode_buku }}"
                    class="form-control bg-dark text-white border-0"
                    readonly
                >
            </div>

            {{-- Judul --}}
            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input 
                    type="text"
                    name="judul"
                    value="{{ $buku->judul }}"
                    class="form-control bg-dark text-white border-0"
                >
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
                <label class="form-label">Kategori</label>

                <select 
                    name="kategori" 
                    class="form-select bg-dark text-white"
                >
                    <option value="">-- Pilih Kategori --</option>

                    <option value="Novel" {{ $buku->kategori == 'Novel' ? 'selected' : '' }}>Novel</option>
                    <option value="Komik" {{ $buku->kategori == 'Komik' ? 'selected' : '' }}>Komik</option>
                    <option value="Pelajaran" {{ $buku->kategori == 'Pelajaran' ? 'selected' : '' }}>Pelajaran</option>
                    <option value="Teknologi" {{ $buku->kategori == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                </select>
            </div>

            {{-- Penulis --}}
            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <input 
                    type="text"
                    name="penulis"
                    value="{{ $buku->penulis }}"
                    class="form-control bg-dark text-white border-0"
                >
            </div>

            {{-- Penerbit --}}
            <div class="mb-3">
                <label class="form-label">Penerbit</label>
                <input 
                    type="text"
                    name="penerbit"
                    value="{{ $buku->penerbit }}"
                    class="form-control bg-dark text-white border-0"
                >
            </div>

            {{-- Tahun Terbit --}}
            <div class="mb-3">
                <label class="form-label">Tahun Terbit</label>
                <input 
                    type="number"
                    name="tahun_terbit"
                    value="{{ $buku->tahun_terbit }}"
                    class="form-control bg-dark text-white border-0"
                >
            </div>

            {{-- Stok --}}
            <div class="mb-3">
                <label class="form-label">Jumlah Stok</label>
                <input 
                    type="number"
                    name="stok"
                    value="{{ $buku->stok }}"
                    class="form-control bg-dark text-white border-0"
                >
            </div>

            {{-- Cover --}}
            <div class="mb-3">
                <label class="form-label">Cover</label>

                <div class="mb-2">
                    <img 
                        src="{{ asset('storage/'.$buku->cover) }}" 
                        width="70"
                    >
                </div>

                <input 
                    type="file"
                    name="cover"
                    class="form-control"
                >
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>

                <div>
                    @if($buku->status == 'tersedia')
                        <span class="badge bg-success">Tersedia</span>

                    @elseif($buku->status == 'dipinjam')
                        <span class="badge bg-warning text-dark">Dipinjam</span>

                    @else
                        <span class="badge bg-danger">Habis</span>
                    @endif
                </div>
            </div>

            {{-- Submit --}}
            <button class="btn btn-success">
                Simpan Buku
            </button>

        </form>

    </div>
</div>
@endsection
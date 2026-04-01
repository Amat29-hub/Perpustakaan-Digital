@extends('backend.layout.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">

        <h4 class="mb-4 text-white">Tambah Buku</h4>

        <a href="{{ route('admin.databuku.index') }}" class="btn btn-danger mb-3">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>

        <form action="{{ route('admin.databuku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Kode Buku --}}
            <div class="mb-3">
                <label>Kode Buku</label>
                <input 
                    type="text" 
                    name="kode_buku" 
                    class="form-control" 
                    value="{{ $kode }}" 
                    readonly
                >
            </div>

            {{-- Judul --}}
            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input 
                    type="text"
                    name="judul"
                    class="form-control bg-dark text-white border-0"
                    required
                >
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select 
                    name="kategori" 
                    class="form-select bg-dark text-white border-0" 
                    required
                >
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Novel">Novel</option>
                    <option value="Komik">Komik</option>
                    <option value="Pelajaran">Pelajaran</option>
                    <option value="Teknologi">Teknologi</option>
                </select>
            </div>

            {{-- Penulis --}}
            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <input 
                    type="text"
                    name="penulis"
                    class="form-control bg-dark text-white border-0"
                    required
                >
            </div>

            {{-- Penerbit --}}
            <div class="mb-3">
                <label class="form-label">Penerbit</label>
                <input 
                    type="text"
                    name="penerbit"
                    class="form-control bg-dark text-white border-0"
                    required
                >
            </div>

            {{-- Tahun Terbit --}}
            <div class="mb-3">
                <label class="form-label">Tahun Terbit</label>
                <input 
                    type="number"
                    name="tahun_terbit"
                    class="form-control bg-dark text-white border-0"
                    min="1900"
                    max="{{ date('Y') }}"
                    required
                >
            </div>

            {{-- Stok --}}
            <div class="mb-3">
                <label class="form-label">Jumlah Stok</label>
                <input 
                    type="number"
                    name="stok"
                    class="form-control bg-dark text-white border-0"
                    min="0"
                    required
                >
            </div>

            {{-- Cover --}}
            <div class="mb-3">
                <label class="form-label">Cover Buku</label>
                <input 
                    type="file"
                    name="cover"
                    class="form-control"
                    accept="image/*"
                    onchange="previewCover(event)"
                >

                <img 
                    id="coverPreview"
                    src="https://via.placeholder.com/120x160?text=Cover"
                    class="mt-3 rounded"
                    style="height:160px"
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
                        value="tersedia" 
                        checked
                    >
                    <label class="form-check-label">Tersedia</label>
                </div>

                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="status" 
                        value="tidak_tersedia"
                    >
                    <label class="form-check-label">Tidak Tersedia</label>
                </div>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i> Simpan Buku
            </button>
        </form>

    </div>
</div>

{{-- Script Preview Cover --}}
<script>
    function previewCover(event) {
        const reader = new FileReader();

        reader.onload = function () {
            const output = document.getElementById('coverPreview');
            output.src = reader.result;
        };

        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
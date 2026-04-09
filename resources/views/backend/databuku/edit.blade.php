@extends('backend.layout.app')

@section('content')

<div class="container-fluid pt-4 px-4">
<div class="bg-secondary rounded p-4">

<h4 class="mb-4 text-white">Edit Buku</h4>

<a href="{{ route('admin.databuku.index') }}" class="btn btn-danger mb-3">
<i class="fa fa-arrow-left"></i> Kembali
</a>

@if ($errors->any())

<div class="alert alert-danger">
<ul class="mb-0">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form action="{{ route('admin.databuku.update',$buku->id_buku) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

{{-- Kode Buku --}}

<div class="mb-3">
<label class="form-label">Kode Buku</label>

<input
type="text"
value="{{ $buku->kode_buku }}"
class="form-control bg-dark text-white border-0"
readonly
style="cursor:not-allowed"

>

</div>

{{-- Judul --}}

<div class="mb-3">
<label class="form-label">Judul Buku</label>

<input
type="text"
name="judul"
value="{{ old('judul',$buku->judul) }}"
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

<option value="Novel" {{ $buku->kategori=='Novel'?'selected':'' }}>Novel</option>

<option value="Komik" {{ $buku->kategori=='Komik'?'selected':'' }}>Komik</option>

<option value="Pelajaran" {{ $buku->kategori=='Pelajaran'?'selected':'' }}>Pelajaran</option>

<option value="Teknologi" {{ $buku->kategori=='Teknologi'?'selected':'' }}>Teknologi</option>

</select>

</div>

{{-- Penulis --}}

<div class="mb-3">

<label class="form-label">Penulis</label>

<input
type="text"
name="penulis"
value="{{ old('penulis',$buku->penulis) }}"
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
value="{{ old('penerbit',$buku->penerbit) }}"
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
value="{{ old('tahun_terbit',$buku->tahun_terbit) }}"
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
value="{{ old('stok',$buku->stok) }}"
class="form-control bg-dark text-white border-0"
min="0"
required

>

<small class="text-warning">
Jika stok 0 maka status buku otomatis Tidak Tersedia
</small>

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

<br>

@if($buku->cover)

<img
src="{{ asset('storage/'.$buku->cover) }}"
id="coverPreview"
class="rounded"
style="height:160px"

>

@else

<img
src="https://via.placeholder.com/120x160?text=Cover"
id="coverPreview"
class="rounded"
style="height:160px"

>

@endif

</div>

<button type="submit" class="btn btn-success">
<i class="fa fa-save"></i> Update Buku
</button>

</form>

</div>
</div>

<script>

function previewCover(event){

const reader = new FileReader();

reader.onload = function(){

const output = document.getElementById('coverPreview');

output.src = reader.result;

};

reader.readAsDataURL(event.target.files[0]);

}

</script>

@endsection
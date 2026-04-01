<!DOCTYPE html>
<html>
<head>
    <title>Detail Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<div class="card shadow">
<div class="card-body">

<div class="row">

<div class="col-md-4">
<img src="https://via.placeholder.com/250x350" class="img-fluid">
</div>

<div class="col-md-8">

<h3>{{ $buku->judul }}</h3>

<table class="table">

<tr>
<td>Kategori</td>
<td>Novel</td>
</tr>

<tr>
<td>Tahun Terbit</td>
<td>{{ $buku->tahun_terbit }}</td>
</tr>

<tr>
<td>Pengarang</td>
<td>{{ $buku->pengarang }}</td>
</tr>

<tr>
<td>Penerbit</td>
<td>{{ $buku->penerbit }}</td>
</tr>

<tr>
<td>Stok</td>
<td>5</td>
</tr>

</table>

<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pinjamModal">
Pinjam Buku
</button>

</div>

</div>

<hr>

<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
Buku ini menceritakan kisah inspiratif tentang perjuangan 
anak-anak Belitung dalam mengejar pendidikan.
</p>

</div>
</div>

</div>

</body>
</html>
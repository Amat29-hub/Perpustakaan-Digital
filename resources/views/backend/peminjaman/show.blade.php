@extends('backend.layout.app')

@section('content')

<div class="container-fluid pt-4 px-4">

    <h4 class="mb-4 text-white">Detail Peminjaman</h4>

    <div class="bg-secondary rounded p-4">

        <h5 class="mb-4">📄 Informasi Peminjaman</h5>

        @php
            $hariTerlambat = 0;

            if (
                ($peminjaman->status == 'dipinjam' && now()->greaterThan($peminjaman->tanggal_jatuh_tempo)) ||
                $peminjaman->status == 'terlambat'
            ) {
                $hariTerlambat = \Carbon\Carbon::parse($peminjaman->tanggal_jatuh_tempo)
                    ->diffInDays(now());
            }
        @endphp

        <div class="row g-4">

            {{-- INFORMASI PEMINJAMAN --}}
            <div class="col-md-6">
                <div class="bg-dark rounded overflow-hidden">
                    <table class="table table-dark table-striped mb-0">

                        <tr>
                            <th width="160">Kode</th>
                            <td class="text-danger fw-bold">
                                PMJ-{{ str_pad($peminjaman->id_peminjaman, 4, '0', STR_PAD_LEFT) }}
                            </td>
                        </tr>

                        <tr>
                            <th>Tanggal Pinjam</th>
                            <td>
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Jatuh Tempo</th>
                            <td>
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_jatuh_tempo)->format('d M Y') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Tanggal Kembali</th>
                            <td>
                                @if($peminjaman->tanggal_kembali)
                                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}
                                @else
                                    <span class="text-muted">Belum Dikembalikan</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                @if($peminjaman->status == 'menunggu')
                                    <span class="badge bg-info">Menunggu</span>

                                @elseif($peminjaman->status == 'dipinjam')
                                    @if($hariTerlambat > 0)
                                        <span class="badge bg-danger">Terlambat</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Dipinjam</span>
                                    @endif

                                @elseif($peminjaman->status == 'terlambat')
                                    <span class="badge bg-danger">Terlambat</span>

                                @elseif($peminjaman->status == 'dikembalikan')
                                    <span class="badge bg-success">Selesai</span>

                                @elseif($peminjaman->status == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Denda</th>
                            <td>
                                @if($peminjaman->denda > 0)
                                    <span class="text-danger fw-bold">
                                        Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}
                                    </span>
                                @else
                                    Rp 0
                                @endif
                            </td>
                        </tr>

                        {{-- STATUS PEMBAYARAN --}}
                        @if($peminjaman->denda > 0)
                            <tr>
                                <th>Status Pembayaran</th>
                                <td>
                                    @if($peminjaman->status_bayar == 'sudah')
                                        <span class="badge bg-success">Sudah Dibayar</span>
                                    @else
                                        <span class="badge bg-danger">Belum Dibayar</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Metode Pembayaran</th>
                                <td>
                                    @if($peminjaman->metode_bayar)
                                        <span class="text-info">
                                            {{ ucfirst($peminjaman->metode_bayar) }}
                                        </span>
                                    @else
                                        <span class="text-muted">
                                            Belum ada pembayaran
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endif

                        @if($hariTerlambat > 0)
                            <tr>
                                <th>Terlambat</th>
                                <td class="text-danger fw-bold">
                                    {{ $hariTerlambat }} Hari
                                </td>
                            </tr>
                        @endif

                    </table>
                </div>
            </div>

            {{-- DATA ANGGOTA --}}
            <div class="col-md-6">
                <div class="bg-dark rounded overflow-hidden">

                    <div class="p-3 border-bottom">
                        <strong>👤 Data Anggota</strong>
                    </div>

                    <table class="table table-dark table-striped mb-0">
                        <tr>
                            <th width="160">Nama</th>
                            <td>{{ $peminjaman->anggota->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $peminjaman->anggota->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <td>{{ $peminjaman->anggota->no_telp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $peminjaman->anggota->alamat ?? '-' }}</td>
                        </tr>
                    </table>

                </div>
            </div>

            {{-- DATA BUKU --}}
            <div class="col-md-6">
                <div class="bg-dark rounded overflow-hidden">

                    <div class="p-3 border-bottom">
                        <strong>📚 Data Buku</strong>
                    </div>

                    <table class="table table-dark table-striped mb-0">
                        <tr>
                            <th width="160">Judul</th>
                            <td>{{ $peminjaman->buku->judul ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Penulis</th>
                            <td>{{ $peminjaman->buku->penulis ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td>{{ $peminjaman->buku->penerbit ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Terbit</th>
                            <td>{{ $peminjaman->buku->tahun_terbit ?? '-' }}</td>
                        </tr>
                    </table>

                </div>
            </div>

            {{-- DATA PETUGAS --}}
            <div class="col-md-6">
                <div class="bg-dark rounded overflow-hidden">

                    <div class="p-3 border-bottom">
                        <strong>🧑‍💼 Data Petugas</strong>
                    </div>

                    <table class="table table-dark table-striped mb-0">
                        <tr>
                            <th width="160">Nama</th>
                            <td>{{ $peminjaman->petugas->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $peminjaman->petugas->email ?? '-' }}</td>
                        </tr>
                    </table>

                </div>
            </div>

        </div>

        <div class="text-center mt-4">
            <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-secondary px-4">
                ← Kembali
            </a>
        </div>

    </div>
</div>

@endsection
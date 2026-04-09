@extends('backend.layout.app')

@section('content')
<div class="container-fluid pt-4 px-4">

    <div class="row g-4">

        {{-- TOTAL BUKU --}}
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center p-4">
                <i class="fa fa-book fa-3x text-danger"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Buku</p>
                    <h4 class="mb-0">{{ $totalBuku }}</h4>
                </div>
            </div>
        </div>

        {{-- TOTAL ANGGOTA --}}
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center p-4">
                <i class="fa fa-users fa-3x text-danger"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Anggota</p>
                    <h4 class="mb-0">{{ $totalAnggota }}</h4>
                </div>
            </div>
        </div>

        {{-- PEMINJAMAN AKTIF --}}
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center p-4">
                <i class="fa fa-book-reader fa-3x text-danger"></i>
                <div class="ms-3">
                    <p class="mb-2">Peminjaman Aktif</p>
                    <h4 class="mb-0">{{ $peminjamanAktif }}</h4>
                </div>
            </div>
        </div>

        {{-- TOTAL DENDA --}}
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center p-4">
                <i class="fa fa-money-bill-wave fa-3x text-danger"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Denda</p>
                    <h4 class="mb-0">
                        Rp {{ number_format($totalDenda, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>

    </div>

    {{-- PEMINJAMAN TERBARU --}}
    <div class="row mt-4">
        <div class="col-12">

            <div class="bg-secondary rounded p-4">

                <div class="d-flex justify-content-between mb-3">
                    <h5>📖 Peminjaman Terbaru</h5>
                    <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-danger btn-sm">
                        Lihat Semua
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-dark table-bordered text-center align-middle">

                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Tanggal</th>
                                <th>No Peminjaman</th>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Status</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($peminjamanTerbaru as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                    </td>

                                    <td>
                                        <span class="text-info">
                                            PMJ-{{ str_pad($item->id_peminjaman, 4, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>

                                    <td>{{ $item->anggota->nama ?? '-' }}</td>
                                    <td>{{ $item->buku->judul ?? '-' }}</td>

                                    <td>
                                        {{-- STATUS --}}
                                        @if($item->status == 'menunggu')
                                            <span class="badge bg-warning text-dark">Menunggu</span>

                                        @elseif($item->status == 'dipinjam')
                                            @if(\Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->isPast())
                                                <span class="badge bg-danger">Terlambat</span>
                                            @else
                                                <span class="badge bg-success">Dipinjam</span>
                                            @endif

                                        @elseif($item->status == 'dikembalikan')
                                            <span class="badge bg-primary">Dikembalikan</span>

                                        @elseif($item->status == 'ditolak')
                                            <span class="badge bg-secondary">Ditolak</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a 
                                            href="{{ route('admin.peminjaman.show',$item->id_peminjaman) }}"
                                            class="btn btn-info btn-sm">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        Belum ada peminjaman
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection
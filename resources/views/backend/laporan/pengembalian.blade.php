@extends('backend.layout.app')

@section('content')
<div class="container-fluid pt-4 px-4">

    {{-- FILTER TANGGAL --}}
    <div class="bg-secondary rounded p-4 mb-4">
        <form method="GET" action="{{ route('admin.laporan.pengembalian') }}">
            <div class="row g-3 align-items-end">

                <div class="col-md-3">
                    <label class="form-label">Tanggal Awal</label>
                    <input 
                        type="date"
                        name="tanggal_awal"
                        value="{{ $tanggal_awal ?? '' }}"
                        class="form-control">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Tanggal Akhir</label>
                    <input 
                        type="date"
                        name="tanggal_akhir"
                        value="{{ $tanggal_akhir ?? '' }}"
                        class="form-control">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-danger w-100">
                        <i class="fa fa-search"></i> Tampilkan
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('admin.laporan.pengembalian') }}" class="btn btn-dark w-100">
                        Reset
                    </a>
                </div>

                {{-- TOMBOL CETAK --}}
                <div class="col-md-2">
                    <a 
                        href="{{ route('admin.laporan.pengembalian.cetak',[
                            'tanggal_awal'=>$tanggal_awal,
                            'tanggal_akhir'=>$tanggal_akhir
                        ]) }}"
                        target="_blank"
                        class="btn btn-success w-100">

                        <i class="fa fa-print"></i> Cetak
                    </a>
                </div>

            </div>
        </form>
    </div>


    {{-- CARD STATISTIK --}}
    <div class="row g-4">

        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center p-4">
                <i class="fa fa-check-circle fa-3x text-danger"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Pengembalian</p>
                    <h4 class="mb-0">{{ $totalPengembalian ?? 0 }}</h4>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center p-4">
                <i class="fa fa-check fa-3x text-danger"></i>
                <div class="ms-3">
                    <p class="mb-2">Tepat Waktu</p>
                    <h4 class="mb-0">{{ $tepatWaktu ?? 0 }}</h4>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center p-4">
                <i class="fa fa-exclamation-triangle fa-3x text-danger"></i>
                <div class="ms-3">
                    <p class="mb-2">Terlambat</p>
                    <h4 class="mb-0">{{ $terlambat ?? 0 }}</h4>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center p-4">
                <i class="fa fa-money-bill fa-3x text-danger"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Denda</p>
                    <h4 class="mb-0">
                        Rp {{ number_format($totalDenda ?? 0,0,',','.') }}
                    </h4>
                </div>
            </div>
        </div>

    </div>


    {{-- TABEL LAPORAN --}}
    <div class="row mt-4">
        <div class="col-12">

            <div class="bg-secondary rounded p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>
                        <i class="fa fa-chart-bar text-danger"></i> 
                        Tabel Laporan Pengembalian
                    </h5>
                </div>

                <div class="table-responsive">

                    <table class="table table-dark table-bordered text-center align-middle">

                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Tanggal Kembali</th>
                                <th>No Pengembalian</th>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($pengembalians as $item)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $item->tanggal_kembali 
                                            ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') 
                                            : '-' }}
                                    </td>

                                    <td>
                                        <span class="text-info">
                                            PGN-{{ str_pad($item->id_peminjaman,4,'0',STR_PAD_LEFT) }}
                                        </span>
                                    </td>

                                    <td>{{ $item->anggota->nama ?? '-' }}</td>

                                    <td>{{ $item->buku->judul ?? '-' }}</td>

                                    <td>

                                        @if($item->status == 'dikembalikan')
                                            <span class="badge bg-success">
                                                Tepat Waktu
                                            </span>

                                        @elseif($item->status == 'terlambat')
                                            <span class="badge bg-danger">
                                                Terlambat
                                            </span>

                                        @else
                                            <span class="badge bg-secondary">
                                                {{ $item->status }}
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        Tidak ada data laporan
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
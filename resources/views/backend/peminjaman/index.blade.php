@extends('backend.layout.app')

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h5 class="mb-0">📄 Data Peminjaman Buku</h5>

            <form method="GET" class="d-flex gap-2">

                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control form-control-sm"
                    placeholder="Cari anggota / buku"
                >

                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>

                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>
                        Menunggu
                    </option>

                    <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>
                        Dipinjam
                    </option>

                    <option value="terlambat" {{ request('status') == 'terlambat' ? 'selected' : '' }}>
                        Terlambat
                    </option>

                    <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>
                        Selesai
                    </option>

                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>
                        Ditolak
                    </option>
                </select>

                <button class="btn btn-primary btn-sm">
                    Cari
                </button>

            </form>
        </div>

        <div class="table-responsive">

            <table class="table table-dark table-bordered table-hover text-center align-middle">

                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th width="300">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($peminjaman as $item)

                        @php
                            $terlambat = false;
                            $hariTelat = 0;
                            $denda = $item->denda ?? 0;

                            $jatuhTempo = \Carbon\Carbon::parse($item->tanggal_jatuh_tempo);

                            // CEK TERLAMBAT
                            if (
                                ($item->status == 'dipinjam' || $item->status == 'terlambat') &&
                                now()->gt($jatuhTempo)
                            ) {
                                $terlambat = true;
                                $hariTelat = $jatuhTempo->diffInDays(now());
                            }

                            // HITUNG DENDA
                            if ($hariTelat > 0 && $denda == 0) {
                                $denda = $hariTelat * 2000;
                            }
                        @endphp

                        <tr class="{{ $terlambat ? 'table-danger' : '' }}">

                            <td>
                                {{ ($peminjaman->currentPage() - 1) * $peminjaman->perPage() + $loop->iteration }}
                            </td>

                            <td>{{ $item->anggota->nama ?? '-' }}</td>
                            <td>{{ $item->buku->judul ?? '-' }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d-m-Y') }}
                            </td>

                            <td>
                                @if($denda > 0)
                                    <span class="badge bg-danger">
                                        Rp {{ number_format($denda, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td>
                                @if($item->status == 'menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>

                                @elseif($item->status == 'dipinjam' && !$terlambat)
                                    <span class="badge bg-primary">Dipinjam</span>

                                @elseif($item->status == 'dipinjam' && $terlambat)
                                    <span class="badge bg-danger">Terlambat</span>

                                @elseif($item->status == 'terlambat')
                                    <span class="badge bg-danger">Terlambat</span>

                                @elseif($item->status == 'dikembalikan')
                                    <span class="badge bg-success">Selesai</span>

                                @elseif($item->status == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>

                            <td>

                                {{-- MENUNGGU --}}
                                @if($item->status == 'menunggu')
                                    @if(auth()->user()->role == 'petugas' || auth()->user()->role == 'kepala')

                                        <form action="{{ route('admin.peminjaman.setujui', $item->id_peminjaman) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-success btn-sm">
                                                Setujui
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.peminjaman.tolak', $item->id_peminjaman) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-danger btn-sm">
                                                Tolak
                                            </button>
                                        </form>

                                    @endif
                                @endif

                                {{-- DIPINJAM --}}
                                @if($item->status == 'dipinjam')

                                    <form action="{{ route('admin.peminjaman.kembalikan', $item->id_peminjaman) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-warning btn-sm">
                                            Kembalikan
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.peminjaman.terlambat', $item->id_peminjaman) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-danger btn-sm">
                                            Terlambat
                                        </button>
                                    </form>

                                @endif

                                {{-- TERLAMBAT --}}
                                @if($item->status == 'terlambat')

                                    <form action="{{ route('admin.peminjaman.kembalikan', $item->id_peminjaman) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-warning btn-sm">
                                            Kembalikan
                                        </button>
                                    </form>

                                @endif

                                {{-- DETAIL --}}
                                <a 
                                    href="{{ route('admin.peminjaman.show', $item->id_peminjaman) }}"
                                    class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                {{-- DELETE --}}
                                @if(in_array($item->status, ['dikembalikan','ditolak']))
                                    <form 
                                        action="{{ route('admin.peminjaman.destroy', $item->id_peminjaman) }}" 
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                Data peminjaman belum ada
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">
            {{ $peminjaman->links() }}
        </div>

    </div>
</div>

@endsection
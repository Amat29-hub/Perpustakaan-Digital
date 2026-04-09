@extends('frontend.layout.app')

@section('content')

<section class="my-books-section py-5">
    <div class="container text-center"> <div class="header-content mb-5">
            <h2 class="fw-bold display-6 mb-2">📚 Buku Saya</h2>
            <p class="text-muted mx-auto" style="max-width: 500px;">
                Pantau status peminjaman, tenggat waktu, dan kelola koleksi buku Anda.
            </p>
        </div>

        {{-- TAB NAVIGASI - POSISI TENAH --}}
        <div class="d-flex justify-content-center mb-5">
            <div class="tab-wrapper p-2 bg-light rounded-pill shadow-sm border border-white d-inline-flex">
                <div class="tab-pill active" data-tab="menunggu">Menunggu</div>
                <div class="tab-pill" data-tab="dipinjam">Dipinjam</div>
                <div class="tab-pill" data-tab="terlambat">Terlambat</div>
                <div class="tab-pill" data-tab="pengembalian">Selesai</div>
                <div class="tab-pill" data-tab="ditolak">Ditolak</div>
            </div>
        </div>

        {{-- KONTEN TAB --}}
        <div class="tab-container mt-4 text-start"> @php
                $sections = [
                    'menunggu' => $menunggu,
                    'dipinjam' => $dipinjam,
                    'terlambat' => $terlambat,
                    'pengembalian' => $dikembalikan,
                    'ditolak' => $ditolak
                ];
            @endphp

            @foreach($sections as $id => $data)
                <div id="{{ $id }}" class="tab-content {{ $id == 'menunggu' ? '' : 'd-none animate-fade' }}">
                    <div class="row g-4 justify-content-center"> @forelse($data as $item)
                            <div class="col-lg-6 col-xl-5"> <div class="modern-card p-4 h-100 border-0 shadow-sm transition-all">
                                    <div class="d-flex gap-4 align-items-center align-items-md-start">
                                        <div class="flex-shrink-0">
                                            <div class="cover-glow">
                                                <img src="{{ $item->buku->cover ? asset('storage/'.$item->buku->cover) : asset('images/no-book.png') }}" 
                                                     class="rounded-3 shadow-sm" style="width: 100px; height: 140px; object-fit: cover;">
                                            </div>
                                        </div>

                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <h5 class="fw-bold text-dark mb-0 text-truncate" style="max-width: 200px;">{{ $item->buku->judul }}</h5>
                                                @if($id == 'dipinjam')
                                                    <span class="badge bg-primary-soft text-primary rounded-pill px-2 py-1" style="font-size: 10px;">AKTIF</span>
                                                @endif
                                            </div>
                                            <p class="text-muted small mb-3">Oleh: {{ $item->buku->penulis }}</p>

                                            <div class="meta-info p-3 rounded-3 mb-3 border border-light shadow-inner" style="background: rgba(0,0,0,0.02);">
                                                @if($id == 'menunggu')
                                                    <div class="small text-muted text-center"><i class="icon icon-calendar me-2"></i>Diajukan: <strong>{{ $item->created_at->format('d M Y') }}</strong></div>
                                                @elseif($id == 'dipinjam' || $id == 'terlambat' || $id == 'pengembalian')
                                                    <div class="row g-2 text-center text-md-start">
                                                        <div class="col-6 small text-muted border-end">Pinjam: <span class="d-block text-dark fw-bold">{{ $item->tanggal_pinjam->format('d M Y') }}</span></div>
                                                        <div class="col-6 small text-muted">Tempo: <span class="d-block text-dark fw-bold">{{ $item->tanggal_jatuh_tempo->format('d M Y') }}</span></div>
                                                    </div>
                                                @endif
                                            </div>

                                            @if($id == 'menunggu')
                                                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 text-warning fw-bold small">
                                                    <span class="spinner-grow spinner-grow-sm"></span> Menunggu Petugas
                                                </div>
                                            @elseif($id == 'dipinjam')
                                                <form action="{{ route('peminjaman.kembalikan', $item->id_peminjaman) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <button class="btn btn-outline-primary w-100 rounded-pill fw-bold btn-sm" onclick="return confirm('Kembalikan buku ini?')">
                                                        🔄 Kembalikan
                                                    </button>
                                                </form>
                                            @elseif($id == 'terlambat')
                                                <div class="text-danger small fw-bold text-center mb-2">Denda: Rp {{ number_format($item->denda, 0, ',', '.') }}</div>
                                                @if($item->status_bayar != 'sudah')
                                                    <form action="{{ route('peminjaman.bayarDenda', $item->id_peminjaman) }}" method="POST" class="d-flex gap-2">
                                                        @csrf
                                                        <select name="metode_bayar" class="form-select form-select-sm rounded-pill">
                                                            <option value="tempat">Tunai</option>
                                                            <option value="ewallet">E-Wallet</option>
                                                        </select>
                                                        <button class="btn btn-danger btn-sm rounded-pill fw-bold">Bayar</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('peminjaman.kembalikan', $item->id_peminjaman) }}" method="POST">
                                                        @csrf @method('PUT')
                                                        <button class="btn btn-dark w-100 rounded-pill btn-sm fw-bold">Kembalikan Buku</button>
                                                    </form>
                                                @endif
                                            @elseif($id == 'pengembalian')
                                                <div class="text-success fw-bold small text-center"><i class="icon icon-check me-1"></i> Sudah Dikembalikan</div>
                                            @elseif($id == 'ditolak')
                                                <div class="badge bg-danger w-100 rounded-pill p-2">Ditolak</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p class="text-muted">Tidak ada data di kategori ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
    
    .my-books-section { font-family: 'Plus Jakarta Sans', sans-serif; }

    /* TAB CENTERED STYLING */
    .tab-wrapper {
        display: flex;
        gap: 5px;
        max-width: 100%;
    }

    .tab-pill {
        padding: 10px 20px;
        border-radius: 30px;
        cursor: pointer;
        font-weight: 700;
        font-size: 12px;
        color: #64748b;
        transition: all 0.3s ease;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .tab-pill.active {
        background: #4361ee;
        color: white;
        box-shadow: 0 8px 15px rgba(67, 97, 238, 0.2);
    }

    /* CARD GLASSMORPHISM */
    .modern-card {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 24px;
    }

    .modern-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 15px 30px rgba(0,0,0,0.05) !important;
    }

    .bg-primary-soft { background: #eef2ff; }
    .shadow-inner { box-shadow: inset 0 2px 4px rgba(0,0,0,0.03); }

    .animate-fade { animation: fadeIn 0.4s ease forwards; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    /* MOBILE OPTIMIZATION */
    @media (max-width: 768px) {
        .tab-wrapper { 
            overflow-x: auto; 
            -webkit-overflow-scrolling: touch;
            justify-content: flex-start; /* scroll rari kiri jika kepotong di mobile */
        }
        .tab-pill { padding: 8px 15px; font-size: 10px; }
    }
</style>

<script>
    document.querySelectorAll(".tab-pill").forEach(tab => {
        tab.addEventListener("click", function () {
            document.querySelectorAll(".tab-pill").forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            let target = this.dataset.tab;
            document.querySelectorAll(".tab-content").forEach(c => {
                c.classList.add("d-none");
            });

            const targetElement = document.getElementById(target);
            targetElement.classList.remove("d-none");
        });
    });
</script>

@endsection
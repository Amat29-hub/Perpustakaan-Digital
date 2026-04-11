@extends('frontend.layout.app')

@section('content')

@php
$anggota = \App\Models\Anggota::where('user_id', auth()->id())->first();

$jumlahPinjaman = 0;

if($anggota){
    $jumlahPinjaman = \App\Models\Peminjaman::where('id_anggota', $anggota->id_anggota)
                        ->whereIn('status',['menunggu','dipinjam','terlambat'])
                        ->count();
}
@endphp

<div class="container detail-container" style="padding-top: 40px; padding-bottom: 80px;">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-transparent p-0 m-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted small">Katalog</a></li>
            <li class="breadcrumb-item active fw-bold text-primary small" aria-current="page">Detail Buku</li>
        </ol>
    </nav>

    <div class="main-detail-card border-0 shadow-sm mb-5 overflow-hidden">
        <div class="row g-0">
            
            <div class="col-lg-4 col-md-5 d-flex align-items-center justify-content-center p-4 p-lg-5">
                <div class="book-cover-wrapper-detail">
                    @if($buku->cover)
                        <img src="{{ asset('storage/'.$buku->cover) }}" class="img-fluid rounded-3 shadow-lg main-img" alt="{{ $buku->judul }}">
                    @else
                        <img src="{{ asset('assetsfrontend/images/tab-item1.jpg') }}" class="img-fluid rounded-3 shadow-lg main-img" alt="default">
                    @endif
                </div>
            </div>

            <div class="col-lg-8 col-md-7 p-4 p-lg-5">
                <div class="detail-header mb-4">
                    <span class="badge bg-primary-soft text-primary px-3 py-2 rounded-pill fw-bold mb-3" style="font-size: 11px; letter-spacing: 0.5px;">
                        <i class="icon icon-layers me-1"></i> {{ strtoupper($buku->kategori) }}
                    </span>
                    <h1 class="display-6 fw-bold text-dark mb-2">{{ $buku->judul }}</h1>
                    <p class="fs-5 text-muted">Karya <span class="text-primary fw-semibold">{{ $buku->penulis }}</span></p>
                </div>

                <div class="info-specs p-4 rounded-4 mb-4 border border-white" style="background: rgba(255,255,255,0.5);">
                    <div class="row g-4">
                        <div class="col-6 col-sm-4 border-end-sm border-2 border-white text-center text-sm-start">
                            <small class="text-muted fw-bold d-block mb-1 text-uppercase" style="font-size: 10px;">Penerbit</small>
                            <span class="fw-bold text-dark">{{ $buku->penerbit }}</span>
                        </div>
                        <div class="col-6 col-sm-4 border-end-sm border-2 border-white text-center text-sm-start">
                            <small class="text-muted fw-bold d-block mb-1 text-uppercase" style="font-size: 10px;">Tahun</small>
                            <span class="fw-bold text-dark">{{ $buku->tahun_terbit }}</span>
                        </div>
                        <div class="col-12 col-sm-4 text-center text-sm-start">
                            <small class="text-muted fw-bold d-block mb-1 text-uppercase" style="font-size: 10px;">Status Stok</small>
                            <div class="d-flex align-items-center justify-content-center justify-content-sm-start gap-2">
                                <span class="status-pulse {{ $buku->stok > 0 ? 'bg-success' : 'bg-danger' }}"></span>
                                <span class="fw-bold {{ $buku->stok > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $buku->stok > 0 ? 'Tersedia ('.$buku->stok.')' : 'Habis' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-3 mt-4">
                        <button class="btn btn-primary btn-lg px-5 rounded-pill fw-bold shadow-primary" 
                                data-bs-toggle="modal" data-bs-target="#modalPinjam" 
                                {{ ($buku->stok <= 0 || $jumlahPinjaman >= 3) ? 'disabled' : '' }}>
                        <i class="icon icon-book-open me-2"></i> Pinjam Sekarang
                        @if($jumlahPinjaman >= 3)
                        <div class="text-danger small mt-2">
                            Maksimal peminjaman hanya 3 buku
                        </div>
                        @endif
                    </button>
                    <a href="{{ url('/') }}" class="btn btn-outline-dark btn-lg px-4 rounded-pill">
                        <i class="icon icon-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 pt-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h3 class="fw-bold text-dark m-0">Koleksi Terkait</h3>
                <p class="text-muted small m-0">Buku serupa yang mungkin menarik untuk Anda</p>
            </div>
            <div class="header-line d-none d-md-block" style="flex: 1; height: 1px; background: #eee; margin: 0 20px;"></div>
        </div>

        <div class="row g-4">
            @foreach($bukulain ?? [] as $item)
                <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                    <a href="{{ route('buku.detail', $item->id_buku) }}" class="text-decoration-none">
                        <div class="modern-book-card bg-white border-0 shadow-sm">
                            <div class="book-cover-wrapper">
                                <div class="badge-kategori">{{ $item->kategori }}</div>
                                @if($item->cover)
                                    <img src="{{ asset('storage/'.$item->cover) }}" alt="{{ $item->judul }}">
                                @else
                                    <img src="{{ asset('assetsfrontend/images/tab-item1.jpg') }}" alt="default">
                                @endif
                                <div class="book-overlay">
                                    <span class="btn btn-light btn-sm rounded-pill fw-bold px-3">Detail</span>
                                </div>
                            </div>

                            <div class="book-details p-3 p-lg-4">
                                <h6 class="book-title-grid text-dark fw-bold mb-1">{{ $item->judul }}</h6>
                                <p class="text-muted small mb-3 author-truncate">Oleh {{ $item->penulis }}</p>
                                
                                <div class="d-flex justify-content-between align-items-center pt-2 border-top border-light">
                                    <div class="stock-indicator">
                                        <span class="dot {{ $item->stok < 5 ? 'bg-danger' : 'bg-success' }}"></span>
                                        <span class="small fw-600 text-muted" style="font-size: 11px;">Stok {{ $item->stok }}</span>
                                    </div>
                                    <i class="icon icon-arrow-right text-primary small"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="modal fade" id="modalPinjam" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 25px;">
            <div class="modal-header border-0 pt-4 px-4 bg-transparent">
                <h5 class="fw-bold m-0 text-dark">Konfirmasi Pinjam</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 bg-transparent">
                <p class="text-muted small mb-2 text-center">Anda akan meminjam buku:</p>
                <h5 class="fw-bold text-primary text-center mb-4 px-3 lh-base">{{ $buku->judul }}</h5>
                
                <div class="d-flex align-items-center gap-3 p-3 rounded-4 mb-3 border border-white shadow-sm" style="background: rgba(255,255,255,0.6);">
                    <div class="icon-circle bg-white text-primary rounded-circle p-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="icon icon-calendar"></i>
                    </div>
                    <div>
                        <small class="d-block text-muted fw-bold" style="font-size: 10px; text-transform: uppercase;">Durasi Pinjam</small>
                        <span class="fw-bold text-dark">Maksimal 7 Hari</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pb-4 px-4 gap-2 bg-transparent">
                <button class="btn btn-light rounded-pill px-4 flex-grow-1" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('buku.pinjam', $buku->id_buku) }}" method="POST" class="flex-grow-1">
                    @csrf
                    <button type="submit" class="btn btn-primary rounded-pill px-4 w-100 shadow-sm fw-bold">Ya, Ajukan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    /* Font global tetap Jakarta Sans, tapi warna dasar mengikuti induk */
    body { font-family: 'Plus Jakarta Sans', sans-serif; color: #334155; }
    
    /* Global Styles */
    .bg-primary-soft { background: #eff6ff; }
    .shadow-primary { box-shadow: 0 10px 20px rgba(67, 97, 238, 0.25); }
    .dot { width: 7px; height: 7px; border-radius: 50%; display: inline-block; }
    .fw-600 { font-weight: 600; }

    /* Main Card Detail - Background dihapus agar mengikuti template */
    .main-detail-card {
        border-radius: 32px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.02) !important;
    }

    .main-img {
        max-height: 460px; border-radius: 12px;
        box-shadow: 0 20px 45px rgba(0,0,0,0.12);
    }

    /* Status Pulse Animation */
    .status-pulse {
        width: 10px; height: 10px; border-radius: 50%;
        animation: pulse-ring 2s infinite;
    }
    @keyframes pulse-ring {
        0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
        70% { box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
        100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    /* Modern Card Buku Lainnya (Tetap Putih agar Menjolok) */
    .modern-book-card {
        border-radius: 24px;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .modern-book-card:hover { transform: translateY(-10px); }

    .book-cover-wrapper {
        position: relative; aspect-ratio: 3/4; overflow: hidden;
        border-radius: 24px 24px 0 0; background: #f1f5f9;
    }
    .book-cover-wrapper img {
        width: 100%; height: 100%; object-fit: cover; transition: 0.5s ease;
    }
    .modern-book-card:hover .book-cover-wrapper img { transform: scale(1.1); }

    .badge-kategori {
        position: absolute; top: 12px; left: 12px;
        background: white; padding: 4px 10px; border-radius: 8px;
        font-size: 9px; font-weight: 800; color: #4361ee; z-index: 2;
    }

    .book-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.4); display: flex;
        align-items: center; justify-content: center; opacity: 0; transition: 0.3s;
    }
    .modern-book-card:hover .book-overlay { opacity: 1; }

    .book-title-grid {
        font-size: 0.95rem; display: -webkit-box;
        -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    
    .author-truncate { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    /* Button Styling */
    .btn-primary { background: #4361ee; border: none; transition: 0.3s; }
    .btn-primary:hover { background: #374ccf; transform: translateY(-2px); box-shadow: 0 12px 25px rgba(67, 97, 238, 0.3); }

    @media (max-width: 576px) {
        .border-end-sm { border-right: none !important; border-bottom: 2px solid white; padding-bottom: 10px; }
    }
</style>

@endsection
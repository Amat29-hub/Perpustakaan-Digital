@extends('frontend.layout.app')

@section('content')

<!-- ================= BILLBOARD ================= -->
<section id="billboard">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <button class="prev slick-arrow">
                    <i class="icon icon-arrow-left"></i>
                </button>

                <div class="main-slider pattern-overlay">

                    <!-- SLIDE 1 -->
                    <div class="slider-item">
                        <div class="banner-content">
                            <h2 class="banner-title">Laskar Pelangi</h2>
                            <p>mengisahkan petualangan Raib, Seli, dan Ali ke Klan Matahari...</p>

                            <div class="btn-wrap">
                                <a href="#" class="btn btn-outline-accent btn-accent-arrow">
                                    Read More
                                    <i class="icon icon-ns-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                        <img src="{{ asset('assetsfrontend/images/main-banner1.jpg') }}" class="banner-image">
                    </div>

                    <!-- SLIDE 2 -->
                    <div class="slider-item">
                        <div class="banner-content">
                            <h2 class="banner-title">Birds gonna be Happy</h2>
                            <p>Lorem ipsum dolor sit amet...</p>

                            <div class="btn-wrap">
                                <a href="#" class="btn btn-outline-accent btn-accent-arrow">
                                    Read More
                                    <i class="icon icon-ns-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                        <img src="{{ asset('assetsfrontend/images/main-banner2.jpg') }}" class="banner-image">
                    </div>

                </div>

                <button class="next slick-arrow">
                    <i class="icon icon-arrow-right"></i>
                </button>

            </div>
        </div>
    </div>
</section>

<section id="billboard">
    </section>

<section id="popular-books" class="py-5 bg-light">
    <div class="container">
        
        <div class="row mb-5 justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-3 display-5" style="color: #2c3e50;">Perpustakaan Digital</h2>
                <p class="text-muted mb-4">Temukan ribuan literatur berkualitas untuk menunjang wawasan Anda.</p>
                
                <div class="search-container position-relative mx-auto" style="max-width: 600px;">
                    <i class="icon icon-search position-absolute top-50 start-0 translate-middle-y ms-4 text-muted"></i>
                    <input type="text" id="searchInput" class="form-control custom-search-input shadow-sm" placeholder="Cari judul buku atau nama penulis...">
                </div>
            </div>
        </div>

        <div class="category-pills-wrap mb-5 text-center">
            <div class="d-inline-flex flex-wrap justify-content-center gap-2 bg-white p-2 rounded-pill shadow-sm border">
                <button class="btn btn-pill active tab">Semua Buku</button>
                <button class="btn btn-pill tab">Novel</button>
                <button class="btn btn-pill tab">Komik</button>
                <button class="btn btn-pill tab">Pelajaran</button>
                <button class="btn btn-pill tab">Sejarah</button>
            </div>
        </div>

        <div class="row g-4" id="bookGrid">
            @if($buku->count() > 0)
                @foreach($buku as $item)
                    @if($item->stok > 0)
                    <div class="col-xl-3 col-lg-4 col-md-6 book-item">
                        <a href="{{ route('buku.detail', $item->id_buku) }}" class="text-decoration-none">
                            <div class="modern-book-card" 
                                 data-title="{{ strtolower($item->judul) }}"
                                 data-author="{{ strtolower($item->penulis) }}"
                                 data-category="{{ strtolower($item->kategori) }}">
                                
                                <div class="book-cover-wrapper">
                                    <div class="badge-kategori">{{ $item->kategori }}</div>
                                    @if($item->cover)
                                        <img src="{{ asset('storage/'.$item->cover) }}" class="img-fluid" alt="{{ $item->judul }}">
                                    @else
                                        <img src="{{ asset('assetsfrontend/images/tab-item1.jpg') }}" class="img-fluid" alt="default">
                                    @endif
                                    <div class="book-overlay">
                                        <span class="btn btn-light btn-sm rounded-pill fw-bold">Detail Buku</span>
                                    </div>
                                </div>

                                <div class="book-details p-3">
                                    <h6 class="book-title text-dark mb-1">{{ $item->judul }}</h6>
                                    <p class="book-author text-muted small mb-3">Oleh: {{ $item->penulis }}</p>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="stock-indicator">
                                            <span class="dot {{ $item->stok < 5 ? 'bg-danger' : 'bg-success' }}"></span>
                                            <span class="small text-muted">Stok {{ $item->stok }}</span>
                                        </div>
                                        <i class="icon icon-arrow-right text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <div class="empty-state">
                        <h4 class="text-muted">Buku tidak ditemukan</h4>
                        <p>Coba gunakan kata kunci pencarian yang lain.</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-center mt-5">
            <nav class="custom-pagination">
                {{ $buku->links() }}
            </nav>
        </div>

    </div>
</section>

<style>
    /* Search Bar */
    .custom-search-input {
        height: 60px;
        border-radius: 50px !important;
        border: 2px solid transparent;
        padding-left: 60px !important;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    .custom-search-input:focus {
        border-color: #4361ee;
        box-shadow: 0 10px 20px rgba(67, 97, 238, 0.1) !important;
    }

    /* Category Pills */
    .btn-pill {
        border-radius: 50px;
        padding: 8px 24px;
        color: #555;
        font-weight: 500;
        border: none;
        background: transparent;
        transition: all 0.3s ease;
    }
    .btn-pill:hover { background: #f0f2f5; }
    .btn-pill.active {
        background: #4361ee;
        color: white;
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
    }

    /* Modern Book Card */
    .modern-book-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid #edf2f7;
        height: 100%;
    }
    .modern-book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 30px rgba(0,0,0,0.08);
    }

    /* Cover Styling */
    .book-cover-wrapper {
        position: relative;
        aspect-ratio: 3/4;
        overflow: hidden;
        background: #f8f9fa;
    }
    .book-cover-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .modern-book-card:hover .book-cover-wrapper img {
        transform: scale(1.1);
    }

    /* Badge & Overlay */
    .badge-kategori {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        color: #4361ee;
        z-index: 2;
    }
    .book-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(44, 62, 80, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: 0.3s ease;
    }
    .modern-book-card:hover .book-overlay { opacity: 1; }

    /* Text & Info */
    .book-title {
        font-size: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.4;
    }
    .stock-indicator { display: flex; align-items: center; gap: 8px; }
    .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }
</style>

<script>
    // SEARCH ENGINE
    document.getElementById('searchInput').addEventListener('input', function () {
        let keyword = this.value.toLowerCase();
        let items = document.querySelectorAll('.book-item');

        items.forEach(item => {
            let card = item.querySelector('.modern-book-card');
            let title = card.dataset.title;
            let author = card.dataset.author;

            if (title.includes(keyword) || author.includes(keyword)) {
                item.style.display = 'block';
                item.classList.add('fade-in');
            } else {
                item.style.display = 'none';
            }
        });
    });

    // CATEGORY FILTER
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function () {
            // Update UI Tab Active
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            let target = this.innerText.toLowerCase();
            let items = document.querySelectorAll('.book-item');

            items.forEach(item => {
                let category = item.querySelector('.modern-book-card').dataset.category;
                
                if (target === 'semua buku' || category.includes(target)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>

@endsection
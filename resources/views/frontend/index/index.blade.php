@extends('frontend.layout.app')

@section('content')

<!-- ================= BILLBOARD ================= -->
<section id="hero" class="bg-light position-relative overflow-hidden py-5 py-lg-0">
    <div class="container-fluid p-0">
        <div class="row g-0 align-items-center">
            
            <div class="col-lg-6 px-5 py-5 py-lg-8 order-2 order-lg-1">
                <div class="hero-content-inner text-center text-lg-start">
                    <span class="badge mb-4 py-2 px-3 text-uppercase fw-bold letter-spacing-2" style="background: rgba(44, 62, 80, 0.06); color: #2c3e50; font-size: 0.75rem;">Perpustakaan Digital</span>
                    
                    <h1 class="display-3 fw-black text-dark mb-4 mt-2">
                        Pintu Menuju <br> 
                        <span class="text-primary-modern">Dunia Imajinasi.</span>
                    </h1>
                    
                    <p class="lead text-muted mb-5 pe-lg-5">
                        Telusuri koleksi terbaik kami dari penulis dunia. Temukan inspirasi, pengetahuan, dan hiburan tanpa batas di mana saja, kapan saja.
                    </p>
                    
                    <div class="hero-action-group d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-lg-start gap-3">
                        <a href="#popular-books" class="btn btn-primary-modern btn-lg px-5 py-3">
                            Temukan Buku <i class="icon icon-ns-arrow-right ms-2"></i>
                        </a>
                        <div class="user-proof d-flex align-items-center mt-3 mt-sm-0 ms-sm-3">
                        </div>
                    </div>
                    

                </div>
            </div>

            <div class="col-lg-6 position-relative order-1 order-lg-2 h-100 min-vh-lg-80 overflow-hidden bg-primary-modern">
                <div class="book-gallery-wrapper h-100 d-flex justify-content-center align-items-center p-5">
                    
                    <div class="book-card-main-group position-relative">
                        
                        <div class="book-card-item card-1 shadow-lg">
                            <img src="{{ asset('assetsfrontend/images/main-banner1.jpg') }}" alt="Book 1">
                        </div>
                        
                        <div class="book-card-item card-2 shadow floating-anim-1">
                            <img src="{{ asset('assetsfrontend/images/tab-item1.jpg') }}" alt="Book 2">
                        </div>
                        
                        <div class="book-card-item card-3 shadow-lg floating-anim-2">
                            <img src="{{ asset('assetsfrontend/images/main-banner2.jpg') }}" alt="Book 3">
                        </div>

                    </div>
                    
                    <div class="bg-circle-decor"></div>
                </div>
            </div>

        </div>
    </div>
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

    /* BILLBOARD/HERO */
    #hero {
        background: #ffffff;
    }
    .fw-black { font-weight: 900 !important; }
    .text-primary-modern { color: #4361ee; }
    .letter-spacing-2 { letter-spacing: 2px; }
    
    /* Button Modern */
    .btn-primary-modern {
        background: #4361ee;
        color: white;
        border-radius: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 10px 25px rgba(67, 97, 238, 0.25);
    }
    .btn-primary-modern:hover {
        background: #3046c8;
        transform: translateY(-4px);
        box-shadow: 0 15px 30px rgba(67, 97, 238, 0.35);
        color: white;
    }
    
    /* Avatar Group */
    .avatar-group img {
        width: 40px;
        height: 40px;
        margin-right: -10px;
    }
    
    /* Sisi Kanan: Gallery & Visual */
    .min-vh-lg-80 { min-height: 80vh; }
    .bg-primary-modern {
        background: #fcfcfd; /* Ubah background untuk menghindari kesamaan warna */
    }
    
    .book-card-main-group {
        width: 400px;
        height: 500px;
    }
    
    .book-card-item {
        position: absolute;
        border-radius: 20px;
        overflow: hidden;
        background: white;
        border: 8px solid white;
        transition: 0.6s ease;
    }
    
    .book-card-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    /* Card Posisi 1 (Utama) */
    .card-1 {
        width: 250px;
        height: 350px;
        top: 10%;
        left: 10%;
        z-index: 3;
        transform: rotate(-3deg);
    }
    
    /* Card Posisi 2 */
    .card-2 {
        width: 150px;
        height: 200px;
        bottom: 5%;
        right: 5%;
        z-index: 2;
        transform: rotate(5deg);
    }
    
    /* Card Posisi 3 */
    .card-3 {
        width: 200px;
        height: 280px;
        top: -5%;
        right: 15%;
        z-index: 1;
        opacity: 0.8;
        transform: rotate(10deg);
    }
    
    /* Hover Effect on Group */
    .book-card-main-group:hover .card-1 { transform: rotate(0deg) scale(1.03); z-index: 4; }
    .book-card-main-group:hover .card-2 { transform: rotate(0deg) scale(1.05); }
    .book-card-main-group:hover .card-3 { transform: rotate(0deg) scale(1.02); }
    
    /* Decorative Background */
    .bg-circle-decor {
        position: absolute;
        width: 120%;
        height: 120%;
        background: radial-gradient(circle, rgba(67, 97, 238, 0.05) 0%, transparent 70%);
        z-index: -1;
        top: -10%;
        left: -10%;
    }
    
    /* Animations */
    .floating-anim-1 { animation: floating1 4s ease-in-out infinite; }
    .floating-anim-2 { animation: floating2 6s ease-in-out infinite; }
    
    @keyframes floating1 {
        0%, 100% { transform: translateY(0) rotate(5deg); }
        50% { transform: translateY(-15px) rotate(5deg); }
    }
    
    @keyframes floating2 {
        0%, 100% { transform: translateY(0) rotate(10deg); }
        50% { transform: translateY(-10px) rotate(10deg); }
    }
    
    /* Quick Info Ribbon */
    .info-item h4 { color: #2c3e50; }
    .info-item p { color: #888; font-size: 0.8rem; }
    
    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .display-3 { font-size: 2.8rem; }
        .book-card-main-group { width: 300px; height: 380px; }
        .card-1 { width: 180px; height: 260px; left: 0%; top: 5%;}
        .card-2 { width: 120px; height: 160px; right: 0%; }
        .card-3 { width: 150px; height: 210px; top: 0%; right: 10%;}
    }

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
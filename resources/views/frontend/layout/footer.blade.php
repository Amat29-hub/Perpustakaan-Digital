<footer id="lib-main-footer" class="bg-white">
    <div class="container">
        <div class="footer-top py-5">
            <div class="row g-5">

                <div class="col-lg-5 col-md-6">
                    <div class="footer-brand-wrap">
                        <img src="{{ asset('assetsfrontend/images/main-logo.png') }}" class="footer-logo mb-4" alt="Logo" height="45">
                        <p class="text-muted pe-lg-5">
                            Platform perpustakaan digital modern yang memudahkan Anda mengeksplorasi literasi, meminjam buku, dan mengelola koleksi favorit secara online kapan saja.
                        </p>
                        <div class="footer-socials d-flex gap-3 mt-4">
                            <a href="#" class="social-circle"><i class="icon icon-facebook"></i></a>
                            <a href="#" class="social-circle"><i class="icon icon-twitter"></i></a>
                            <a href="#" class="social-circle"><i class="icon icon-youtube-play"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold mb-4">Navigasi</h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('buku.saya') }}">Kelola Peminjaman</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h5 class="fw-bold mb-4">Hubungi Kami</h5>
                    <div class="contact-card p-4 rounded-4 bg-light border-0">
                        <div class="d-flex align-items-center mb-3">
                            <div class="contact-icon bg-primary-modern text-white me-3">
                                <i class="icon icon-envelope"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Email Dukungan</small>
                                <span class="fw-bold text-dark">admin@perpusdigi.com</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="contact-icon bg-primary-modern text-white me-3">
                                <i class="icon icon-phone"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">WhatsApp</small>
                                <span class="fw-bold text-dark">+62 812-3456-7890</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="footer-bottom py-4 border-top">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-muted small">
                        © {{ date('Y') }} <span class="fw-bold text-dark">PerpusDigi</span>. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <p class="mb-0 text-muted small">
                        Didesain dengan <i class="icon icon-heart text-danger"></i> untuk Literasi Bangsa.
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

@push('styles')
<style>
    /* SCOPED FOOTER CSS */
    #lib-main-footer {
        border-top: 1px solid #f1f1f1;
        font-family: 'Inter', sans-serif;
    }

    .bg-primary-modern { background-color: #4361ee !important; }

    /* Brand Styling */
    .footer-logo {
        filter: grayscale(0.2);
        transition: 0.3s;
    }
    .footer-logo:hover { filter: grayscale(0); }

    /* Links Styling */
    .footer-links a {
        color: #6c757d;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
    }
    .footer-links a:hover {
        color: #4361ee;
        transform: translateX(5px);
    }

    /* Social Icons */
    .social-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f8f9fa;
        color: #4a5568;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none !important;
        transition: all 0.3s ease;
        border: 1px solid #edf2f7;
    }
    .social-circle:hover {
        background: #4361ee;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
    }

    /* Contact Card */
    .contact-card {
        transition: 0.3s;
    }
    .contact-card:hover {
        background: #ffffff !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transform: translateY(-5px);
    }
    .contact-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }

    /* Bottom Footer */
    .footer-bottom {
        border-top-color: #f8f9fa !important;
    }
</style>
@endpush
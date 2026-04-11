<div id="header-wrap" class="modern-header bg-white border-bottom sticky-top">
    <header id="header" class="py-2 py-lg-3">
        <div class="container-fluid px-lg-5">
            <div class="row align-items-center">

                <div class="col-6 col-md-3 col-lg-2">
                    <div class="main-logo">
                        <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none">
                            <img src="{{ asset('assetsfrontend/images/main-logo.png') }}" alt="logo" height="35" class="me-2">
                        </a>
                    </div>
                </div>

                <div class="col-6 col-md-9 col-lg-10">
                    <nav id="navbar" class="d-flex align-items-center justify-content-end">
                        
                        <ul class="menu-list d-none d-lg-flex align-items-center list-unstyled mb-0 me-4">
                            <li class="menu-item mx-1">
                                <a href="{{ route('home') }}" class="nav-btn {{ request()->routeIs('home') ? 'active' : '' }}">BERANDA</a>
                            </li>
                            <li class="menu-item mx-1">
                                <a href="{{ route('buku.saya') }}" class="nav-btn {{ request()->routeIs('buku.saya') ? 'active' : '' }}">KELOLA PEMINJAMAN</a>
                            </li>
                        </ul>

                        <div class="dropdown border-start-lg ps-lg-4">
                            <a href="#" class="user-pill d-flex align-items-center text-decoration-none" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar-circle shadow-sm me-2">
                                    <span class="fw-bold text-white tiny">
                                        {{ strtoupper(substr(Auth::user()->name ?? 'AJ', 0, 2)) }}
                                    </span>
                                </div>
                                <span class="fw-bold text-dark small d-none d-md-inline">{{ Auth::user()->name ?? 'Asep Jemping' }}</span>
                                <i class="icon icon-chevron-down ms-1 text-muted small"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-xl mt-3 animate-slide-up">
                                <li class="px-3 py-2 border-bottom mb-1 bg-light rounded-top">
                                    <p class="mb-0 text-muted tiny uppercase tracking-wider">Status Akun</p>
                                    <p class="mb-0 fw-bold text-primary small">Member Aktif</p>
                                </li>
                                <li><hr class="dropdown-divider opacity-50"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger fw-bold">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                        <button class="hamburger d-lg-none btn btn-link p-0 ms-3 border-0 text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNavContent">
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </button>
                    </nav>
                </div>

            </div>

            <div class="collapse d-lg-none" id="mobileNavContent">
                <div class="py-3 border-top mt-2">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">BERANDA</a>
                        </li>
                        <li>
                            <a href="{{ route('buku.saya') }}" class="mobile-nav-link {{ request()->routeIs('buku.saya') ? 'active' : '' }}">KELOLA PEMINJAMAN</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </header>
</div>

<style>
    :root {
        --primary-color: #4361ee;
        --soft-primary: rgba(67, 97, 238, 0.08);
        --text-dark: #1e293b;
        --text-muted: #64748b;
    }

    /* --- DESKTOP STYLES --- */
    .nav-btn {
        text-decoration: none !important;
        color: var(--text-muted) !important;
        font-weight: 700; font-size: 0.8rem;
        padding: 0.7rem 1.4rem; border-radius: 10px;
        transition: 0.3s;
    }
    .nav-btn.active {
        color: white !important;
        background: var(--primary-color) !important;
        box-shadow: 0 8px 15px rgba(67, 97, 238, 0.2);
    }

    /* --- MOBILE STYLES (Fix Bug) --- */
    .mobile-nav-link {
        display: block;
        padding: 12px 15px;
        text-decoration: none !important;
        color: var(--text-dark);
        font-weight: 700;
        font-size: 0.9rem;
        border-radius: 8px;
    }
    .mobile-nav-link.active {
        background: var(--soft-primary);
        color: var(--primary-color);
    }

    /* Avatar & Pill */
    .avatar-circle {
        width: 32px; height: 32px;
        background: var(--primary-color);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
    }
    .user-pill:hover { opacity: 0.8; }

    /* Hamburger Animation */
    .hamburger .bar {
        display: block; width: 22px; height: 2px;
        margin: 5px 0; background-color: var(--text-dark);
        transition: 0.3s;
    }

    /* Dropdown Anim */
    .animate-slide-up { animation: slideUp 0.3s ease-out; }
    @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    @media (min-width: 992px) {
        .border-start-lg { border-left: 1px solid #eee !important; }
    }
</style>
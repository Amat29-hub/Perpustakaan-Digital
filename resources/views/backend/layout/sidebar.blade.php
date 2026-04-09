<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">

        <!-- LOGO -->
        <a href="{{ url('/admin') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">
                <i class="fa fa-book me-2"></i>Perpustakaan
            </h3>
        </a>

        <!-- USER -->
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" 
                     src="{{ asset('assetsbackend/img/user.jpg') }}" 
                     style="width:40px;height:40px;">
                <div class="bg-success rounded-circle border border-2 border-white 
                            position-absolute end-0 bottom-0 p-1"></div>
            </div>

            <div class="ms-3">
                <h6 class="mb-0">Admin</h6>
                <span>Petugas</span>
            </div>
        </div>

        <!-- MENU -->
        <div class="navbar-nav w-100">

            <!-- DASHBOARD -->
            <a href="{{ url('/admin') }}" 
               class="nav-item nav-link {{ request()->is('admin') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            <!-- MAIN DATA -->
            <div class="nav-item dropdown 
                {{ request()->is('admin/databuku*') || request()->is('admin/dataanggota*') || request()->is('admin/datapetugas*') ? 'show' : '' }}">

                <a href="#" 
                   class="nav-link dropdown-toggle 
                   {{ request()->is('admin/databuku*') || request()->is('admin/dataanggota*') || request()->is('admin/datapetugas*') ? 'active' : '' }}" 
                   data-bs-toggle="dropdown">
                    <i class="fa fa-database me-2"></i>Main Data
                </a>

                <div class="dropdown-menu bg-transparent border-0 
                    {{ request()->is('admin/databuku*') || request()->is('admin/dataanggota*') || request()->is('admin/datapetugas*') ? 'show' : '' }}">

                    <a href="{{ url('/admin/databuku') }}" 
                       class="dropdown-item {{ request()->is('admin/databuku*') ? 'active' : '' }}">
                        Data Buku
                    </a>

                    <a href="{{ url('/admin/dataanggota') }}" 
                       class="dropdown-item {{ request()->is('admin/dataanggota*') ? 'active' : '' }}">
                        Data Anggota
                    </a>

                    <a href="{{ url('/admin/datapetugas') }}" 
                       class="dropdown-item {{ request()->is('admin/datapetugas*') ? 'active' : '' }}">
                        Data Petugas
                    </a>

                </div>
            </div>

            <!-- TRANSAKSI -->
            <div class="nav-item dropdown 
                {{ request()->is('admin/peminjaman*') || request()->is('admin/pengembalian*') ? 'show' : '' }}">

                <a href="#" 
                   class="nav-link dropdown-toggle 
                   {{ request()->is('admin/peminjaman*') || request()->is('admin/pengembalian*') ? 'active' : '' }}" 
                   data-bs-toggle="dropdown">
                    <i class="fa fa-exchange-alt me-2"></i>Transaksi
                </a>

                <div class="dropdown-menu bg-transparent border-0 
                    {{ request()->is('admin/peminjaman*') || request()->is('admin/pengembalian*') ? 'show' : '' }}">

                    <a href="{{ url('/admin/peminjaman') }}" 
                       class="dropdown-item {{ request()->is('admin/peminjaman*') ? 'active' : '' }}">
                        Peminjaman  
                    </a>

                </div>
            </div>

            <!-- LAPORAN -->
            <div class="nav-item dropdown 
                {{ request()->is('admin/laporan-peminjaman*') || request()->is('admin/laporan-pengembalian*') ? 'show' : '' }}">

                <a href="#" 
                   class="nav-link dropdown-toggle 
                   {{ request()->is('admin/laporan-peminjaman*') || request()->is('admin/laporan-pengembalian*') ? 'active' : '' }}" 
                   data-bs-toggle="dropdown">
                    <i class="fa fa-file-alt me-2"></i>Laporan
                </a>

                <div class="dropdown-menu bg-transparent border-0 
                    {{ request()->is('admin/laporan-peminjaman*') || request()->is('admin/laporan-pengembalian*') ? 'show' : '' }}">

                    <a href="{{ route('admin.laporan.peminjaman') }}" 
                       class="dropdown-item {{ request()->is('admin/laporan/peminjaman*') ? 'active' : '' }}">
                        Laporan Peminjaman
                    </a>

                    <a href="{{ route('admin.laporan.pengembalian') }}" 
                       class="dropdown-item {{ request()->is('admin/laporan/pengembalian*') ? 'active' : '' }}">
                        Laporan Pengembalian
                    </a>

                </div>
            </div>

        </div>

    </nav>
</div>
<!-- Sidebar End -->
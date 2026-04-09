<div id="header-wrap">

    <!-- TOP CONTENT -->
    <div class="top-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6"></div>

                <div class="col-md-6">
                    <div class="right-element">

                        <div class="dropdown">
                            <a href="#" 
                               class="user-account dropdown-toggle" 
                               data-bs-toggle="dropdown">

                                <i class="icon icon-user"></i>
                                <span>{{ Auth::user()->name ?? 'Account' }}</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>
                                    <a class="dropdown-item" href="#">
                                        Profile
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            Logout
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- HEADER -->
    <header id="header">
        <div class="container-fluid">
            <div class="row">

                <!-- LOGO -->
                <div class="col-md-2">
                    <div class="main-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assetsfrontend/images/main-logo.png') }}" alt="logo">
                        </a>
                    </div>
                </div>

                <!-- NAVBAR -->
                <div class="col-md-10">
                    <nav id="navbar">
                        <div class="main-menu stellarnav d-flex align-items-center">

                            <!-- MENU -->
                            <ul class="menu-list">

                                <!-- HOME -->
                                <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>

                                <!-- KELOLA PEMINJAMAN -->
                                <li class="menu-item {{ request()->routeIs('buku.saya') ? 'active' : '' }}">
                                    <a href="{{ route('buku.saya') }}">
                                        Kelola Peminjaman
                                    </a>
                                </li>

                            </ul>

                            <!-- HAMBURGER -->
                            <div class="hamburger ms-auto">
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                            </div>

                        </div>
                    </nav>
                </div>

            </div>
        </div>
    </header>

</div>
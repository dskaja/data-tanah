<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Sistem Data Tanah & Bangunan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @stack('styles')
</head>
<body>
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="sidebar-logo" style="gap: 12px;">
                <img src="{{ asset('images/logo-logistik.png') }}" alt="Logo Logistik" style="height: 65px; width: auto;">
                <div>
                    <div style="font-size: 1.3rem;">LOGISTIK</div>
                    <div style="font-size: 0.75rem; opacity: 0.8; font-weight: 400;">Data Tanah & Bangunan <br> Polres Pangandaran Tahun 2026</div>
                </div>
            </a>
        </div>

        <nav class="sidebar-menu">
            <ul class="list-unstyled">
                <!-- Dashboard -->
                <li class="menu-item">
                    <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- TANAH -->
                <li class="menu-item">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="fas fa-map-marked-alt"></i>
                        <span>Tanah</span>
                        <i class="fas fa-chevron-down menu-arrow ms-auto"></i>
                    </a>
                    <ul class="submenu list-unstyled">
                        <li>
                            <a href="{{ route('tanah.polres') }}" 
                               class="menu-link {{ request()->routeIs('tanah.polres*') ? 'active' : '' }}">
                                <i class="fas fa-building"></i>
                                <span>Polres</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tanah.polsek') }}" 
                               class="menu-link {{ request()->routeIs('tanah.polsek*') ? 'active' : '' }}">
                                <i class="fas fa-shield-alt"></i>
                                <span>Polsek</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- BANGUNAN -->
                <li class="menu-item">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="fas fa-city"></i>
                        <span>Bangunan</span>
                        <i class="fas fa-chevron-down menu-arrow ms-auto"></i>
                    </a>
                    <ul class="submenu list-unstyled">
                        
                        <!-- BANGUNAN → POLRES -->
                        <li class="menu-item">
                            <a href="#" class="menu-link menu-toggle">
                                <i class="fas fa-building"></i>
                                <span>Polres</span>
                                <i class="fas fa-chevron-down menu-arrow ms-auto"></i>
                            </a>
                            <ul class="submenu list-unstyled">
                                <li>
                                    <a href="{{ route('kantor.polres') }}" class="menu-link {{ request()->routeIs('kantor.polres*') ? 'active' : '' }}">
                                        <i class="fas fa-briefcase"></i>
                                        <span>Kantor</span>
                                    </a>
                                </li>
                                
                                <!-- POLRES → RUMDIN -->
                                <li class="menu-item">
                                    <a href="#" class="menu-link menu-toggle">
                                        <i class="fas fa-home"></i>
                                        <span>Rumdin</span>
                                        <i class="fas fa-chevron-down menu-arrow ms-auto"></i>
                                    </a>
                                    <ul class="submenu list-unstyled">
                                        <li>
                                            <a href="{{ route('rumdin.rusus') }}" 
                                               class="menu-link {{ request()->routeIs('rumdin.rusus*') ? 'active' : '' }}">
                                                <i class="fas fa-door-open"></i>
                                                <span>Rusus</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('rumdin.satpolairud') }}" 
                                               class="menu-link {{ request()->routeIs('rumdin.satpolairud*') ? 'active' : '' }}">
                                                <i class="fas fa-water"></i>
                                                <span>Satpolairud</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- POLRES → BARAK (PINDAHAN) -->
                                <li>
                                    <a href="{{ route('barak.index') }}" class="menu-link {{ request()->routeIs('barak.*') ? 'active' : '' }}">
                                        <i class="fas fa-warehouse"></i>
                                        <span>Barak</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- BANGUNAN → POLSEK -->
                        <li class="menu-item">
                            <a href="#" class="menu-link menu-toggle">
                                <i class="fas fa-shield-alt"></i>
                                <span>Polsek</span>
                                <i class="fas fa-chevron-down menu-arrow ms-auto"></i>
                            </a>
                            <ul class="submenu list-unstyled">
                                
                                <!-- KANTOR POLSEK (9 POLSEK) -->
                                <li class="menu-item">
                                    <a href="#" class="menu-link menu-toggle">
                                        <i class="fas fa-briefcase"></i>
                                        <span>Kantor</span>
                                        <i class="fas fa-chevron-down menu-arrow ms-auto"></i>
                                    </a>
                                    <ul class="submenu list-unstyled">
                                        <li>
                                            <a href="{{ route('kantor.polsek', ['polsek' => 'padaherang']) }}" 
                                               class="menu-link {{ request()->routeIs('kantor.polsek*') && request()->input('polsek') == 'padaherang' ? 'active' : '' }}">
                                                <i class="fas fa-shield-alt"></i>
                                                <span>Polsek Padaherang</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('kantor.polsek', ['polsek' => 'kalipucang']) }}" 
                                               class="menu-link {{ request()->routeIs('kantor.polsek*') && request()->input('polsek') == 'kalipucang' ? 'active' : '' }}">
                                                <i class="fas fa-shield-alt"></i>
                                                <span>Polsek Kalipucang</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('kantor.polsek', ['polsek' => 'pangandaran']) }}" 
                                               class="menu-link {{ request()->routeIs('kantor.polsek*') && request()->input('polsek') == 'pangandaran' ? 'active' : '' }}">
                                                <i class="fas fa-shield-alt"></i>
                                                <span>Polsek Pangandaran</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('kantor.polsek', ['polsek' => 'sidamulih']) }}" 
                                               class="menu-link {{ request()->routeIs('kantor.polsek*') && request()->input('polsek') == 'sidamulih' ? 'active' : '' }}">
                                                <i class="fas fa-shield-alt"></i>
                                                <span>Polsek Sidamulih</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('kantor.polsek', ['polsek' => 'parigi']) }}" 
                                               class="menu-link {{ request()->routeIs('kantor.polsek*') && request()->input('polsek') == 'parigi' ? 'active' : '' }}">
                                                <i class="fas fa-shield-alt"></i>
                                                <span>Polsek Parigi</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('kantor.polsek', ['polsek' => 'cijulang']) }}" 
                                               class="menu-link {{ request()->routeIs('kantor.polsek*') && request()->input('polsek') == 'cijulang' ? 'active' : '' }}">
                                                <i class="fas fa-shield-alt"></i>
                                                <span>Polsek Cijulang</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('kantor.polsek', ['polsek' => 'cigugur']) }}" 
                                               class="menu-link {{ request()->routeIs('kantor.polsek*') && request()->input('polsek') == 'cigugur' ? 'active' : '' }}">
                                                <i class="fas fa-shield-alt"></i>
                                                <span>Polsek Cigugur</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('kantor.polsek', ['polsek' => 'cimerak']) }}" 
                                               class="menu-link {{ request()->routeIs('kantor.polsek*') && request()->input('polsek') == 'cimerak' ? 'active' : '' }}">
                                                <i class="fas fa-shield-alt"></i>
                                                <span>Polsek Cimerak</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('kantor.polsek', ['polsek' => 'langkaplancar']) }}" 
                                               class="menu-link {{ request()->routeIs('kantor.polsek*') && request()->input('polsek') == 'langkaplancar' ? 'active' : '' }}">
                                                <i class="fas fa-shield-alt"></i>
                                                <span>Polsek Langkaplancar</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- POLSEK → RUMDIN -->
                                <li class="menu-item">
                                    <a href="#" class="menu-link menu-toggle">
                                        <i class="fas fa-home"></i>
                                        <span>Rumdin</span>
                                        <i class="fas fa-chevron-down menu-arrow ms-auto"></i>
                                    </a>
                                    <ul class="submenu list-unstyled">
                                        <li>
                                            <a href="{{ route('rumdin.polsek.pangandaran') }}" 
                                               class="menu-link {{ request()->routeIs('rumdin.polsek.pangandaran*') ? 'active' : '' }}">
                                                <i class="fas fa-shield-alt"></i>
                                                <span>Polsek Pangandaran</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('rumdin.polsek.kalipucang') }}" 
                                               class="menu-link {{ request()->routeIs('rumdin.polsek.kalipucang*') ? 'active' : '' }}">
                                                <i class="fas fa-shield-alt"></i>
                                                <span>Polsek Kalipucang</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('rumdin.polsek.sidamulih') }}" 
                                               class="menu-link {{ request()->routeIs('rumdin.polsek.sidamulih*') ? 'active' : '' }}">
                                                <i class="fas fa-shield-alt"></i>
                                                <span>Polsek Sidamulih</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- MUSHOLA (dulu Barak) -->
                <li class="menu-item">
                    <a href="{{ route('mushola.index') }}" class="menu-link {{ request()->routeIs('mushola.*') ? 'active' : '' }}">
                        <i class="fas fa-mosque"></i>
                        <span>Mushola</span>
                    </a>
                </li>

                <!-- GARASI (BARU) - IKON DIPERBAIKI -->
                <li class="menu-item">
                    <a href="{{ route('garasi.index') }}" class="menu-link {{ request()->routeIs('garasi.*') ? 'active' : '' }}">
                        <i class="fas fa-warehouse"></i>
                        <span>Garasi</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar Footer -->
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout-sidebar">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- HEADER DENGAN JUDUL DINAMIS -->
        <div class="content-header">
            <h1>@yield('title', 'Dashboard')</h1>
            <div class="user-info">
                <span>Selamat datang, <strong>{{ Auth::user()->name }}</strong></span>
            </div>
        </div>

        <div class="content-body">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Load custom.js ONLY - semua logic ada di sini -->
    <script src="{{ asset('js/custom.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">Perpustakaan</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">PERP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('/', 'search*', 'profil*', 'myPeminjaman*') ? 'active' : '' }}">
                <a class="nav-link" href="/"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            @can('admin')
                <li class="menu-header">Manajemen Data</li>
                <li class="dropdown {{ Request::is('peminjaman*', 'pengembalian*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-balance-scale"></i><span>Data Transaksi</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('peminjaman*') ? 'active' : '' }}">
                            <a class="nav-link" href="/peminjaman">Data Peminjaman</a>
                        </li>
                        <li class="{{ Request::is('pengembalian*') ? 'active' : '' }}">
                            <a class="nav-link" href="/pengembalian">Data Pengembalian</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown {{ Request::is('kelas*', 'kategori*', 'buku*', 'ebook*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-database"></i><span>Data
                            Master</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('buku*') ? 'active' : '' }}">
                            <a class="nav-link" href="/buku">Data Buku</a>
                        </li>
                        <li class="{{ Request::is('ebook*') ? 'active' : '' }}">
                            <a class="nav-link" href="/ebook">Data E-Book</a>
                        </li>
                        <li class="{{ Request::is('kategori*') ? 'active' : '' }}">
                            <a class="nav-link" href="/kategori">Data Kategori</a>
                        </li>
                        <li class="{{ Request::is('kelas*') ? 'active' : '' }}">
                            <a class="nav-link" href="/kelas">Data Kelas</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown {{ Request::is('guru*', 'siswa*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Data
                            Pengguna</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('guru*') ? 'active' : '' }}">
                            <a class="nav-link" href="/guru">Data Guru</a>
                        </li>
                        <li class="{{ Request::is('siswa*') ? 'active' : '' }}">
                            <a class="nav-link" href="/siswa">Data Siswa</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('wali-kelas')
                <li class="menu-header">Pengawasan Siswa</li>
                <li class="{{ Request::is('wali-kelas*') ? 'active' : '' }}">
                    <a class="nav-link" href="/wali-kelas/{{ auth()->user()->kelas_id }}">
                        <i class="fas fa-user"></i><span>Siswa</span>
                    </a>
                </li>
            @endcan
        </ul>
    </aside>
</div>

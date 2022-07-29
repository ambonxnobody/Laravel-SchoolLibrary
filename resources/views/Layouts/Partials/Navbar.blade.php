<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto" action="/search">
        @csrf
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
            </li>
            <div class="search-element">
                <input class="form-control" type="text" name="search" placeholder="Cari Buku atau E-Book..."
                    aria-label="Search" data-width="250" value="{{ request('search') }}" />
                <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        @auth
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image"
                        src="@if (auth()->user()->photo == null) https://ui-avatars.com/api/?color=00923F&background=E0FCE4&name={{ auth()->user()->name }} @else {{ asset('storage/' . auth()->user()->photo) }} @endif"
                        class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->name }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">Manajemen Akun</div>
                    <a href="/profil/{{ auth()->user()->id }}/edit" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profil
                    </a>
                    @cannot('admin')
                        <a class="dropdown-item has-icon" href="/myPeminjaman/{{ auth()->user()->id }}">
                            <i class="fas fa-shopping-cart"></i> Keranjang Peminjaman
                        </a>
                    @endcannot
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit"
                            class="dropdown-item has-icon text-danger text-small d-flex align-items-center">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        @else
            <li><a class="nav-link has-icon" href="/login"><i class="fas fa-sign-in-alt"></i> Login</a></li>
        @endauth
    </ul>
</nav>

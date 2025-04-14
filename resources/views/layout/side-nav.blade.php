<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="{{ url('/') }}" title="url /">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <div class="sb-sidenav-menu-heading">Pembelian</div>
                    <a class="nav-link" href="{{ route('sale.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Pembelian
                    </a>

                    <div class="sb-sidenav-menu-heading">Addons</div>
                    <a class="nav-link" href="{{ route('product.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Produk
                    </a>
                    @if (Auth::user()->role == 'admin')
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            User
                        </a>
                    @endif
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small ucfirst">Logged in as:</div>
                {{ ucfirst(Auth::user()->role)}}
            </div>
        </nav>
    </div>
</div>

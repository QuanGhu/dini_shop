<ul class="nav" id="side-menu">
    <li style="padding: 70px 0 0;">
        <a href="{{ route('dashboard') }}" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Dashboard</a>
    </li>
    <li>
        <a href="{{ route('category') }}" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Kategori Product</a>
    </li>
    <li>
        <a href="{{ route('product') }}" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Daftar Produk</a>
    </li>
    <li>
        <a href="{{ route('order') }}" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Daftar Pemesanan</a>
    </li>
    <li>
        <a href="{{ route('order.report') }}" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Laporan Penjualan</a>
    </li>
    @if(Auth::user()->role_id == 1)
    <li>
        <a href="{{ route('role') }}" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Hak Akses</a>
    </li>
    <li>
        <a href="{{ route('users') }}" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Daftar Pengguna</a>
    </li>
    @endif
</ul>
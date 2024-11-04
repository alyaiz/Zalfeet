<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item @if (request()->routeIs('dashboard.index')) active @endif">
      <a class="nav-link" href="{{ route('dashboard.index') }}">
        <i class="fa-light fa-gauge menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    {{-- <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#pengguna" aria-expanded="false" aria-controls="charts">
        <i class="fa-light fa-users menu-icon"></i>
        <span class="menu-title">Pengguna</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="pengguna">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="#">Admin</a>
          </li>
          <li class="nav-item"> <a class="nav-link" href="#">Pelanggan</a>
          </li>
        </ul>
      </div>
    </li> --}}

    <li class="nav-item @if (request()->routeIs('dashboard.product.*')) active @endif">
      <a class="nav-link" data-toggle="collapse" href="#praktikum" aria-expanded="false" aria-controls="charts">
        <i class="fa-light fa-boot-heeled menu-icon"></i>
        <span class="menu-title">Produk</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="praktikum">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard.product.category.index') }}">Kategori</a>
          </li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard.product.index') }}">Produk</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item @if (request()->routeIs('dashboard.sale.*')) active @endif">
      <a class="nav-link" href="{{ route('dashboard.sale.index') }}">
        <i class="fa-light fa-cart-shopping menu-icon"></i>
        <span class="menu-title">Penjualan</span>
      </a>
    </li>
  </ul>
</nav>

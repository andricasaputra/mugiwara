<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Manajemen User</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('users.employee') }}"> Karyawan </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('users.customer') }}"> Pelanggan </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('roles.index') }}"> Role </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('permissions.index') }}"> Hak Akses </a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#booking" aria-expanded="false" aria-controls="booking">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Manajemen Penginapan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="booking">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('accomodations.index') }}"> Penginapan </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('rooms.index') }}"> Kamar </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('room_types.index') }}"> Tipe Kamar </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('facilities.index') }}"> Fasilitas Kamar </a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.order.index') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">List Pemesanan</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#keuangan" aria-expanded="false" aria-controls="keuangan">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Manajemen Keuangan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="keuangan">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.finance.index') }}"> Keuangan </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.finance.transaction.list') }}"> Transaksi </a></li>
        </ul>
      </div>
    </li>

     <li class="nav-item">
      <a class="nav-link" href="{{ route('offices.index') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Manajemen Info Kantor</span>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.point.index') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Manajemen Poin</span>
      </a>
    </li>


    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#post" aria-expanded="false" aria-controls="post">
        <i class="icon-layers menu-icon"></i>
        <span class="menu-title">Artikel</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="post">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.post.index') }}">Daftar Artikel</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.category_post.index') }}">Daftar Kategori Artikel</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
        <i class="icon-menu menu-icon"></i>
        <span class="menu-title">Produk</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="product">
        <ul class="nav flex-column sub-menu">
           <li class="nav-item"> <a class="nav-link" href="{{ route('admin.product.index') }}">Daftar Produk</a></li>
        </ul>
      </div>
    </li>

     <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#voucher" aria-expanded="false" aria-controls="voucher">
         <i class="icon-map menu-icon"></i>
        <span class="menu-title">Voucher</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="voucher">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.voucher.index') }}">Daftar Voucher</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.refferals.index') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Manajemen Refferral</span>
      </a>
    </li> 

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.refund.index') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Refund</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.promotion.index') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Promo</span>
      </a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#slider" aria-expanded="false" aria-controls="slider">
        <i class="icon-contract menu-icon"></i>
        <span class="menu-title">Slider</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="slider">
        <ul class="nav flex-column {{ request()->is('admin/slider*') ? 'sub-menu' : '' }}">
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.slider.index') }}">Daftar Slider</a></li>
        </ul>
      </div>
    </li> --}}

     <li class="nav-item">
      <a class="nav-link" href="{{ route('privacy.index') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Kebijakan Privasi</span>
      </a>
    </li> 

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="setting">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Setting</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="setting">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.settings.point.index') }}"> Poin </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.settings.payment') }}"> List Metode Pembayaran </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.settings.tax') }}"> Pajak </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.playstores.index') }}"> Play Store </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.appstores.index') }}"> App Store </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.menus.index') }}"> Manajemen Menu </a></li>
        </ul>
      </div>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" href="pages/documentation/documentation.html">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Documentation</span>
      </a>
    </li> --}}
  </ul>
</nav>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>



   {{--  <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#booking" aria-expanded="false" aria-controls="booking">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Manajemen Penginapan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="booking">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('employee.accomodations.index') }}"> Penginapan </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('rooms.index') }}"> Kamar </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('room_types.index') }}"> Tipe Kamar </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('facilities.index') }}"> Fasilitas Kamar </a></li>
        </ul>
      </div>
    </li> --}}

    <li class="nav-item">
      <a class="nav-link" href="{{ route('employee.order.index') }}">
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
          <li class="nav-item"> <a class="nav-link" href="{{ route('employee.finance.index') }}"> Keuangan </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('employee.finance.transaction.list') }}"> Transaksi </a></li>
        </ul>
      </div>
    </li>
  

     <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#post" aria-expanded="false" aria-controls="post">
        <i class="icon-layers menu-icon"></i>
        <span class="menu-title">Artikel</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="post">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('employee.post.index') }}">Daftar Artikel</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('employee.category_post.index') }}">Daftar Kategori Artikel</a></li>
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
           <li class="nav-item"> <a class="nav-link" href="{{ route('employee.product.index') }}">Daftar Produk</a></li>
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
            <li class="nav-item"> <a class="nav-link" href="{{ route('employee.voucher.index') }}">Daftar Voucher</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('employee.refferals.index') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Manajemen Refferral</span>
      </a>
    </li> 

    {{--  <li class="nav-item">
      <a class="nav-link" href="{{ route('privacy.index') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Kebijakan Privasi</span>
      </a>
    </li>  --}}

  </ul>
</nav>
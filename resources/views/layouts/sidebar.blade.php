<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    @role('admin')
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#post" aria-expanded="false" aria-controls="post">
        <i class="icon-contract menu-icon"></i>
        <span class="menu-title">Berita</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="post">
        <ul class="nav flex-column {{ request()->is('admin/post*') ? 'sub-menu' : '' }}">
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.post.index') }}">Daftar Berita</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
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
    </li>
    
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#hotel" aria-expanded="false" aria-controls="hotel">
        <i class="icon-contract menu-icon"></i>
        <span class="menu-title">Hotel</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="hotel">
        <ul class="nav flex-column {{ request()->is('admin/hotel*') ? 'sub-menu' : '' }}">
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.hotel.index') }}">Daftar Hotel</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#type" aria-expanded="false" aria-controls="type">
        <i class="icon-contract menu-icon"></i>
        <span class="menu-title">Master Ruangan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="type">
        <ul class="nav flex-column {{ request()->is('admin/type*') || request()->is('admin/room*') ? 'sub-menu' : '' }}">
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.type.index') }}">Daftar Tipe Ruangan</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.room.index') }}">Daftar Ruangan</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/documentation/documentation.html">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Documentation</span>
      </a>
    </li>
    @endrole
  </ul>
</nav>
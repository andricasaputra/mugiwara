<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
        <i class="mr-2"><img src="{{ url('storage/icons/dashboard.png') }}" alt="icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    @php

      $menus = \App\Models\ManajemanMenu::with(['image', 'role', 'childs'])->oldest('id')->get();
    @endphp

    @foreach($menus as  $key => $menu)

      @if($menu->is_active == 1 && in_array(2, $menu->role?->pluck('role_id')->toArray()))

        @if(count($menu->childs) > 0)

         <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#{{ str_replace(" ", "", $menu->name) . $key }}" aria-expanded="false" aria-controls="{{ str_replace(" ", "", $menu->name) . $key }}">
              <i><img src="{{ url('storage/icons/' . $menu->image?->image) }}" alt="icon"></i>
              <span class="menu-title ml-2">{{ ucwords($menu->name) }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="{{ str_replace(" ", "", $menu->name) . $key }}">
              <ul class="nav flex-column sub-menu">

                 @foreach($menu->childs as $child)

                  @if($child->is_active == 1)

                    <li class="nav-item"> 
                      <a class="nav-link" href="{{ url('admin/' . $child->url) }}">{{ ucwords($child->name) }}</a>
                    </li>

                  @endif

                 @endforeach

              </ul>
            </div>
          </li>

        @else

           <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/' . $menu->url) }}">
                <i><img src="{{ url('storage/icons/' . $menu->image?->image) }}" alt="icon"></i>
                <span class="menu-title ml-2">{{ ucwords($menu->name) }}</span>
              </a>
            </li>

        @endif

      @endif 

    @endforeach

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="setting">
          <i class="mr-2"><img src="{{ url('storage/icons/settings.png') }}" alt="icon"></i>
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
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.payments_methods.index') }}"> Cara Pembayaran </a></li>
          </ul>
        </div>
      </li>

  </ul>
</nav>

@section('scripts')
  <script>
    let active = $('.active');

    

    active.each(function(a, key){
      if(key != 0){
        console.log(a)
      }
    });

    // $(active[1]).removeClass('active');
    // active[2].remove();
  </script>
@endsection
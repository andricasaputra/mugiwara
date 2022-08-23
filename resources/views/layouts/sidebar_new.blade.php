<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="mr-2"><img src="{{ url('storage/icons/dashboard.png') }}" alt="icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    @php

      $menus = \App\Models\ManajemanMenu::with(['image', 'role', 'childs'])->oldest('id')->get();
    @endphp

    @foreach($menus as $menu)

      @if($menu->is_active == 1 && in_array(1, $menu->role?->pluck('role_id')->toArray()))

        @if(count($menu->childs) > 0)

         <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#{{ str_replace(" ", "", $menu->name) }}" aria-expanded="false" aria-controls="{{ str_replace(" ", "", $menu->name) }}">
              <i><img src="{{ url('storage/icons/' . $menu->image?->image) }}" alt="icon"></i>
              <span class="menu-title ml-2">{{ ucwords($menu->name) }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="{{ str_replace(" ", "", $menu->name) }}">
              <ul class="nav flex-column sub-menu">

                 @foreach($menu->childs as $child)

                  @if($child->is_active == 1)

                    <li class="nav-item"> <a class="nav-link" href="{{ url($child->url) }}">{{ ucwords($child->name) }}</a></li>

                  @endif

                 @endforeach

              </ul>
            </div>
          </li>

        @else

           <li class="nav-item">
            <a class="nav-link" href="{{ url($menu->url) }}">
                <i><img src="{{ url('storage/icons/' . $menu->image?->image) }}" alt="icon"></i>
                <span class="menu-title ml-2">{{ ucwords($menu->name) }}</span>
              </a>
            </li>

        @endif

      @endif 

    @endforeach

  </ul>
</nav>
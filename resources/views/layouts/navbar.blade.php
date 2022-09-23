<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('admin.dashboard.index') }}"><img src="{{ asset('assets/images/capsuleinnlogo.png') }}" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('assets/images/capsuleinnlogo.png') }}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item dropdown">  
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              @if(auth()->user()?->notifications?->filter(function($notification){
                return $notification?->read_at == null;
              })->count() > 0)
              <span class="count"></span>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>

              @forelse(auth()->user()?->notifications ?? [] as $key => $notification)

                  @if($key < 4)
                     @role('admin')

                        <a href="{{ route('admin.notification.markasread', $notification->id) }}" class="dropdown-item preview-item">

                      @else

                        <a href="{{ route('employee.notification.markasread', $notification->id) }}" class="dropdown-item preview-item">

                      @endrole

                        <div class="preview-thumbnail">
                          <div class="preview-icon bg-success">
                            <i class="ti-info-alt mx-0"></i>
                          </div>
                        </div>
                        <div class="preview-item-content">
                          <h5 class="preview-subject font-wei5ht-normal">{{ $notification->data['title'] }}</h5>
                          <p class="font-weight-light small-text mb-0 text-muted">
                            {{ $notification->created_at->diffForHumans() }}
                             
                          </p>
                          @if(is_null($notification->read_at))
                              <small style="color: red; font-weight: bold">Belum Dibaca</small>
                          @else
                            <small style="color: green">Dibaca</small>
                            @endif
                        </div>
                      </a>
                  @endif

              @empty

              <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="ti-info-alt mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Tidak Ada Notifikasi</h6>
                    {{-- <p class="font-weight-light small-text mb-0 text-muted">
                      Just now
                    </p> --}}
                  </div>
                </a>

              @endforelse

              @if(auth()->user()->notifications->count() > 0)

              <hr>

              <div class="row text-center d-flex justify-content-around">
                  <a href="{{ route('employee.notification.index') }}" class="text-center">Lihat semua</a>

                  <a href="{{ route('employee.notification.markasread.all') }}" class="text-center">Baca semua</a>
              </div>

              @endif
              
              {{-- <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a> --}}
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">

              @if(is_null(auth()->user()->account?->avatar))

                @if(auth()->user()->account?->gender == 'pria')

                @php $avatar = 'default_man.png'; @endphp

                @else

                 @php $avatar = 'default_woman.png';@endphp

                @endif

              @else

                 @php 
                 $avatar = auth()->user()->account?->avatar; 
                 @endphp

              @endif

              <img src="{{ asset('storage/avatars/' .  $avatar) }}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              
              @role('admin')

                  <a href="{{ route('users.edit', auth()->id()) }}" class="dropdown-item">
                    <i class="ti-settings text-primary"></i>
                    Settings Profile
                  </a>

              @else

                 <a href="{{ route('users.edit.employee', auth()->id()) }}" class="dropdown-item">
                    <i class="ti-settings text-primary"></i>
                    Settings Profile
                  </a>

              @endrole
             
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                     <a class="dropdown-item" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    <i class="ti-power-off text-primary"></i>
                    Logout
                    </a>
                </form>
              
            </div>
          </li>
         {{--  <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li> --}}
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
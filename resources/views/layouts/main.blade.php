
@include('layouts.header')

<body>

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layouts.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      @include('layouts.panel')
      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      @role('admin')
        @include('layouts.sidebar_admin_new')
      @endrole

      @role('employee')
        @include('layouts.sidebar_new')
      @endrole  
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('layouts.footer')

        <button id="sound-btn" style="display: none" onclick='$.playSound("{{ url('storage/sounds/iphone_sound.mp3') }}")'>Play Sound</button>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  @include('layouts.scripts')


  @yield('scripts')

  @stack('scripts')
  
    <script>
      $(document).ready(function() {
        @if($message = session('success'))
        Swal.fire(
          'Berhasil!',
          '{{ $message }}',
          'success'
        )
        @endif
        @if ($errors->any())
        Swal.fire(
          'Gagal!',
          '{{ $message }}',
          'error'
        )
        @endif
        
        @if($message = session('alert'))
        Swal.fire(
          'Gagal!',
          '{{ $message }}',
          'error'
        )
        @endif
      })
    </script>

     <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>

        var pusher = new Pusher('b3b591c13ce117a435d0', {
          cluster: 'ap1',
           encrypted: true
        });

        var orderChannel = pusher.subscribe('order-channel');
        orderChannel.bind('order-event', function(data) {
          fireSound();
          setNotification(data);
          
        });

        var paymentChannel = pusher.subscribe('payment-channel');
        paymentChannel.bind('payment-event', function(data) {
          setNotification(data);
          fireSound();
        });

        var redeemChannel = pusher.subscribe('redeem-channel');
        redeemChannel.bind('redeem-event', function(data) {
          setNotification(data);
          fireSound();
        });

        function fireSound()
        {
          $('#sound-btn').click();
        }

        function setNotification(data)
        {
          const container = $('#notification-container');
          const bell = $('#bell-icon');

          bell.empty();

          bell.html(`
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
          `);

          $('#empty-notification').remove();

          $('#new-notification-container').prepend(`
            <a href="#" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-success">
                  <i class="ti-info-alt mx-0"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <h5 class="preview-subject font-wei5ht-normal">${data.title}</h5>
                <p class="font-weight-light small-text mb-0 text-muted">
                  Baru Saja
                </p>
                <small style="color: red; font-weight: bold">Belum Dibaca</small>
              </div>
              </a>
          `);
        }

      </script>

      <script src='https://cdn.rawgit.com/admsev/jquery-play-sound/master/jquery.playSound.js'></script>
</body>
</html>

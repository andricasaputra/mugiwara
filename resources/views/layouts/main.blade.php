
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

</body>
</html>

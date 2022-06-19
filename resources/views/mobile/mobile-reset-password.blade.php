<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ ('/assets/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ ('/assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ ('/assets/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ ('/assets/css/vertical-layout-light/style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ ('/assets/images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              {{-- <div class="brand-logo">
              <img src="{{ ('/assets/images/logo.svg') }}" alt="logo">
              </div> --}}
              <h4>Reset Password</h4>
              <h6 class="font-weight-light">Silahkan isi dengan password baru anda.</h6>
              
              <form class="pt-3" method="POST" action="{{ route('api.reset.password.post') }}">
                 <input type="hidden" name="token" value="{{ $request->route('token') }}">
                 @if($request->has('email'))

                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email" required value="{{ old('email', $request->email) }}" readonly>
                  </div>

                 @elseif($request->has('mobile_number'))

                  <div class="form-group">
                    <input type="number" class="form-control form-control-lg" id="exampleInputNumber1" placeholder="Mobile Number" name="mobile_number" required value="{{ old('mobile_number', $request->mobile_number) }}" readonly>
                  </div>

                 @endif
                
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="New  Password" name="password" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password Confirmation" name="password_confirmation" required>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Reset Password</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ ('/assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ ('/assets/js/off-canvas.js') }}"></script>
  <script src="{{ ('/assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ ('/assets/js/template.js') }}"></script>
  <script src="{{ ('/assets/js/settings.js') }}"></script>
  <script src="{{ ('/assets/js/todolist.js') }}"></script>
  <!-- endinject -->
</body>

</html>

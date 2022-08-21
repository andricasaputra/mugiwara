@extends('layouts.main')

@section('content')

 <div class="col-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title">Tambah User Baru</h4>
        <p class="card-description">
          Silahkan isi form dibawah ini
        </p>
          @include('inc.auth-message', ['status' => session('status')])
          <form class="form-sample" method="POST" enctype="multipart/form-data" action="{{ route('admin.register.post') }}">
            @csrf
            <div class="form-group">
              <label for="name">Nama Lengkap</label>
              <input type="text" class="form-control form-control-lg" id="exampleInputName1" placeholder="Name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
              <label for="mobile_number">Nomor HP</label>
              <input type="number" class="form-control form-control-lg" id="exampleInputMobile" placeholder="Mobile Number" name="mobile_number" value="{{ old('mobile_number') }}" required>
            </div>

            <hr>

            <h5><b>Informasi Akun</b></h5>

            <hr>

            <div class="form-group">
              <label for="gender">Gender</label>
              <select name="gender" class="form-control">
                <option value="pria">Pria</option>
                <option value="wanita">Wanita</option>
              </select>
            </div>

            <div class="form-group">
              <label for="birth_date">Tanggal Lahir</label>
              <input type="date" name="birth_date" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="photo_profile">Avatar</label>
              <input type="file" name="photo_profile" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password" required>
            </div>
            <div class="form-group">
              <label for="password_confirmation">Konfirmasi Password</label>
              <input type="password" class="form-control form-control-lg" id="exampleInputPasswordConfirmation1" placeholder="Password Confirmation" name="password.confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Kirim</button>
            <a href="{{ route('users.employee') }}" class="btn btn-danger">Kembali</a>
          
          </form>
      </div>
    </div>
  </div>

@endsection
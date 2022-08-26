@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="{{ $user->type != 'customer' ? 'col-md-6' : 'col-md-12' }}  col-sm-12">
            <div class="card">
                <div class="card-header"><b>Informasi Akun</b></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ ucwords($user->name) }}</td>
                            </tr>
                            <tr>
                                <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                             <tr>
                                <td>No HP</td>
                                <td>:</td>
                                <td>{{ $user->mobile_number }}</td>
                            </tr>
                            <tr>
                                <td>Verifikaksi No HP</td>
                                <td>:</td>
                                <td>{{ $user->mobile_verified_at ?? 'Belum terverifikasi' }}</td>
                            </tr>
                            <tr>
                             <tr>
                                <td>Avatar</td>
                                <td>:</td>
                                <td>
                                    @if(is_null($user->google_id))   
                                        <img src="{{ url('storage/avatars/' . $user->account?->avatar) }}" alt="avatar">
                                    @else
                                        <img src="{{ $user->account?->avatar }}" alt="avatar">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>:</td>
                                <td>{{ $user->account?->gender }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal lahir</td>
                                <td>:</td>
                                <td>{{ $user->account?->birth_date }}</td>
                            </tr>

                            @if($user->type == 'customer')
                                <tr>
                                    <td>Kode Refferral</td>
                                    <td>:</td>
                                    <td>{{ $user->account?->refferral_code }}</td>
                                </tr>

                                <tr>
                                    <td>Point</td>
                                    <td>:</td>
                                    <td>{{ $user->account?->point }}</td>
                                </tr>
                            @endif
                           
                        </table>
                    </div>
                </div>
            </div>


        </div>

        @if($user->type != 'customer')

        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header"><b>Informasi Kantor</b></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                             <tr>
                                <td>Nama kantor</td>
                                <td>:</td>
                                <td>{{ $user->office?->name }}</td>
                            </tr>
                            <tr>
                                <td>Alamat kantor</td>
                                <td>:</td>
                                <td>{{ $user->office?->address }}</td>
                            </tr>
                            <tr>
                                <td>Nomor kontak kantor</td>
                                <td>:</td>
                                <td>{{ $user->office?->mobile_number }}</td>
                            </tr>
                            <tr>
                                <td>Tipe kantor</td>
                                <td>:</td>
                                <td>{{ $user->office?->type == 'main_office' ? 'Kantor Pusat' : 'Kantor Cabang' }}</td>
                            </tr>
                            <tr>
                                <td>Penempatan penginapan</td>
                                <td>:</td>
                                <td>{{ $user->office?->accomodation?->name }}</td>
                            </tr>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @endif

    </div>

     @if($user->type == 'customer')
        <div class="d-flex justify-content-center mt-3">
            <a href="{{ route('users.customer') }}" class="btn btn-danger">Kembali</a>
        </div>
     @else
        <div class="d-flex justify-content-center mt-3">
            <a href="{{ route('users.employee') }}" class="btn btn-danger">Kembali</a>
        </div>
     @endif

    
</div>

@endsection()

@section('scripts')
    <script>
        $('.confirm').on('click', function (e) {
            if (confirm('Apakah anda yakin akan menghapus data ini?')) {
                return true;
            }
            else {
                return false;
            }
        });

        $('#user-table').DataTable();
    </script>
@endsection()
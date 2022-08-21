@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-sm-12">
            <div class="card">
                <div class="card-header">affiliator</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Avatar</td>
                                <td>:</td>
                                <td><img src="{{ $refferral->user?->google_id == null ? url('storage/avatars/' . $refferral->user?->account?->avatar) : $refferral->user?->account?->avatar }}" alt="avatar" width="100"></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $refferral->user?->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $refferral->user?->email }}</td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td>:</td>
                                <td>{{ $refferral->user?->mobile_number ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Kode Refferral</td>
                                <td>:</td>
                                <td>{{ $refferral->user?->account?->refferral_code }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-lg-7 col-sm-12">
            <div class="card">
                <div class="card-header">User Followers</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="user-table" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Follower</th>
                                    <th>Email Follower</th>
                                    <th>Tanggal Penukaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($refferral->followers as $key => $follower)
                                <tr>$
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $follower->user?->name }}</td>
                                    <td>{{ $follower->user?->email }}</td>
                                    <td>{{ $follower->created_at->format('d-m-Y H:i:s') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.refferals.index') }}" class="btn btn-sm btn-danger">Kembali</a>
    </div>
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
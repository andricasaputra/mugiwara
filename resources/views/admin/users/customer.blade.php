@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <hr>
                    <div class="table-responsive">

                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <p class="card-title">Daftar Pelanggan</p>
                                <div class="row">
                                  <div class="col-12">
                                    {{-- <div class="table-responsive"> --}}
                                      <table id="user-table" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>No HP</th>
                                                <th>Email Verified</th>
                                                <th>No HP Verified</th>
                                                <th>Status</th>
                                                <th>Waktu daftar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                            @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->mobile_number }}</td>
                                                <td>{{ $user->email_verified_at == NULL ? 'Not Verified' : 'Verified' }}</td>
                                                <td>{{ $user->mobile_verified_at == NULL ? 'Not Verified' : 'Verified' }}</td>
                                                <td>Aktif</td>
                                                <td>{{ $user->created_at->isoFormat('Do MMMM YYYY, h:mm:ss a') }}</td>

                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-success mb-2">Detail</a>
                                                    <a href="#" class="btn btn-danger">Banned</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- </div> --}}
                                  </div>
                                </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
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
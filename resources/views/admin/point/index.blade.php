@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <div class="table-responsive">

                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <p class="card-title align-items-center my-auto">Daftar Pelanggan</p>
                                <hr>
                                <div class="row">
                                  <div class="col-12">
                                    {{-- <div class="table-responsive"> --}}
                                      <table id="user-table" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Waktu daftar</th>
                                                <th>Poin</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                            @foreach ($customers as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->created_at->isoFormat('Do MMMM YYYY, h:mm:ss a') }}</td>
                                                <td>@currency($user->account->point)</td>
                                                <td>
                                                    <a href="{{ route('admin.point.show', $user->id) }}" class="btn btn-sm btn-primary p-2">Kelola Poin</a>
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
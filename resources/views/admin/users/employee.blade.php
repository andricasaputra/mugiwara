@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">

                @include('inc.message')
                <div class="card-block">
                   
                   <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('admin.register') }}" class="btn btn-success">Tambah Karyawan</a>
                            <a href="{{ route('roles.index') }}" class="btn btn-warning pull-right">Role</a>
                            <a href="{{ route('permissions.index') }}" class="btn btn-warning pull-right">Hak Akses</a>
                        </div>


                         <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                              <div class="card-body">
                                <h>Total Karyawan : {{ $users->count() }}</h>
                              </div>
                            </div>
                      </div>
                   </div>

                    <div class="table-responsive">

                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <p class="card-title">Daftar Karyawan</p>
                                <div class="row">
                                  <div class="col-12">
                                    {{-- <div class="table-responsive"> --}}
                                      <table id="user-table" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Tanggal ditambahkan</th>
                                                <th>Role</th>
                                                <th>Operations</th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                            @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->created_at->isoFormat('Do MMMM YYYY, h:mm:ss a') }}</td>
                                                <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                                                <td>

                                                <a href="{{ route('users.detail', $user->id) }}" class="btn btn-info btn-xs pull-left" style="margin-right: 3px;">Detail</a>

                                                <br>

                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-xs pull-left" style="margin-right: 3px;">Edit</a>

                                                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], ]) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs confirm']) !!}
                                                {!! Form::close() !!}

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
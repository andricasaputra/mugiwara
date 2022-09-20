@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <a href="{{ route('roles.create') }}" class="btn btn-success">Add Role</a>
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Role mAnagaement</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Role</th>
                                                {{-- <th>Permissions</th> --}}
                                                <th>Operation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($roles as $role)
                                                <tr>

                                                    <td>{{ $role->name }}</td>

                                                  {{--   <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td> --}}{{-- Retrieve array of permissions associated to a role and convert to string --}}
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info btn-xs" style="margin-right: 3px;">Edit</a>

                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs confirm']) !!}
                                                        {!! Form::close() !!}
                                                        </div>

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">No roles available</td> 
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
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

        $('#mytable').DataTable();
    </script>
@endsection()
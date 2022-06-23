@extends('layouts.main')

@section('title', 'Permissions')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <a href="{{ route('permissions.create') }}" class="btn btn-success">Add Permission</a>
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Permission Management</p>
                                <div class="row">
                                  <div class="col-12">
                                      <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Permissions</th>
                                                <th>Operation</th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                            @forelse ($permissions as $permission)
                                                <tr>
                                                    <td>{{ $permission->name }}</td> 
                                                    <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-info pull-left" style="margin-right: 3px;">Edit</a>

                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm confirm']) !!}
                                                        {!! Form::close() !!}
                                                    </div>

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2">No permissions available</td> 
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

@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <a href="{{ route('admin.settings.fee.create') }}" class="btn btn-success">Tambah Fee</a>
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Setting Fee</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kantor Cabang</th>
                                                <th>Jumlah Fee</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($fees as $key =>  $fee)
                                                <tr>

                                                    <td>{{ $key + 1 }}</td>

                                                    <td>{{ $fee->office?->name }}</td>

                                                    <td>{{ $fee->value }}</td>

                                                    <td>
                                                    	<a href="{{ route('admin.settings.fee.edit', $fee->id) }}" class="btn btn-success">Edit</a>

                                                        <form action="{{ route('admin.settings.fee.destroy', $fee->id) }}" method="post">
                                                            @method('DELETE')
                                                            @csrf

                                                            <button type="submit" class="btn btn-danger mt-2">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">No settings available</td> 
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
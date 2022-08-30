@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                   <a href="{{ route('admin.refund.reason.create') }}" class="btn btn-success">Tambah Alasan Refund</a>
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Daftar Alasan Refund</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Alasan</th>
                                                <th>Deskripsi</th>
                                                <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @forelse ($reasons as $reason)
                                        
                                                <tr>
                                                    <td>{{ $reason->name }}</td>

                                                    <td>{{ $reason->description }}</td>

                                                    <td>
                                                    	<a href="{{ route('admin.refund.reason.edit', $reason->id) }}" class="btn btn-warning mb-3">Edit</a>

                                                        <form action="{{ route('admin.refund.reason.destroy') }}" method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <input type="hidden" name="id" value="{{ $reason->id }}">

                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9">No settings available</td> 
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

        $('#mytable').DataTable({
            order : false
        });
    </script>
@endsection()
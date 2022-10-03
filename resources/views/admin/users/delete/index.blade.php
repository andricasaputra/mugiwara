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
                                @include('inc.message')
                                <p class="card-title">Daftar Akun Yang Dihapus</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>No HP</th>
                                                <th>Alasan</th>
                                                <th>Deskripsi</th>
                                                <th>Waktu Hapus</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($deleteds as $deleted)
                                        
                                                <tr>

                                                    <td>{{ $deleted["name"] }}</td>

                                                    <td>{{ $deleted["email"] }}</td>

                                                    <td>{{ $deleted["mobile_number"] }}</td>

                                                    <td>{{ $deleted["reason"] }}</td>

                                                     <td>{{ $deleted["description"] }}</td>

                                                     <td>{{ $deleted["deleted_at"]->diffForHumans() }}</td>

                                                    <td>

                                                        <form action="{{ route('users.deleted.restore', $deleted["id"]) }}" method="post">
                                                        	@csrf

                                                        	<button class="btn btn-info">Restore</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">No settings available</td> 
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
        	order: false
        });
    </script>
@endsection()
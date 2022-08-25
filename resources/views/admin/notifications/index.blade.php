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
                                <p class="card-title">Daftar Notifikasi</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Judul</th>
                                                <th>Isi</th>
                                                <th>Waktu Diterima</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @forelse ($notifications as $key => $notification)

                                                <tr>

                                                    <td>{{ $notification->data['title'] }}</td>

                                                     <td>{{ $notification->data['message'] }}</td>

                                                      <td>{{ $notification->created_at->diffForHumans() }}</td>

                                                      <td>
                                                          <form action="{{ route('admin.notification.destroy') }}" method="post">
                                                              @csrf
                                                              @method('delete')

                                                              <input type="hidden" name="id" value="{{ $notification->id }}">

                                                              <button type="submit" class="btn btn-danger">Delete</button>
                                                          </form>
                                                      </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">No data available</td> 
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
            "ordering": false
        });
    </script>
@endsection()
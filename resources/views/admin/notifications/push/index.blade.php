@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <a href="{{ route('admin.notifications.push.create') }}" class="btn btn-success">Kirim Notifikasi</a>
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Push Notifikasi</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Judul</th>
                                                <th>Isi</th>
                                                <th>Penerima</th>
                                                <th>Di Kirim Pada</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @forelse ($push as $key => $p)

                                                <tr>    

                                                    <td>{{ $p->title }}</td>

                                                     <td>{{ $p->text }}</td>

                                                     <td>
                                                         @foreach($users[$key] as $user)

                                                         @if($user == 'all')
                                                            Semua Pelanggan
                                                         @else
                                                            {{ ucwords($user->name) }} <br>

                                                         @endif

                                                         @endforeach
                                                     </td>

                                                      <td>{{ $p->created_at->diffForHumans() }}</td>

                                                      <td>
                                                          <form action="{{ route('admin.notifications.push.destroy') }}" method="post">
                                                              @csrf
                                                              @method('delete')

                                                              <input type="hidden" name="id" value="{{ $p->id }}">

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
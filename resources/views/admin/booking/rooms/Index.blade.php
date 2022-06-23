@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <a href="{{ route('rooms.create') }}" class="btn btn-success">Tambah kamar</a>
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Daftar kamar</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table table-striped text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama Kamar</th>
                                                <th>Type</th>
                                                <th>Harga</th>
                                                <th>Diskon</th>
                                                <th>Gambar</th>
                                                <th>Operation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($rooms as $room)
                                                <tr>
                                                    <td>{{ $room->name }}</td>
                                                    <td>{{ $room->type->name }}</td>
                                                    <td>{{ $room->price }}</td>
                                                    <td>{{ $room->discount }}</td>
                                                    <td>{{ $room->images->first()->image }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a class="btn btn-info btn-sm mr-2" href="{{ route('rooms.edit', $room->id) }}">Edit</a>
                                                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">Belum ada data untuk ditampilkan</td> 
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
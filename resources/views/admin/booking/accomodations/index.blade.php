@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <a href="{{ route('accomodations.create') }}" class="btn btn-success">Tambah penginapan</a>
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Daftar penginapan</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table table-striped text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama Penginapan</th>
                                                <th>Alamat</th>
                                                <th>Rating</th>
                                                <th>Jumlah Kamar</th>
                                                <th>Operation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($accomodations as $accomodation)
                                                <tr>
                                                    <td>{{ $accomodation->name }}</td>
                                                    <td>{{ $accomodation->address }}</td>
                                                    <td>{{ $accomodation->ratings_avg ?? 0 }}</td>
                                                    <td>{{ $accomodation->room_count ?? 0 }}</td>
                                                     
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a class="btn-action btn btn-warning mr-2" href="{{ route('accomodations.add', $accomodation->id) }}">Tambah Kamar</a>
                                                            <a class="btn-action btn btn-info mr-2" href="{{ route('accomodations.edit', $accomodation->id) }}">Edit</a>
                                                            <form action="{{ route('accomodations.destroy', $accomodation->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn-action btn btn-danger confirm">Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">Belum ada data untuk ditampilkan</td> 
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

@section('link')
    <style>
        .btn-action{
            height: 30px !important;
            width: 100px !important; 
        }
    </style>
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
@endsection()index
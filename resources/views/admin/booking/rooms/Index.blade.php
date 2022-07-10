@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    {{-- <a href="{{ route('rooms.create') }}" class="btn btn-success">Tambah kamar</a> --}}
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
                                                <th>Nama Penginapan</th>
                                                <th>Type</th>
                                                <th>Maksimal Tamu</th>
                                                <th>Harga</th>
                                                <th>Diskon</th>
                                                <th>Gambar</th>
                                                <th>Fasilitas Kamar</th>
                                                <th>Deskripsi Kamar Kamar</th>
                                                <th>Operation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($rooms as $room)
                                                <tr>
                                                    <td>{{ $room->accomodation->name }}</td>
                                                    <td>{{ $room->type->name }}</td>
                                                    <td>{{ $room->max_guest }} orang</td>
                                                    <td>{{ $room->price }}</td>
                                                    <td>{{ $room->discount_type }} <br> {{ $room->discount_amount }}</td>
                                                    <td>
                                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                          <div class="carousel-inner">

                                                            @foreach($room->images as $image)   

                                                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                                <img  class="d-block w-100" src="{{ asset('/storage/rooms/') .'/'. $image->image }}" alt="Second slide">
                                                            </div>
                                                            @endforeach
                                                          </div>
                                                          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                          </a>
                                                          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                          </a>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        @foreach($room->facilities as $facility)
                                                            <div>

                                                                <img src="{{ asset('images/facilities') .'/'. $facility->image}}" alt="facility" style="width : 30px">
                                                                <p>{{ ucwords(str_replace("_", " ", $facility->name)) }}</p>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $room->description }}</td>
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
                                                    <td colspan="8">Belum ada data untuk ditampilkan</td> 
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
    img {
        width: 100%;
        height: 100%;
    }
    </style>
@endsection

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
@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                       <div>
                            <form class="form-inline" action="{{ route('rooms.filter') }}" method="post">
                              <div class="form-group mb-2">
                                @csrf
                                <label for="from" class="sr-only">Penginapan</label>
                                <select name="accomodation_id" class="form-control">
                                    <option value="all">Semua Penginapan</option>
                                    @foreach($accomodations as $accomodation)
                                        <option value="{{ $accomodation->id }}">{{ $accomodation->name }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="form-group mx-sm-3 mb-2">
                                <label for="type_id" class="sr-only">Tipe Kamar</label>
                                <select name="type_id" class="form-control">
                                    <option value="all">Semua Tipe</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="form-group mx-sm-3 mb-2">
                                <label for="status" class="sr-only">status Kamar</label>
                                <select name="status" class="form-control">
                                    <option value="all">Semua Status</option>
                                    <option value="booked">Booked</option>
                                    <option value="stayed">Stayed</option>
                                    <option value="available">Available</option>
                                </select>
                              </div>
                              <button type="submit" class="btn btn-primary mb-2">Filter</button>
                            </form>
                        </div>
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
                                                <th>Status</th>
                                                <th>Harga</th>
                                                <th>Diskon</th>
                                                <th>Gambar</th>
                                                <th>Fasilitas Kamar</th>
                                                <th>Nomor Kamar</th>
                                                <th>Deskripsi Kamar Kamar</th>
                                                <th>Operation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($rooms as $room)
                                                <tr>
                                                    <td>{{ $room->accomodation?->name }}</td>
                                                    <td>{{ $room->type?->name }}</td>
                                                   
                                                    <td>{{ $room->max_guest }} orang</td>
                                                    <td>{{ ucwords($room->status) }}</td>
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
                                                        <div id="facilityCors" class="carousel slide" data-ride="carousel">
                                                          <div class="carousel-inner">

                                                            @foreach($room->facilities as $facility)

                                                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                                <img  class="d-block w-50" src="{{ asset('storage/facilities') .'/'. $facility->image }}" alt="Second slide" width="50">
                                                                <p class="text-center">{{ $facility->name }}</p>
                                                            </div>
                                                            @endforeach
                                                          </div>
                                                          <a class="carousel-control-prev" href="#facilityCors" role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                          </a>
                                                          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                          </a>
                                                        </div>
                                                    </td>
                                                     <td>{{ $room->room_number }}</td>
                                                    <td>{{ substr_replace($room->description, "...", 50) }}</td>
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
                                                    <td colspan="10">Belum ada data untuk ditampilkan</td> 
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
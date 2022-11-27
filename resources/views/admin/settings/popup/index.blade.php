@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <a href="{{ route('admin.settings.popup.create') }}" class="btn btn-success">Tambah Pop Up</a>
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Setting Pop Up</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Judul</th>
                                                <th>Deskripsi</th>
                                                <th>Gambar</th>
                                                <th>status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($popups as $popup)
                                                <tr>

                                                    <td>{{ $popup->title }}</td>

                                                    <td>{{ $popup->description }}</td>

                                                    <td>
                                                        <img src="{{ asset('storage/popups/' . $popup->image?->image) }}" alt="pop up image" width="100">
                                                    </td>


                                                    <td style="font-weight: bold; {{ $popup->is_active == 1 ? 'color : green' : 'color : red' }}">{{ $popup->is_active == 1 ? 'Aktif' : 'Non Aktif' }} </td>

                                                    <td>
                                                    	<a href="{{ route('admin.settings.popup.edit', $popup->id) }}" class="btn btn-success">Edit</a>

                                                        <a href="{{ route('admin.settings.popup.destroy', $popup->id) }}" class="btn btn-danger">Delete</a>
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
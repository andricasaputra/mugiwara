@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <a href="{{ route('admin.menus.create') }}" class="btn btn-success">Tambah Setting</a>
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Manajemen Menu</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="custom-table" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Is active</th>
                                                <th>Icon</th>
                                                <th>Url</th>
                                                <th>Untuk Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($menus as $menu)
                                        
                                                <tr>

                                                    <td>{{ $menu->name }}</td>

                                                     <td>{{ $menu->description }}</td>

                                                     <td>{{ $menu->is_active == 1 ? 'Aktif' : 'Tidak Aktif'}}</td>


                                                     <td><img src="{{ url('storage/icons/' . $menu->image?->image) }}" alt="menu" width="100"></td>


                                                      <td>{{ $menu->url }}</td>

                                                      <td>
                                                      	@foreach($menu->role as $role)

                                                      		{{ $role->role_id }} 
                                                      		<br>
                                                      	@endforeach
                                                      </td>

                                                    <td>
                                                    	<a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-success mb-2">Edit</a>

                                                        <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="post">
                                                        	@csrf
                                                        	@method('DELETE')

                                                        	<button class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">No settings available</td> 
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
   
@endsection

@section('link')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


@endsection

@section('scripts')

	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('.confirm').on('click', function (e) {
            if (confirm('Apakah anda yakin akan menghapus data ini?')) {
                return true;
            }
            else {
                return false;
            }
        });

        ///$('#custom-table').DataTable();
    </script>

    <script>
    $(document).ready(function() {
        $('#js-example-basic-single').select2();

        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

        $('#js-example-basic-single-regencies').select2();

        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

        $('#js-example-basic-single-districts').select2();

        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

    });
</script>
@endsection()
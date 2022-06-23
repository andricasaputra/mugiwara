
@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-12">
        <form action="{{ route('admin.hotel_category.index', $hotel->id) }}" method="get">
            <div class="row">
                <div class="input-group mb-3 col-3">
                    <input type="text" name="q" class="form-control" placeholder="Cari..." value="{{ request()->q }}">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text">Cari</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container-fluid">
        <a class="" href="{{ route('admin.hotel.index') }}">Kembali ke daftar hotel</a>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title">Daftar Kategori Hotel | <b>{{ $hotel->name }}</b></h4>
                <a href="{{ route('admin.hotel_category.create', $hotel->id) }}" class="btn btn-primary btn-sm align-items-center my-auto">Tambah Kategori Hotel</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tagar</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($hotelCategories as $key => $hotelCategory)
                        <tr>
                            <td>{{ ($hotelCategories->currentpage()-1) * $hotelCategories->perpage() + $key + 1 }}</td>
                            <td>{{ $hotelCategory->name }}</td>
                            <td>{{ $hotelCategory->tag }}</td>
                            <td>
                                <table>
                                    <tr>
                                        <td><a href="{{ route('admin.hotel_category.edit', [$hotelCategory->id, $hotelCategory->hotel_id]) }}" class="btn btn-warning btn-sm">Ubah</a></td>
                                        <td>
                                            <a href="#" 
                                            data-id="{{ $hotelCategory->id }}" data-toggle="modal" data-target="#delete"
                                            class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
                {{$hotelCategories->links("pagination::bootstrap-4")}}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span class="text-orange-tagar-manual">|</span> Hapus Kategori Hotel</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus Kategori Hotel ini?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.hotel_category.delete') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id">
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
    $("#edit").on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var description = $(e.relatedTarget).data('description');
        $('#edit').find('input[name="id"]').val(id);
        $('#edit').find('input[name="name"]').val(name);
        $('#edit').find('input[name="description"]').val(description);
    });
    
    $('#delete').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        console.log(id);
        $('#delete').find('input[name="id"]').val(id);
    });
</script>
@endpush
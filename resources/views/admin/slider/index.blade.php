
@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-12">
        <form action="{{ route('admin.slider.index') }}" method="get">
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
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title">Daftar Slider</h4>
                <a href="{{ route('admin.slider.create') }}" class="btn btn-primary btn-sm align-items-center my-auto">Tambah Slider</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $key => $slider)
                        <tr>
                            <td>{{ ($sliders->currentpage()-1) * $sliders->perpage() + $key + 1 }}</td>
                            <td>{{ $slider->title }}</td>
                            <td>{{ $slider->description }}</td>
                            <td><a href="{{ Storage::disk('local')->url('data/'. $slider->image) }}" target="_blank"><img src="{{ Storage::disk('local')->url('data/'. $slider->image) }}" style="height:100px;width:100px;"></a></td>
                            <td>{{ $slider->is_active == 1 ? 'Aktif' : 'Non-aktif'}}</td>
                            <td>
                                <table>
                                    <tr>
                                        <td><a href="{{ route('admin.slider.edit', $slider->id) }}" class="btn btn-warning btn-sm">Ubah</a></td>
                                        <td>
                                            <a href="#" 
                                            data-id="{{ $slider->id }}" data-toggle="modal" data-target="#delete"
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
                {{$sliders->links("pagination::bootstrap-4")}}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span class="text-orange-tagar-manual">|</span> Hapus Slider</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus Slider ini?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.slider.delete') }}" method="POST" enctype="multipart/form-data">
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
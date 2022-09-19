@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title">Slider Tentang</h4>
                <a href="{{ route('admin.slider-tentang.create.slider-tentang') }}" class="btn btn-primary btn-sm align-items-center my-auto">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Rating</th>
                                <th>Image</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($counter = 1)
                            @forelse($sliderTentang as $key => $slider)
                                <tr>
                                    <td>{{$counter++}}</td>
                                    <td>{{$slider->name}}</td>
                                    <td>{{$slider->description}}</td>
                                    <td>{{$slider->rating}}</td>
                                    <td> <img width="100" src="{{ asset('images/compro/slider_tentang/'. $slider->image) }}"></td>
                                    <td>{{$slider->role}}</td>
                                    <td>{{$slider->status ? 'Aktif' : 'Non-Aktif'}}</td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td><a href="{{ route('admin.slider-tentang.edit.slider-tentang', $slider->id) }}" class="btn btn-warning btn-sm">Ubah</a></td>
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
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
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
                Apakah Anda yakin ingin menghapus ini?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.slider-tentang.delete.slider-tentang') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
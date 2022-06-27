
@extends('layouts.main')

@section('content')

<div class="row">
    {{-- <div class="col-12">
        <form action="{{ route('admin.post.index') }}" method="get">
            <div class="row">
                <div class="input-group mb-3 col-3">
                    <input type="text" name="q" class="form-control" placeholder="Cari..." value="{{ request()->q }}">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text">Cari</button>
                    </div>
                </div>
            </div>
        </form>
    </div> --}}
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title">Daftar Berita</h4>
                <a href="{{ route('admin.post.create') }}" class="btn btn-primary btn-sm align-items-center my-auto">Tambah Berita</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="display expandable-table table-striped text-center" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Slug</th>
                        <th>Isi</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $key => $post)
                        @php
                        $string = strip_tags($post->body);
                        if (strlen($string) > 125) {
                            $stringCut = substr($string, 0, 125);
                            $endPoint = strrpos($stringCut, ' ');
                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= ' ....';
                        }
                        @endphp
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>
                                {{ $string }}
                            </td>
                            <td><a href="{{ Storage::disk('local')->url('data/'. $post->image) }}" target="_blank"><img src="{{ Storage::disk('local')->url('data/'. $post->image) }}" style="height:100px;width:100px;border-radius:0;"></a></td>
                            <td>{{ $post->is_active == 1 ? 'Aktif' : 'Non-aktif'}}</td>
                            <td>
                                <table>
                                    <tr>
                                        <td><a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-warning btn-sm">Ubah</a></td>
                                        <td><a href="{{ route('admin.post.show', $post->id) }}" class="btn btn-info btn-sm">Detail</a></td>
                                        <td>
                                            <a href="#" 
                                            data-id="{{ $post->id }}" data-toggle="modal" data-target="#delete"
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
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span class="text-orange-tagar-manual">|</span> Hapus Berita</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus berita ini?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.post.delete') }}" method="POST" enctype="multipart/form-data">
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
    $('#mytable').DataTable();
</script>
@endpush
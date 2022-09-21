@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title">Pendaftaran</h4>
                <a href="{{ route('admin.pendaftaran.create.pendaftaran') }}" class="btn btn-primary btn-sm align-items-center my-auto">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="myTable" class="table table-hover display expandable-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Text</th>
                            <th>File</th>
                            <th>Order</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @if(count($pendaftaran) != 0)
                        <tbody>
                            @php($counter=1)
                            @foreach($pendaftaran as $k => $p)
                                <tr>
                                    <td>{{$counter++}}</td>
                                    <td>{{$p->text}}</td>
                                    <td><a href="{{ asset('images/compro/pendaftaran/'. $p->file) }}">{{$p->file}}</a></td>
                                    <td>{{$p->order}}</td>
                                    <td>
                                        <a href="{{ route('admin.pendaftaran.edit.pendaftaran', $p->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                        <a href="#" data-id="{{ $p->id }}" data-toggle="modal" data-target="#delete" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
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
                <h5 class="modal-title" id="exampleModalLabel"><span class="text-orange-tagar-manual">|</span> Hapus</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus ini?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.pendaftaran.delete.pendaftaran') }}" method="POST" enctype="multipart/form-data">
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

    $('#myTable').DataTable({
        order : false
    });
</script>
@endpush
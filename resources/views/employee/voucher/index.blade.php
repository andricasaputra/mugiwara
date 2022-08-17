
@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline align-items-center">
                <h4 class="card-title align-items-center my-auto">Daftar Voucher</h4>
                <a href="{{ route('admin.voucher.create') }}" class="btn btn-primary btn-sm align-items-center my-auto">Tambah Voucher</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="display expandable-table table-striped text-center" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Tipe</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($vouchers as $key => $voucher)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $voucher->code }}</td>
                            <td>{{ $voucher->name }}</td>
                            <td>{{ $voucher->description }}</td>
                            <td>{{ $voucher->type }}</td>
                            <td><a href="{{ Storage::disk('public')->url('vouchers/' . $voucher->image) }}" target="_blank"><img src="{{ Storage::disk('public')->url('vouchers/' . $voucher->image) }}" width="120"></a></td>
                            <td>{{ $voucher->is_active == 1 ? 'Aktif' : 'Non-aktif'}}</td>
                            <td>
                                <table>
                                    <tr>
                                        <td><a href="{{ route('admin.voucher.edit', $voucher->id) }}" class="btn btn-warning btn-sm">Ubah</a></td>
                                        <td><a href="{{ route('admin.voucher.show', $voucher->id) }}" class="btn btn-info btn-sm">Detail</a></td>
                                        <td>
                                            <a href="#" 
                                            data-id="{{ $voucher->id }}" data-toggle="modal" data-target="#delete"
                                            class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
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
                <h5 class="modal-title" id="exampleModalLabel"><span class="text-orange-tagar-manual">|</span> Hapus Voucher</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus Voucher ini?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.voucher.delete') }}" method="POST" enctype="multipart/form-data">
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
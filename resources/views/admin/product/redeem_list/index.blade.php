
@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title align-items-center my-auto">Daftar Penukaran Produk</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="display expandable-table table-striped text-center" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>No Transaksi/Resi</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Cara Penukaran</th>
                        <th>Produk Yang Ditukarkan</th>
                        <th>Point Yang Ditukarkan</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $key => $product)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $product->transaction_number ?? ($product->no_resi ?? 'Belum Terbit Resi') }}</td>
                            <td>{{ $product->user?->name }}</td>
                            <td>{{ $product->user?->email }}</td>
                            <td>{{ $product->redeem_type == 'pickup' ? 'Ambil Sendiri' : 'Di Kirim' }}</td>
                            <td>{{ $product->product?->name }}</td>
                            <td>{{ $product->product?->point_needed }}</td>
                            <td>{{ $product->status ?? 'Belum Dikirim/ambil' }}</td>
                            
                            
                             <td>
                                <a href="{{ route('admin.product.redeem.list.edit', $product->redeem_type == 'pickup' ? 'pickup' : 'delivery' ) }}" class="btn btn-warning mb-2"> Edit </a>
                                <br>
                                 <a href="{{ route('admin.product.redeem.list.detail', $product->id) }}" class="btn btn-primary mb-2"> Detail </a>
                                <br>
                                <form action="{{ route('admin.product.redeem.list.delete') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                             </td>
                        </tr>
                        @empty
                        <tr>
                            {{-- <td colspan="7" class="text-center">Tidak ada data</td> --}}
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
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
        $('#edit').find('input[name="id"]').val(id);
        $('#edit').find('input[name="name"]').val(name);
    });

    $('#delete').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        console.log(id);
        $('#delete').find('input[name="id"]').val(id);
    });
    $('#mytable').DataTable({
        order : false
    });
</script>
@endpush

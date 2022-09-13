
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
                        <th>No Transaksi</th>
                        <th>Nama Penukar</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Produk Yang Ditukarkan</th>
                        <th>Point Yang Ditukarkan</th>
                        <th>Metode Penukaran</th>
                        <th>Gambar</th>
                        <th>Bukyi</th>
                        <th>Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $key => $product)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $product->transaction_number }}</td>
                            <td>{{ $product->user?->name }}</td>
                            <td>{{ $product->user?->email }}</td>
                            <td>{{ $product->user?->mobile_number }}</td>
                            <td>{{ $product->product?->name }}</td>
                            <td>{{ $product->product?->point_needed }}</td>
                            <td>{{ $product->redeem_type }}</td>
                            <td><img src="{{ url('storage/products/' . $product->product?->image?->image) }}" alt="product" width="100"></td>
                            @if($product->redeem_type == 'pickup')
                                <td><img src="{{ url('storage/products/pickups/' . $product?->image?->first()->image) }}" alt="product" width="100"></td>
                            @else
                                <td><img src="{{ url('storage/products/deliverys/' . $produc?->image?->first()->image) }}" alt="product" width="100"></td>
                            @endif
                            
                             <td>
                                <a href="{{ route('admin.product.redeem.list.detail', $product->redeem_type) }}" class="btn btn-danger"> Upload </a>
                             </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data</td>
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
        oder : false
    });
</script>
@endpush
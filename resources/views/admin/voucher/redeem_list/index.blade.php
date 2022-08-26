
@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title align-items-center my-auto">Daftar Penukaran Voucher</h4>
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
                        <th>Voucher</th>
                        <th>Point Yang Ditukarkan</th>
                        <th>Gambar</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($vouchers as $key => $voucher)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ \App\Models\AccountPoint::where('voucher_id', $voucher->voucher->id)->where('user_id', $voucher->user?->id)->first()?->transaction_number }}</td>
                            <td>{{ $voucher->user?->name }}</td>
                            <td>{{ $voucher->user?->email }}</td>
                            <td>{{ $voucher->user?->mobile_number }}</td>
                            <td>{{ $voucher->voucher?->name }}</td>
                            <td>{{ $voucher->voucher?->point_needed }}</td>
                            <td><img src="{{ url('storage/vouchers/' . $voucher->voucher?->image) }}" alt="voucher" width="100"></td>
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
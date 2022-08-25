
@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
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

                                        <td><a href="{{ route('employee.voucher.show', $voucher->id) }}" class="btn btn-info btn-sm">Detail</a></td>
                                    
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


@endsection


@push('scripts')
<script>
    $('#mytable').DataTable({
            order : false
        });
</script>
@endpush
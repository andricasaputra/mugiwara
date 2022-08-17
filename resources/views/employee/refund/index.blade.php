@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    {{-- <a href="{{ route('admin.settings.refund.create') }}" class="btn btn-success">Tambah Setting Pajak</a> --}}
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Daftar Pengajuan Refund</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Refund Number</th>
                                                <th>Order ID</th>
                                                <th>User</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Jumlah Refund</th>
                                                <th>Alasan</th>
                                                <th>Detail Alasan</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($refunds as $refund)
                                        
                                                <tr>
                                                    <td>{{ $refund->refund_number }}</td>

                                                    <td>{{ $refund->order?->id }}</td>

                                                    <td>{{ $refund->user?->name }}</td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($refund->refund_request_date)->format('d-m-Y') }}

                                                    </td>

                                                    <td>{{ $refund->order?->payment?->amount }}</td>

                                                    <td>{{ $refund->reason?->name }}</td>

                                                    <td>{{ $refund->detail }}</td>

                                                    <td>{{ $refund->status }}</td>

                                                    <td>
                                                    	<a href="{{ route('admin.refund.show', $refund->id) }}" class="btn btn-warning mb-3">Detail</a>

                                                        <a href="{{ route('admin.refund.action.page', $refund->id) }}" class="btn btn-success">Tindakan</a>

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">No settings available</td> 
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection()

@section('scripts')
    <script>
        $('.confirm').on('click', function (e) {
            if (confirm('Apakah anda yakin akan menghapus data ini?')) {
                return true;
            }
            else {
                return false;
            }
        });

        $('#mytable').DataTable();
    </script>
@endsection()
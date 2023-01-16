@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">

                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">List Permohonan Withdrawal</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kantor Cabang</th>
                                                <th>Pemohon</th>
                                                <th>Nama Bank</th>
                                                <th>Nomor Rekening</th>
                                                <th>Jumlah</th>
                                                <th>Jumlah Setelah Fee</th>
                                                <th>Status Permohonan</th>
                                                <th>Alasan (apabila ditolak)</th>
                                                <th>Gambar Bukti Transfer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($withdraws as $key => $withdraw)
                                                <tr>

                                                    <td>{{ $key + 1 }}</td>

                                                    <td>
                                                    	{{ $withdraw->user?->office?->office?->name }} 
                                                    </td>

                                                    <td>
                                                        {{ $withdraw->user?->name }} 
                                                    </td>

                                                    <td>{{ $withdraw->bank_name }} </td>

                                                    <td>
                                                    	{{  $withdraw->account_number }}
                                                    </td>

                                                    <td>Rp @currency($withdraw->amount)</td>

                                                    <td>Rp @currency($withdraw->fee_amount)</td>

                                                    <td>
                                                        @if($withdraw->status == 'PENDING')
                                                            <span class="badge badge-pill badge-warning">
                                                                {{ $withdraw->status }} 
                                                            </span>
                                                        @elseif($withdraw->status == 'APPROVED')
                                                            <span class="badge badge-pill badge-success">
                                                                {{ $withdraw->status }} 
                                                            </span>
                                                        @else
                                                            <span class="badge badge-pill badge-danger">
                                                                {{ $withdraw->status }} 
                                                            </span>
                                                        @endif
                                                    </td>

                                                    <td>{{ $withdraw->reject_reason ?? '-' }} </td>

                                                    <td>
                                                        @if(! is_null($withdraw->image?->image))
                                                            <img src="{{ \Storage::disk('public')->url('withdraws/' . $withdraw->image?->image) }}" alt="bukti-transfer" width="100">
                                                        @else
                                                            No Image
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9">No data available</td> 
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

        $('#mytable').DataTable({
            order : false
        });
    </script>
@endsection()
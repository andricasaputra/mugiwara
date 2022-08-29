@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-sm-12">
            <div class="card">
                <div class="card-header">Profil</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ ucwords($customer->user?->name) }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $customer->user->email }}</td>
                            </tr>
                            <tr>
                                <td>Poin</td>
                                <td>:</td>
                                <td>@currency($customer->point)</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if(!is_null($accountPoint->voucher))
            <div class="col-lg-7 col-sm-12">
            <div class="card">
                <div class="card-header">Penukaran Voucher</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="user-table" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama Voucher</th>
                                    <th>Poin Voucher</th>
                                    <th>Poin Awal</th>
                                    <th>Poin Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accountPoints as $accountPoint)
                                <tr>
                                    <td>{{ $accountPoint->voucher?->name }}</td>
                                    <td>@currency($accountPoint->voucher?->point_needed)</td>
                                    <td>@currency($accountPoint->before)</td>
                                    <td>@currency($accountPoint->after)</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @elseif(!is_null($accountPoint->review))
            <div class="col-lg-7 col-sm-12">
            <div class="card">
                <div class="card-header">Review Menginap</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Rating</td>
                                <td>:</td>
                                <td>{{ $accountPoint->review?->rating }}</td>
                            </tr>
                            <tr>
                                <td>Komentar</td>
                                <td>:</td>
                                <td>{{ $accountPoint->review?->comment }}</td>
                            </tr>
                            <tr>
                                <td>Waktu Review</td>
                                <td>:</td>
                                <td>{{ $accountPoint->review?->created_at->format('d-m-Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @elseif(!is_null($accountPoint->affiliate))
        <div class="col-lg-7 col-sm-12">
            <div class="card">
                <div class="card-header">Penukaran Kode Refferal</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Kode Refferal</td>
                                <td>:</td>
                                <td>{{ $accountPoint->affiliate?->refferal_code }}</td>
                            </tr>
                            <tr>
                                <td>Device ID</td>
                                <td>:</td>
                                <td>{{ $accountPoint->affiliate?->device_id }}</td>
                            </tr>
                            <tr>
                                <td>Waktu Penukaran</td>
                                <td>:</td>
                                <td>{{ $accountPoint->affiliate?->created_at->format('d-m-Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @elseif(!is_null($accountPoint->product))
           <div class="col-lg-7 col-sm-12">
            <div class="card">
                <div class="card-header">Penukaran Produk</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Nama Produk</td>
                                <td>:</td>
                                <td>{{ $accountPoint->product?->name }}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td>{{ $accountPoint->product?->description }}</td>
                            </tr>
                            <tr>
                                <td>Waktu Penukaran</td>
                                <td>:</td>
                                <td>{{ $accountPoint->product?->created_at->format('d-m-Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
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

        $('#user-table').DataTable();
    </script>
@endsection()
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
                                <td>{{ $customer->user->name }}</td>
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
        <div class="col-lg-7 col-sm-12">
            <div class="card">
                <div class="card-header">History Poin</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="user-table" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama Voucher</th>
                                    <th>Poin Awal</th>
                                    <th>Poin Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accountPoints as $accountPoint)
                                <tr>
                                    <td>{{ $accountPoint->voucher->name }}</td>
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
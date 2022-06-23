@extends('layouts.main')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-center">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Paket</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $payment->email }}</td>
                                <td>{{ $payment->package_type }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 30px">
            <div class="col-md-12">
                <div class="text-center">
                    <a href="{{ route('users.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>

@endsection

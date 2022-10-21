@extends('layouts.main')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Permohonan Withdraw Saldo</h4>
            <form action="{{ route('employee.finance.withdraw.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="withdraw_date">Tanggal Penarikan</label>
                            <input type="date" class="form-control" id="withdraw_date" name="withdraw_date" value="{{ now()->format('Y-m-d') }}" required disabled>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="amount">Jumlah Saldo Yang Ingin Ditarik</label>
                            <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="account_number">Nomor Rekening</label>
                            <input type="number" class="form-control" id="account_number" name="account_number" value="{{ auth()->user()->office?->office?->account_number }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="bank_name">Nama bank Tujuan</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ auth()->user()->office?->office?->bank_name }}" required>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('employee.finance.index') }}" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
    $('#ratings').keypress(function(event){
        event.preventDefault();
    });
</script>
@endpush
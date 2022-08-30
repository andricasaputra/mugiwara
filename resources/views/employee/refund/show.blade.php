
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 col-sm-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Detail Refund</h4>
            <div class="card-body">
                <table class="display expandable-table table-striped" style="width:100%">
                	<tr>
                        <td>Refund Number</td>
                        <td>:</td>
                        <td>{{ $refund->refund_number }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Pengajuan</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($refund->refund_request_date)->format('Y-m-d H:i:s') }}</td>
                    </tr>
                    <tr>
                        <td>User</td>
                        <td>:</td>
                        <td>{{ $refund->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>:</td>
                        <td>{{ $refund->payment?->amount }}</td>
                    </tr>
                    <tr>
                        <td>Alasan</td>
                        <td>:</td>
                        <td>{{ $refund->reason?->name }}</td>
                    </tr>
                    <tr>
                        <td>Detail Alasan</td>
                        <td>:</td>
                        <td>{{ $refund->detail }} x</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>{{ $refund->status }} x</td>
                    </tr>
                    <tr>
                        <td>Tanggal {{ $refund->status }} </td>
                        <td>:</td>
                        <td>{{ $refund->refund_action_date }} x</td>
                    </tr>
                </table>
                <br>
                <a href="{{ route('employee.refund.index') }}" class="btn btn-sm btn-danger">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#discount_type').on('change', function() {
        if($(this).val() == 'fixed'){
            console.log($('#containerPercent').find('input'));
            $('#containerFixed').removeClass('d-none');
            $('#containerPercent').addClass('d-none');
            $('#containerFixed').find('input').prop('required', true);
            $('#containerFixed').find('input').val('');
            $('#containerPercent').find('input').prop('required', false);
        }else{
            $('#containerPercent').removeClass('d-none');
            $('#containerFixed').addClass('d-none');
            $('#containerPercent').find('input').prop('required', true);
            $('#containerPercent').find('input').val('');
            $('#containerFixed').find('input').prop('required', false);
        }
    });
</script>
@endpush


@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4><i class='fa fa-gear'></i>Tindakan permohonan withdraw</h4>
                    <hr>
                    <form  method="post" action="{{ route('admin.withdraw.action.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Withdrawal ID</label>
                            <input name="id" type="text" class="form-control form-control-lg" value="{{ $withdraw->id }}"  required readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Kantor Cabang</label>
                            <input name="accomodation_id" type="hidden" class="form-control form-control-lg" value="{{ $withdraw->user?->office?->office?->accomodation_id }}">
                            <input name="office" type="text" class="form-control form-control-lg" value="{{ $withdraw->user?->office?->office?->name }}"  required readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Pemohon</label>
                            <input name="user_id" type="text" class="form-control form-control-lg" value="{{ $withdraw->user?->name }}"  required readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Jumlah</label>
                            <input name="amount" type="text" class="form-control form-control-lg" value="{{ $withdraw->amount }}"  required readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Nama Bank</label>
                            <input name="bank_name" type="text" class="form-control form-control-lg" value="{{ $withdraw->bank_name }}"  required readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Nomor Rekening</label>
                            <input name="account_number" type="text" class="form-control form-control-lg" value="{{ $withdraw->account_number }}"  required readonly>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                @if($withdraw->status)
                                    <option value="{{ $withdraw->status }}">{{ $withdraw->status }}</option>
                                @endif
                                <option value="PENDING">PENDING</option>
                                <option value="APPROVED">APPROVE</option>
                                <option value="REJECTED">REJECT</option>
                            </select>
                        </div>

                         <div class="form-group">
                            <label for="reject_reason">Alasan (Apabila Ditolak) / optional</label>
                           <textarea name="reject_reason" cols="30" rows="10" class="form-control">{{ $withdraw->reject_reason }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="bukti_transfer">Bukti transfer / optional</label>
                            <div>
                                @if(! is_null($withdraw->image?->image))
                                    <img src="{{ \Storage::disk('public')->url('withdraws/' . $withdraw->image?->image) }}" alt="bukti-transfer" width="100">
                                @endif
                            </div>
                           <input type="file" name="bukti_transfer" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('admin.withdraw.index') }}" class="btn btn-danger">Kembali</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('link')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

    $(document).ready(function() {

        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

    });

    </script>

@endsection()

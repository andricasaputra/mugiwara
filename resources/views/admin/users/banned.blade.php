
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Banned User</h4>
            <form action="{{ route('users.banned') }}" method="post">
                @csrf

                <input type="hidden" name="user_id" value="{{ $user->id }}">

                 <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="{{ $user->name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="reason">Alasan (optional)</label>
                    <textarea name="reason" id="" cols="20" rows="10" class="form-control"></textarea>
                </div> 

                <button type="submit" class="btn btn-danger mr-2">Banned</button>

                <a href="{{ route('users.customer') }}" class="btn btn-light">Kembali</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection



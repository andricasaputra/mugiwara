
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Ubah Review</h4>
            <form action="{{ route('rooms.reviews.update', [$room->id, $review->id]) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select name="rating" class="form-control">
                        <option value="{{ $review->rating }}">{{ $review->rating }}</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Comment</label>
                    <textarea name="comment" class="form-control" cols="30" rows="10">{{ $review->comment }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('rooms.reviews.index', $room->id) }}" class="btn btn-light">Kembali</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection



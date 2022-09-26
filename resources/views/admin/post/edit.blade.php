
@extends('layouts.main')

@section('link')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Ubah Artikel</h4>
            @role('admin')
                <form action="{{ route('admin.post.update') }}" enctype="multipart/form-data" method="post">
            @else
                <form action="{{ route('employee.post.update') }}" enctype="multipart/form-data" method="post">
            @endrole
                <input type="hidden" name="id" value="{{ $post->id }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="category_post_id">Kategori</label>
                    <select name="category_post_id" id="category_post_id" class="form-control" required>
                        <option value="">~ Pilih ~</option>
                        @foreach($categoryPosts as $category)
                        <option value="{{ $category->id }}" {{ $post->category_post_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
                </div>
                <div class="form-group">
                    <label for="body">Isi</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{ $post->body }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Gambar <small>Optional | Isi jika ingin diubah</small></label>
                    <div>
                        <img src="{{ url('storage/posts/' . $post->image) }}" alt="" width="100">
                    </div>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="is_active">Status</label>
                    <select name="is_active" id="is_active" class="form-control" required>
                        <option value="">~ Pilih Status ~</option>
                        <option value="1" {{ $post->is_active == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $post->is_active == '0' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.post.index') }}" class="btn btn-light">Kembali</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({

          toolbar: [
              // [groupName, [list of button]]
              ['style', ['style']],
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['strikethrough', 'superscript', 'subscript']],
              ['fontsize', ['fontsize']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['height', ['height']],
              ['fontname', ['fontname']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'video']],
              ['view', ['fullscreen', 'codeview', 'help']]
              ]
          });

        $('.dropdown-toggle').dropdown()
    });
</script>
@endpush


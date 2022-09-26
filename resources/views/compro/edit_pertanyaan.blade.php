
@extends('layouts.main')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@section('link')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

@endsection
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Edit Pertanyaan</h4>
            <form action="{{ route('admin.pertanyaan.update.pertanyaan', $pertanyaans->id) }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" value="{{ $pertanyaans->keterangan }}">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" name="kategori" required>
                                <option value="">Pilih</option>
                                <option value="pertanyaan">Pertanyaan</option>
                                <option value="lain-lain">Lain-Lain</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="jawaban">Jawaban</label>
                            <textarea id="summernote" name="jawaban" cols="30" rows="10">{{ $pertanyaans->keterangan }}</textarea>
                        </div>
                    </div>


                </form>

                    <div class="container-fluid">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{route('admin.pertanyaan.pertanyaan')}}" class="btn btn-primary mr-2">Kembali</a>
                    </div>
                </div>
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
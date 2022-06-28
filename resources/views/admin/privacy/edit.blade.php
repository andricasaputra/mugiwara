@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4><i class='fa fa-gear'></i> Tambah kebijakan privasi</h4>
                    <hr>
                    <form  method="post" action="{{ route('privacy.update', $policy->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Judul</label>
                            <input name="title" type="text" class="form-control form-control-lg"  required value="{{ $policy->title }}">
                        </div>

                        <div class="form-group">
                           <label for="type">Isi Kebijakan Privasi</label>
                            <textarea name="body" id="editor" name="body">{!! $policy->body !!}</textarea>
                        </div>

                       
                        <button type="submit" class="btn btn-primary">Submit</button>
                       {{--  <button id="getdata" class="btn btn-warning">Print kebijakan privasi</button> --}}
                        <a href="{{ route('offices.index') }}" class="btn btn-danger">Kembali</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()

@section('scripts')

   <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>

    <script>
        $('.confirm').on('click', function (e) {
            if (confirm('Apakah anda yakin akan menghapus data ini?')) {
                return true;
            }
            else {
                return false;
            }
        });

        $('#mytable').DataTable();
    </script>
    <script>
        let theEditor;

        ClassicEditor
          .create(document.querySelector('#editor'))
          .then(editor => {
            theEditor = editor;

          })
          .catch(error => {
            console.error(error);
          });


        function getDataFromTheEditor() {
          return theEditor.getData();
        }

        document.getElementById('getdata').addEventListener('click', () => {
          alert(getDataFromTheEditor());
        });
    </script>
@endsection()
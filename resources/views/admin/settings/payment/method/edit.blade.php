
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Ubah Cara Pembayaran</h4>
            <form action="{{ route('admin.payments_methods.update', $method->id) }}" method="post">
                @csrf
                @method('PUT')


                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control"  name="name" required value="{{ $method->name }}">
                </div>

                <div class="form-group">
                    <label for="type">Tipe</label>
                    <select name="type" class="form-control" required>
                        <option value="{{ $method->type }}">{{ $method->type }}</option>
                        <option value="atm">ATM</option>
                        <option value="ibanking">Internet Banking</option>
                        <option value="mbanking">Mobile Banking</option>
                    </select>
                </div>


                 <div class="form-group">
                    <label for="method">Link</label>
                    <textarea name="method" class="form-control" id="editor" cols="30" rows="10">{{ $method->method }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.payments_methods.index') }}" class="btn btn-light">Kembali</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

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



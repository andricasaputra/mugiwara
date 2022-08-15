@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4><i class='fa fa-gear'></i>Edit Payment List</h4>
                    <hr>
                    <form  method="post" action="{{ route('admin.settings.payment.update', $payment->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Judul</label>
                            <select name="is_active" class="form-control">
                                <option value="{{ $payment->is_active }}">{{ $payment->is_active ==  1 ? 'Aktif' : 'Non Aktif' }}</option>

                                @if($payment->is_active == 1)
                                    <option value="">Non Aktif</option>
                                @else
                                    <option value="1">Aktif</option>
                                @endif
                                
                            </select>
                        </div>

                        <input type="hidden" name="image_type" value="payment_list">

                        <div class="form-group">
                           <label for="type">Ubah Gambar</label>
                           <div>
                               <img src="{{ $payment->image }}" alt="image" width="100">
                           </div>
                            <input type="file" class="form-control" name="image">
                        </div>

                       
                        <button type="submit" class="btn btn-primary">Submit</button>

                        <a href="{{ route('admin.settings.payment') }}" class="btn btn-danger">Kembali</a>
                        
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
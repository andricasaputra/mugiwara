
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session()->get('error') }}</div>
            @endif
            <h4 class="card-title">Tambah Team Header</h4>
            <form action="{{ route('admin.teamHeader.store.teamHeader') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <input type="text" class="form-control" name="heading">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="alt">Alt Gambar</label>
                            <input type="text" class="form-control" name="alt">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="jabatan">Sosial Media</label>
                            <div class="btn btn-primary btn-block tambah-sosmed">Tambah Sosial Media</div>
                            <div class="wrap-sosmed">
                                
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="url_sosmed">URL Sosmed</label>
                            <input type="text" class="form-control" name="url_sosmed">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="gambar_sosmed">Gambar Sosmed</label>
                            <input type="file" class="form-control" name="gambar_sosmed" required>
                        </div>
                    </div> -->

                </form>

                    <div class="container-fluid">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        let counter = 0;

        $('.tambah-sosmed').on('click', function(){
            let html = `
            <div class="row mt-2 sosmed-${counter}">
                <div class="col-lg-6">
                        <select name="sosmed[${counter}][class]" class="form-control" required>
                        <option value="fa-brands fa-linkedin">Linkedin</option>
                        <option value="fa-brands fa-facebook">Facebook</option>
                        <option value="fa-brands fa-twitter">Twitter</option>
                        <option value="fa-brands fa-instagram">Instagram</option>
                    </select>
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                    <input type="text" class="form-control" placeholder="URL" name="sosmed[${counter}][url]">
                    <div class="btn btn-danger ml-2 hapus-sosmed" data-counter="${counter}">Hapus</div>
                </div>
            </div>`
            $('.wrap-sosmed').append(html)
            counter = counter + 1;

            $('.hapus-sosmed').on('click', function(){
                let counterHapus = $(this).data('counter');
                $(`.sosmed-${counterHapus}`).remove();
                counter = counter - 1;
            })
        });



    })
</script>
@endpush


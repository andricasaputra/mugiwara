
@extends('layouts.main')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session()->get('error') }}</div>
            @endif
            <h4 class="card-title">Edit Team Header</h4>
            <form action="{{ route('admin.teamHeader.update.teamHeader', $teamHeaders->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <input type="text" class="form-control" name="heading" value="{{ $teamHeaders->heading }}">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="" cols="30" rows="10">{{ $teamHeaders->keterangan }}</textarea>
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
                            <input type="text" class="form-control" name="alt" value="{{ $teamHeaders->alt }}">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="jabatan">jabatan</label>
                            <input type="text" class="form-control" name="jabatan" value="{{ $teamHeaders->jabatan }}">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="jabatan">Sosial Media</label>
                            <div class="btn btn-primary btn-block tambah-sosmed">Tambah Sosial Media</div>
                            <div class="wrap-sosmed">
                                @php($counter=0)
                                @if($teamHeaders->url_sosmed !== "")
                                    @foreach(json_decode($teamHeaders->url_sosmed) as $k => $t)
                                        <div class="row mt-2 sosmed-{{$counter}}">
                                            <div class="col-lg-6">
                                                    <select name="sosmed[{{$counter}}][class]" class="form-control" required>
                                                    <option value="fa-brands fa-linkedin" {{$t->class == 'fa-brands fa-linkedin' ? 'selected' : ''}}>Linkedin</option>
                                                    <option value="fa-brands fa-facebook" {{$t->class == 'fa-brands fa-facebook' ? 'selected' : ''}}>Facebook</option>
                                                    <option value="fa-brands fa-twitter" {{$t->class == 'fa-brands fa-twitter' ? 'selected' : ''}}>Twitter</option>
                                                    <option value="fa-brands fa-instagram" {{$t->class == 'fa-brands fa-instagram' ? 'selected' : ''}}>Instagram</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 d-flex align-items-center">
                                                <input type="text" class="form-control" placeholder="URL" value="{{$t->url}}" name="sosmed[{{$counter}}][url]">
                                                <div class="btn btn-danger ml-2 hapus-sosmed" data-counter="{{$counter}}">Hapus</div>
                                            </div>
                                        </div>
                                        @php($counter++)
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="url_sosmed">URL Sosmed</label>
                            <input type="text" class="form-control" name="url_sosmed" value="{{ $teamHeaders->url_sosmed }}">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="gambar_sosmed">Gambar Sosmed</label>
                            <input type="file" class="form-control" name="gambar_sosmed">
                        </div>
                    </div> -->

                </form>

                    <div class="container-fluid">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{route('admin.teamHeader.teamHeader')}}" class="btn btn-primary mr-2">Kembali</a>
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
        let counter = parseInt('{{$counter}}');
        console.log(counter);

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

        $('.hapus-sosmed').on('click', function(){
            let counterHapus = $(this).data('counter');
            $(`.sosmed-${counterHapus}`).remove();
            counter = counter - 1;
        })

    })
</script>
@endpush

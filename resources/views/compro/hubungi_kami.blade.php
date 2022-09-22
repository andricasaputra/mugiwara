@extends('layouts.main')

@section('content')


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title align-items-center my-auto">Hubungi Kami</h4>
                {{-- <a href="{{ route('admin.hubungiKami.create.hubungiKami') }}" class="btn btn-primary btn-sm align-items-center my-auto">Hubungi Kami</a> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="display expandable-table table-striped text-center" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Judul Bantuan</th>
                        <th>Pertanyaan</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $no =0;
                        @endphp
                        @foreach ($hubungiKamis as $item)
                        @php
                            $no++;
                        @endphp
                        <tr>
                            <td>{{ $no   }}</td>
                            <td> {{ $item->nama_lengkap }}</td>
                            <td> {{ $item->email }}</td>
                            <td> {{ $item->judul_pertanyaan }}</td>
                            <td> {{ strlen($item->pertanyaan) > 10 ? substr($item->pertanyaan,0,50)."..." : $item->pertanyaan }}</td>
                            <td>
                                <img src="{{ asset('images/compro/hubungi_kami/' . $item->file) }}" width="100">
                            </td>
                            <td>
                                <a href="#" data-nama="{{$item->nama_lengkap}}" data-email="{{ $item->email }}" data-judul="{{ $item->judul_pertanyaan }}" data-pertanyaan="{{$item->pertanyaan}}" data-toggle="modal" data-target="#detail" class="btn btn-primary btn-sm">Detail</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('admin.hubungiKami.delete.hubungiKami', $item->id) }}">Hapus</a>
                                <a class="btn btn-success btn-sm" href="{{ route('admin.hubungiKami.compose.hubungiKami', $item->id) }}">Compose</a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span class="text-orange-tagar-manual">|</span> Detail</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <b>Nama</b>
                <div id="detail-nama"></div>
                <b>Email</b>
                <div id="detail-email"></div>
                <b>Judul</b>
                <div id="detail-judul"></div>
                <b>Bantuan</b>
                <div id="detail-pertanyaan"></div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>



@push('scripts')
<script>
    $('#mytable').DataTable({
        oder : false
    });

    $('#detail').on('shown.bs.modal', function (e) {
        let name = $(e.relatedTarget).data('nama')
        let email = $(e.relatedTarget).data('email')
        let judul = $(e.relatedTarget).data('judul')
        let pertanyaan = $(e.relatedTarget).data('pertanyaan')
        console.log($('#detail').find('#detail-nama'));
        $('#detail').find('#detail-nama').html(name);
        $('#detail').find('#detail-email').html(email);
        $('#detail').find('#detail-judul').html(judul);
        $('#detail').find('#detail-pertanyaan').html(pertanyaan);
    })
</script>
@endpush


@endsection

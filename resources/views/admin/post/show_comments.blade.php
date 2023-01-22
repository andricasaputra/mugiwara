@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Komentar</p>
                                <div class="row">
                                  <div class="col-12">

                                    @foreach($comments as $comment)

                                        <div class="card">
                                          <div class="card-body">
                                            <div class="card-header text-end">
                                                <div>
                                                    <div class="row text-end">
                                                        <form method="post" action="{{ route('admin.post.delete.comment', $comment->id) }}">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="card-title">
                                                <img src="{{ url('storage/avatars/' . $comment->user?->account?->avatar) }}" alt="avatar" style="border-radius: 50%"  width="50">
                                                {{ ucwords($comment->user?->name) }}
                                            </h6>
                                            <div class="d-flex justify-content-start">
                                                <p class="card-text">{{ $comment->comment }}</p>
                                                
                                            </div>
                                            <span>{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                          </div>
                                        </div>
                                    @endforeach
                                    
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <a href="{{ route('admin.post.index') }}" class="btn btn-danger">Kembali</a>
    </div>
</div>
   
@endsection

@section('scripts')
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
@endsection
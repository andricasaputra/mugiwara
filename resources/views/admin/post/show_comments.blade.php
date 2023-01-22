@extends('layouts.main')

@section('content')

<div class="container-fluid">
   <div class="row">
       <div class="col-12">
        <h3>Komentar</h3>
           <div class="card">
               <div class="card-body">
                   @forelse($comments as $comment)

                    <div class="card mb-2">
                      <div class="text-end">
                          {{-- <h5 class="card-header text-end">Featured</h5> --}}
                      </div>
                      <div class="card-body">
                        <img src="{{ url('storage/avatars/' . $comment->user?->account?->avatar) }}" alt="avatar" style="border-radius: 50%; margin-bottom: 30px"  width="50">
                            {{ ucwords($comment->user?->name) }}
                        <h5 class="card-title">{{ $comment->comment }}</h5>
                        <p class="card-text">{{ $comment->created_at->diffForHumans() }}</p>
                        <form method="post" action="{{ route('admin.post.delete.comment', $comment->id) }}">
                                @csrf
                                @method('DELETE')

                            <button class="btn btn-danger btn-sm mt-3" type="submit">Hapus</button>
                        </form>
                       
                      </div>
                    </div>

                    @empty

                    <div class="card">
                      <div class="text-end">
                          {{-- <h5 class="card-header text-end">Featured</h5> --}}
                      </div>
                      <div class="card-body">
                       
                        <h5 class="card-title text-center">Belum Ada Komentar</h5>
                       
                      </div>
                    </div>

                    @endforelse
               </div>
           </div>
       </div>
   </div>
   <div class="row">
       <div class="col-12">
           <div class="d-flex justify-content-center mt-3">
               {{ $comments->links() }}
           </div>
       </div>
   </div>
   <div class="row">
       <div class="col-12">
           <div class="d-flex justify-content-center mt-3">
               <a href="{{ route('admin.post.index') }}" class="btn btn-primary">Kembali</a>
           </div>
       </div>
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
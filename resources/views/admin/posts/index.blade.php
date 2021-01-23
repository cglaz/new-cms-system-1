<x-admin-master>

    @section('content')

        <h1 class="text-center">All posts</h1>

        <div class="card shadow mb-4">
             @if(session('message_delete'))
                <div class="card-header py-3">
                    <div class="alert alert-danger text-center font-weight-bold" role="alert">{{session('message_delete')}}</div>
                 </div>
            @elseif(session('message_created'))
                <div class="alert alert-success text-center font-weight-bold" role="alert">{{session('message_created')}}</div>
             @elseif(session('message_updated'))
                <div class="alert alert-success text-center font-weight-bold" role="alert">{{session('message_updated')}}</div>
            @endif
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Owner</th>
                      <th>Title</th>
                      <th>Content</th>
                      <th>Image</th>
                      <th>Created at</th>
                      <th>Updated at</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->user->name}}</td>
                            <td>@can('view', $post)<a href="{{route('post.edit', $post->id)}}">@endcan{{$post->title}}</a></td>
                            <td>{{Str::limit($post->body, 50, '...')}}</td>
                            <td>
                                <img height="40px" src="{{$post->post_image}}" alt="">
                            </td>
                            <td>{{$post->created_at->diffForHumans()}}</td>
                            <td>{{$post->updated_at->diffForHumans()}}</td>
                            <td>

                                @can('view', $post)

                                <form action="{{route('post.destroy', $post->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>

                                @endcan

                        </tr>
                     @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>


          {{$posts->links()}}

    @endsection

    @section('scripts')

     <!-- Page level plugins -->
  <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->


    @endsection

</x-admin-master>

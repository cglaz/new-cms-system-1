<x-admin-master>

@section('content')

<h1 class="text-center">Users</h1>

<div class="card shadow mb-4">
             @if(session('message_user_delete'))
                <div class="card-header py-3">
                    <div class="alert alert-danger text-center font-weight-bold" role="alert">{{session('message_user_delete')}}</div>
                 </div>
            @elseif(session('message_user_created'))
                <div class="alert alert-success text-center font-weight-bold" role="alert">{{session('message_user_created')}}</div>
                @endif
            @if(session('message_user_updated'))
                    <div class="alert alert-success text-center font-weight-bold" role="alert">{{session('message_user_updated')}}</div>
            @endif
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Avatar</th>
                      <th>Email</th>
                      <th>Created at</th>
                      <th>Updated at</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>@can('view', $user)<a href="{{route('user.profile.show', $user->id)}}">@endcan{{$user->username}}</a></td>
                            <td>{{$user->name}}</td>
                            <td>
                                <img height="40px" src="{{$user->avatar}}" alt="">
                            </td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at->diffForHumans()}}</td>
                            <td>{{$user->updated_at->diffForHumans()}}</td>
                            <td>

                                <form action="{{route('user.destroy', $user->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                     @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>



    @endsection

    @section('scripts')

     <!-- Page level plugins -->
  <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->


    @endsection

</x-admin-master>

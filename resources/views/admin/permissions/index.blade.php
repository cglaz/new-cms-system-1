<x-admin-master>

@section('content')

    <h1 class="text-center">Permissions</h1>

    @if(session('message_permission_delete'))
                <div class="card-header py-3">
                    <div class="alert alert-danger text-center font-weight-bold" role="alert">{{session('message_permission_delete')}}</div>
                 </div>
    @elseif(session('message_permission_created'))
                <div class="alert alert-success text-center font-weight-bold" role="alert">{{session('message_permission_created')}}</div>
    @elseif(session('message_permission_updated'))
                <div class="alert alert-success text-center font-weight-bold" role="alert">{{session('message_permission_updated')}}</div>
    @endif

    <div class="row">

        <div class="col-sm-3 mt-4">

            <form method="post" action="{{route('permissions.store')}}">
                @csrf
                <div class="form-group">
                    <h4>Create a permission</h4>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                    <div>
                        @error('name')
                            <span><strong>{{$message}}</strong></span>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Create</button>
            </form>

        </div>

        <div class="col-sm-9">
        <div class="card-body">
              <div class="table-responsive">
              <h4 class="text-center">Edit permission</h4>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{$permission->id}}</td>
                            <td><a href="{{route('permissions.edit', $permission->id)}}">{{$permission->name}}</a></td>
                            <td>{{$permission->slug}}</td>
                            <td>
                                <form action="{{route('permissions.destroy', $permission->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach()
                  </tbody>
                </table>
              </div>
            </div>

        </div>

    </div>

@endsection

</x-admin-master>

<x-admin-master>
    @section('content')
    <h1 class="text-center">Edit role: {{$role->name}}</h1>
    @if(session('message_role_updated_fill_the_name'))
                <div class="card-header py-3">
                    <div class="alert alert-danger text-center font-weight-bold" role="alert">
                        {{session('message_role_updated_fill_the_name')}}
                    </div>
                 </div>
    @endif
<div class="row">
    <div class="col-sm-3">
        <form method="post" action="{{route('roles.update', $role->id)}}">
        @csrf
        @method('PUT')
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control sm-3" name="name" id="name" value="{{$role->name}}">
            </div>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
    @if($permissions->isNotEmpty())
    <h4 class="text-center">Permissions</h4>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Options</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Attach</th>
                            <th>Detach</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td><input type="checkbox"
                                @foreach($role->permissions as $role_permission)
                                    @if($role_permission->slug == $permission->slug)
                                        checked
                                    @endif
                                @endforeach
                            ></td>
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->slug}}</td>
                            <td>
                                <form method="post" action="{{route('role.permission.attach', $role)}}">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="permission" value="{{$permission->id}}">
                                    <button
                                    type="submit"
                                    class="btn btn-primary"
                                    @if($role->permissions->contains($permission))
                                        disabled
                                    @endif>
                                    Attach

                                    </button>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="{{route('role.permission.detach', $role)}}">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="permission" value="{{$permission->id}}">
                                    <button  @if(!$role->permissions->contains($permission))
                                        disabled
                                    @endif class="btn btn-danger">Detach</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    </div>
</div>
    @endsection
</x-admin-master>

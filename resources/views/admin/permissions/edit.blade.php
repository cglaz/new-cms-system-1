<x-admin-master>
    @section('content')
    <h1 class="text-center">Edit permission: {{$permission->name}}</h1>
    @if(session('message_permission_updated_fill_the_name'))
                <div class="card-header py-3">
                    <div class="alert alert-danger text-center font-weight-bold" role="alert">
                        {{session('message_permission_updated_fill_the_name')}}
                    </div>
                 </div>
    @endif
<div class="row">
    <div class="col-sm-3">
        <form method="post" action="{{route('permissions.update', $permission->id)}}">
        @csrf
        @method('PUT')
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control sm-3" name="name" id="name" value="{{$permission->name}}">
            </div>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

    @endsection
</x-admin-master>

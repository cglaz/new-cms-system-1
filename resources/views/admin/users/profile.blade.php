<x-admin-master>


@section('content')

    <h1>User Profil for: {{$user->name}}</h1>

    <div class="row">

    <div class="col-sm-6">

            <form action="{{route('user.profile.update', $user)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">

                <img class="img-profile rounded-circle" height="50px" src="{{$user->avatar}}">

                </div>

                <div class="form-grup">
                    <input type="file" name="avatar">
                </div>

                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text"
                           name="username"
                           class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}"
                           id="username"
                           value="{{$user->username}}">
                           @error('username')
                            <div class="invalid-feedback">{{$message}}</div>
                           @enderror
                </div>


                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text"
                           name="name"
                           class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                           id="name"
                           value="{{$user->name}}">
                           @error('name')
                           <div class="invalid-feedback">{{$message}}</div>
                           @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text"
                           name="email"
                           class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"
                           id="email"
                           value="{{$user->email}}">

                           @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                           @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           id="password">

                           @error('password')
                            <div class="alert alert-danger">{{$message}}</div>
                           @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirmation">Confirm password</label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           id="password-confirmation">
                           @error('password_confirmation')
                            <div class="alert alert-danger">{{$message}}</div>
                           @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

    </div>

    </div>

@endsection

</x-admin-master>

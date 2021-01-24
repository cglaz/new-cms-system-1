<x-admin-master>

    @section('content')

    <h1 class="text-center">Edit post</h1>

        <form method="post" action="{{route('post.update', $posts->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div clas="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter title" value="{{$posts->title}}">
            </div>

            <div clas="form-group">
                <div><img  src="{{$posts->post_image}}" alt="" class="img-thumbnail"></div>
                <label for="title">File</label>
                <input type="file" name="post_image" class="form-control-file" id="post_image" aria-describedby="">
            </div>

            <div class="form-group">
                    <textarea name="body" class="form-control" id="body" cols="30" rows="10">{{$posts->body}}</textarea>
            </div>

            <button class="btn btn-primary" type="submit">Edit post</button>
        </form>

    @endsection

</x-admin-master>

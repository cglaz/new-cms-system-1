<?php

namespace App\Http\Controllers;

use App\Post;
<<<<<<< HEAD
=======
use App\User;
>>>>>>> c605bc6aac4f702bc8d955535b0ee67616418d20
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use session;

class PostController extends Controller
{

    use AuthorizesRequests;
    //
    use AuthorizesRequests;

    public function index()
    {

<<<<<<< HEAD
        $posts = auth()->user()->posts()->paginate(5);
=======
<<<<<<< HEAD
        $posts = auth()->user()->posts()->paginate(3);
>>>>>>> e42dd0e7771d3baa2372274ca4ae7dfa635721e6

=======
        $posts = auth()->user()->posts()->paginate(5);
>>>>>>> c605bc6aac4f702bc8d955535b0ee67616418d20
        return view('admin.posts.index', ['posts' => $posts]);

    }

    public function show(Post $post)
    {

        return view('blog-post', ['post' => $post]);

    }

    public function create()
    {
        $this->authorize('create', Post::class);
        return view('admin.posts.create');

    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
        $inputs = request()->validate([
            'title' => 'required|unique:posts|max:255',
            'post_image' => 'file',
            'body' => 'required',
        ]);

        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        }

        Auth::user()->posts()->create($inputs);

        session()->flash('message_created', 'Post has been created');

        return redirect()->route('post.index');

    }

    public function edit(Post $post)
    {
        $this->authorize('view', $post);
<<<<<<< HEAD

=======
>>>>>>> c605bc6aac4f702bc8d955535b0ee67616418d20
        return view('admin.posts.edit', ['posts' => $post]);

    }

    public function update(Post $post, Request $request)
    {

        $inputs = request()->validate([

            'title' => 'required|min:8|max:100',
            'post_image' => 'file',
            'body' => 'required',
        ]);

        if (request('post_image')) {

            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);

        $post->save();

        session()->flash('message_updated', 'Post has been updated');

        return redirect()->route('post.index');

    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
<<<<<<< HEAD
=======

>>>>>>> c605bc6aac4f702bc8d955535b0ee67616418d20
        $post->delete();

        session()->flash('message_delete', 'Post title: ' . $post->title . ' has been deleted');

        return back();

    }

    public function update(Post $post)
    {
        $inputs = request()->validate([
            'title' => 'required|unique:posts|max:255',
            'post_image' => 'file',
            'body' => 'required',
        ]);

        if (request('post_image')) {

            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }
        $post->title = $inputs['title'];
        $post->title = $inputs['body'];

        $this->authorize('update', $post);

        $post->update($inputs);

        session()->flash('message_updated', 'Post title: ' . $inputs['title'] . ' has been updated');

        return redirect()->route('post.index');

    }
}

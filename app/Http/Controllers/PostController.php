<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use session;

class PostController extends Controller
{
    //
    use AuthorizesRequests;

    public function index()
    {

        $posts = auth()->user()->posts()->paginate(3);

        return view('admin.posts.index', ['posts' => $posts]);

    }

    public function show(Post $post)
    {

        return view('blog-post', ['post' => $post]);

    }

    public function create()
    {

        return view('admin.posts.create');

    }

    public function store(Request $request)
    {
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

        return view('admin.posts.edit', ['posts' => $post]);

    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
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

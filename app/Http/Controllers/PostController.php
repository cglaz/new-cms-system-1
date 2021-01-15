<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use session;

class PostController extends Controller
{

    use AuthorizesRequests;
    //

    public function index()
    {

        $posts = auth()->user()->posts;
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

    public function store()
    {
        $this->authorize('create', Post::class);
        $inputs = request()->validate([

            'title' => 'required|min:8|max:100',
            'post_image' => 'file',
            'body' => 'required',
        ]);

        if (request('post_image')) {

            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);

        session()->flash('message_created', 'Post title: ' . $inputs['title'] . ' has been created');

        return redirect()->route('post.index');

    }

    public function edit(Post $post)
    {
        $this->authorize('view', $post);
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

        $post->delete();

        session()->flash('message', 'Post title: ' . $post->title . ' has been deleted');

        return back();

    }
}

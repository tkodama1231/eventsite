<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prpost;
use App\Http\Requests\Practice_PostRequest;

class Practice_PostController extends Controller
{
    public function index()
    {
        $posts = Prpost::latest()->get();

        return view('practice_index')
            ->with(['posts' => $posts]);
    }

    // Implicit Binding
    public function show(Prpost $post)
    {
        return view('practice_posts.practice_show')
            ->with(['post' => $post]);
    }

    public function create()
    {
        return view('practice_posts.practice_create');
    }

    public function store(Practice_PostRequest $request)
    {
        $post = new Prpost();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return redirect()
            ->route('posts.index');
    }

    // Implicit Binding
    public function edit(Prpost $post)
    {
        return view('practice_posts.practice_edit')
            ->with(['post' => $post]);
    }

    public function update(Practice_PostRequest $request, Prpost $post)
    {
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return redirect()
            ->route('posts.show', $post);
    }

    public function destroy(Prpost $post)
    {
        $post->delete();

        return redirect()
            ->route('posts.index');
    }
}

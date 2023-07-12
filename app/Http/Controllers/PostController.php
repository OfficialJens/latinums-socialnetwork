<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'body'=>'required',
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', '=', $id)->get();

        return view('posts.show', compact('post', 'comments'));
    }

    public function likePost($id)
    {
        $user = User::find(Auth::user()->id);
        $post = Post::find($id);

        $user->like($post);

        return redirect()->back();
    }

    public function unlikePost($id)
    {
        $user = User::find(Auth::user()->id);
        $post = Post::find($id);

        $user->unlike($post);

        return redirect()->back();
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->back()->with('success', 'Succes! Je post is succesvol verwijderd!');
    }
}

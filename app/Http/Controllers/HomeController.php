<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();
        $comments = Comment::orderBy('created_at', 'DESC')->take(2)->get();

        return view('home', compact('posts', 'comments'));
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $post_input = $request->all();
        $post_input['author'] = auth()->user()->id;

        Post::create($post_input);

        return redirect()->route('home');
    }

    public function storeComment(Request $request)
    {
        $request->validate([
            'body'=>'required',
        ]);

        $comment_input = $request->all();
        $comment_input['user_id'] = auth()->user()->id;

        Comment::create($comment_input);

        return back();
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Succes! Je comment is succesvol verwijderd!');
    }
}

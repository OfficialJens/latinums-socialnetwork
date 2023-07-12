<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

class GebruikerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('/gebruiker-zoeken');
    }

    public function profiel($id)
    {
        $user = User::where('id', '=', $id)->get();
        $user_posts = Post::orderBy('created_at', 'DESC')->take(5)->get();

        return view('zoekGebruiker.profiel', compact('user', 'user_posts'));
    }

    public function search(Request $request)
    {
        $gebruiker = User::all();
        $search = $request->input('search');

        $persoonSearch = User::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('nickname', 'LIKE', "%{$search}%")
            ->get();

        return view('zoekGebruiker.search', compact('persoonSearch', 'gebruiker'));
    }

    public function followUser($id)
    {
        $user1 = User::find(Auth::user()->id);
        $user2 = User::find($id);

        $user1->follow($user2);
        $user1->unfollow($user2);
        $user1->toggleFollow($user2);
        $user1->acceptFollowRequestFrom($user2);
        $user1->rejectFollowRequestFrom($user2);

        $user1->isFollowing($user2);
        $user2->isFollowedBy($user1);
        $user2->hasRequestedToFollow($user1);

        return redirect()->back()->with('success', 'your message,here');
    }

    public function unFollowUser()
    {
        $user1 = User::find(Auth::user()->id);
        $user2 = User::find(2);

        $user1->unfollow($user2);

        return redirect()->back()->with('success', 'your message,here');
    }
}

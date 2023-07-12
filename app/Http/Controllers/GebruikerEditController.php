<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class GebruikerEditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('/instellingen');
    }

    public function update(Request $request)
    {

         $request->validate([
            'name' => 'required|min:10',
            'nickname' => 'required|min:5|unique:users',
            'password' => 'required|min:16',
            'email' => 'required|email|unique:users'
        ]);

        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->nickname = $request->nickname;
        $user->password = Hash::make($request->input('password'));
        $user->email = $request->email;

        $user->save();

        return redirect('instellingen')->with('success', 'Je gegevens zijn succesvol aangepast!');
    }

    public function store(Request $request)
    {

        if($request->hasFile('avatar')) {
            $filename = $request->file('avatar')->getClientOriginalName();
            $request->avatar->storeAs('avatar',$filename,'public');

            $user = Auth::user();
            $user->avatar = 'avatar/'.$filename;
            $user->update();
        }

        return redirect()->back()->with('success', 'Succes! Je avatar is succesvol aangepast!');
    }
}

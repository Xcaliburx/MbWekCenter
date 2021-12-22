<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;

class ProfileController extends Controller
{
    //
    public function index(){
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();

        return view('profile', ['user' => $user]);
    }

    public function update(Request $request){
        $id = Auth::user()->id;

        $request->validate([
            'name' => 'required|string|max:30',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required'
        ]);

        User::where('id', $id)->update([
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'gender' => $request->input('gender')
        ]);

        return redirect('/user/profile')->with('success',' Update Success!');
    }
}

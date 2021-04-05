<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $users = User::all();
        return view('user.index',compact('users'));
    }

    public function show(User $user){
        return view('user.show',compact('user'));
    }
    public function edit(User $user){
        return view('user.edit',compact('user'));
    }

    public function update(Request $request, User $user){
        $validated = $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        ]);
        dd($request);
    }
}

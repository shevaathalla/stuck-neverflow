<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {              
        $validated = $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'avatar' => 'mimes:png,jpg,jpeg,gif,svg',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password =  bcrypt( $request->input('new_password'));
            } else {
                return redirect()->back()->with('toast_danger','Gagal');
            }
        }        
        $user->save();
        if($request->file('avatar')){
            $file= $request->file('avatar');
            $filename = $request->avatar->getClientOriginalName();
            Image::make($file)->resize(300, 300)->save( public_path('storage/images/avatar/' . $filename ) );
            
            $user->update(['avatar'=>$filename]);            
        }        
        return redirect(route('user.show',['user'=>$user]))->with('toast_success', 'User Berhasil diupdate');
    }
}

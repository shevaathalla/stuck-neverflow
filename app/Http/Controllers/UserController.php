<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin'])->except([
            'show','dashboard','edit','update'
        ]);

        $this->middleware(['user'])->only([
            'edit','dashboard','update'
        ]);
    }

    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }
    public function create(){
        return view('user.create');
    }

    public function store(Request $request){
        // dd($request);
        $validated = $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:password|same:password',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect(route('user.index'))->with('toast_success','Account berhasil dibuat');
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'avatar' => 'mimes:png,jpg,jpeg,gif,svg',
            'current_password' => 'required',
            'new_password' => 'nullable|min:8|max:12|',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        ]);

        // dd($request);
        $user = User::findOrFail(Auth::user()->id);
        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                if ($request->file('avatar')) {
                    $file = $request->file('avatar');
                    $filename = $request->avatar->getClientOriginalName();
                    Image::make($file)->resize(300, 300)->save(public_path('storage/images/avatar/' . $filename));

                    $user->update(['avatar' => $filename]);
                }
                if (!is_null($request->input('new_password'))) {
                    $user->password =  bcrypt($request->input('new_password'));
                }
                $user->save();
                return redirect(route('user.show', ['user' => $user]))->with('toast_success', 'User Berhasil diupdate');
            } else {
                return redirect()->back()->with('toast_danger', 'Password Salah');
            }
        }        
        return redirect()->back()->with('toast_danger', 'User Tidak diupdate');        
    }

    public function dashboard(User $user){
        $questions = Question::all();
        $articles = Article::all();

        return view('dashboard',compact(['questions','articles']));
    }

    public function destroy(User $user){
        User::destroy($user->id);
        return redirect(route('user.index'))->with('toast_success', 'Account berhasil dihapus');
    }

    public function verify(User $user){
        User::where('id',$user->id)->update([
            'email_verified_at' => now()
        ]);
        return redirect(route('user.index'))->with('toast_success','Email account berhasil diverifikasi');
    }
}

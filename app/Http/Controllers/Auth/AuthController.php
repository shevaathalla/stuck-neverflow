<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToProvider(Request $request)
    {
        return Socialite::driver('github')
            ->with(['redirect_uri' => env('GITHUB_CALLBACK_URL' ) . '?redirect=' . $request->input('redirect')])
            ->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        $githubUser = Socialite::driver('github')->user();
        // dd($user);
        $user = User::where('provider_id',$githubUser->getId())->orWhere('email',$githubUser->getEmail())->first();

        if ($githubUser->getEmail() == $user->email) {
            User::find($user->id)->update([
                'provider_id' => $githubUser->getId()
            ]);
        }
        // dd($user);
        if (!$user) {
            $user = User::create([
                'email' => $githubUser->getEmail(),
                'name' => $githubUser->getName(),
                'provider_id' => $githubUser->getId()
            ]);
        }        
            Auth::login($user,true);
            return redirect(route('home'));
    }
}

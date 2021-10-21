<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use MercurySeries\Flashy\Flashy;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($pseudo, Request $request)
    {
        if (Auth::user()->active == 0 && Auth::user()->verification_code !== null) {
            return redirect()->route('verify');
        } else {
            $user = User::where('pseudo', $pseudo)->first();
            if ($user) {
                return view('home', compact('user'));
            } else {
                return abort(404, 'we didnt find your page try another way!');
            }
        }
    }
    public function verify()
    {
        if (Auth::user()->active == 1 && Auth::user()->verification_code === null) {
            return redirect()->route('home', Auth::user()->pseudo);
        } else {
            return view('verify');
        }
    }
    public function verifyCode(Request $request)
    {
        $user = Auth::user();
        if ($user->verification_code === $request->code) {
            $user->active = 1;
            $user->verification_code = null;
            $user->email_verified_at = Carbon::now();
            $user->save();
            return redirect()->route('home', $user->pseudo);
        } else {
            return back()->with('error', 'Your code is invalid');
        }
    }
    public function welcome()
    {
        $user = Auth::user();
        $posts = Post::orderby('created_at', 'desc')->get();
        return view('welcome', compact('user', 'posts'));
    }
    public function editProfile($pseudo)
    {
        $user = User::where('pseudo', $pseudo)->first();
        if ($user) {
            return view('user.edit', compact('user'));
        } else {
            abort(404);
        }
    }
    public function updateProfile(Request $request, $pseudo)
    {
        $request->validate([
            'name' => 'required',
            'pseudo' => 'required',
            'avatar' => 'mimes:png,jpg,jpeg,svg',
            'biography' => 'min:3'

        ]);
        $user = User::where('pseudo', $pseudo)->first();
        if ($user) {
            $user->name = $request->name;
            $check_user = User::where('pseudo', $request->pseudo)->first();
            if ($check_user) {
                flashy()->error('Pseudo already exists');
                return back();
            } else {
                if ($request->pseudo !== $user->pseudo) {
                    $user->pseudo = $request->pseudo;
                }
            }
            $user->biography = $request->biography;
            if ($request->hasFile('avatar')) {
                $user->avatar = $request->file('avatar')->store('profiles');
            }
            $user->save();
            flashy()->success('Your profile has been updated successfully');
            return redirect()->route('home', $user->pseudo);
        } else {
            return abort(404);
        }
    }
    public function changePassword(Request $request, $pseudo)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);
        $user = User::where('pseudo', $pseudo)->first();
        if ($user) {
            if (Hash::check($request->old_password, $user->password)) {
                if ($request->new_password === $request->confirm_password) {
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    flashy()->success('Password has been updated successfully');
                    return redirect()->route('home', $user->pseudo);
                } else {
                    flashy()->error('Both passwords don\'t match');
                }
            } else {
                flashy()->error('Password is incorrect');
                return back();
            }
        } else {
            return abort(404);
        }
    }
    public function addPost($user_id)
    {
        $user = Auth::user();
        return view('post.addPost', compact('user'));
    }
}

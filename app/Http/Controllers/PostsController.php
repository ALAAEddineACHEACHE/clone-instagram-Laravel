<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.addPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|mimes:png,jpg,jpeg,svg'

        ]);


        $post = new post();
        $post->user_id = Auth::id();
        if ($request->hasFile('photo')) {
            $post->photo = $request->file('photo')->store('publications');
        }
        $post->description = $request->description;

        $post->save();
        flashy()->success('Le poste a été sauvegardé avec succès');
        return redirect()->route('welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function storeLike(Request $request)
    {
        $like = new Like();
        $like->post_id = $request->post_id;
        $like->user_id = Auth::id();
        $like->save();
        if ($like->save()) {
            return 1;
        } else {
            $like->post_id = $request->post_id;
            $like->user_id = Auth::id();
            $like->save();
            if ($like->save()) {
                return 1;
            } else {
                return 0;
            }
        }
    }
    private function checkIfUserLike($post_id)
    {
        $like = Like::where('post_id', $post_id)->first();
        $post = Post::findOrFail($post_id);
        $post->likes->contains(Auth::id());
        if ($post->user_id == Auth::id()) {
            return true;
        } else {

            return false;
        }
    }
    public function likes()
    {
        return $this->belongsToMany(Like::class);
    }
    public function users_likes()
    {
        return $this->belongstoMany(User::class, Like::class, 'post_id', 'user_id');
    }
}

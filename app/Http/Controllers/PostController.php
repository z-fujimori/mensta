<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Post $post,User $user){
        return view('posts/index')->with(['users'=>$user->get(),'posts' => $post->get()]);
    }
    public function show(Post $post){
        return view('posts/show')->with(['post' => $post]);
    }
    public function create(Tag $tag){
        return view('posts/create');
    }
    public function store(Post $post,Request $request){
        $input = $request['post'];
        $id = Auth::id();
        $input['user_id'] = $id;
        $input['restaurant_id'] = 1;
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
}

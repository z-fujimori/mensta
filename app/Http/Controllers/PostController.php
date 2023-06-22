<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Cloudinary;

use GuzzleHttp\Client;


class PostController extends Controller
{
    public function index(Post $post,User $user){
        return view('posts/index')->with(['users'=>$user->get(),'posts' => $post->get()]);
    }
    public function map(Post $post,User $user){
        $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?key='.config('services.google.apikey').'&location=35.6987769,139.76471&radius=300&language=ja&keyword=公園OR広場OR駅';
        $method = "GET";
        //接続
        $client = new Client();
        $response = $client->request($method, $url);
        $posts = $response->getBody();
        $posts = json_decode($posts, true);
        dd($posts);
        
        
        return view('posts/map')->with(['users'=>$user->get(),'posts' => $post->get()]);
    }
    public function show(Post $post){
        return view('posts/show')->with(['post' => $post]);
    }
    public function create(Tag $tag){
        return view('posts/create');
    }
    public function store(Post $post,Request $request){
        $files = $request->file('image');
        $f = [];
        foreach($files as $file){
            $f[] = $file->getClientOriginalExtension();
        }
        dd($f);
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        dd($image_url);  //画像のURLを画面に表示
        
        $input = $request['post'];
        $id = Auth::id();
        $input['user_id'] = $id;
        $input['restaurant_id'] = 1;
        $post->fill($input)->save();
        
        return redirect('/posts/' . $post->id);
    }
}

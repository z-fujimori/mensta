<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Restaurant;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Cloudinary;

use GuzzleHttp\Client;


class PostController extends Controller
{
    public function index(Post $post){
        return view('posts/index')->with(['posts' => $post->getByat()]);
    }
    
    public function map(Post $post,User $user){
        $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?key='
        .config('services.google.apikey')
        .'&location=35.6987769,139.76471&radius=3000&language=ja&keyword=公園OR広場OR駅';
        $method = "GET";
        //接続
        $client = new Client();
        $response = $client->request($method, $url);
        $posts = $response->getBody();
        $posts = json_decode($posts, true);
        //dd($posts);
        
        return view('posts/map')->with(['users'=>$user->get(),'posts' => $post->getByat()]);
    }
    
    public function show(Post $post,Image $image){
        $img = $image->where('post_id', '=', $post->id)->get();
        return view('posts/show')->with(['post' => $post,'img' => $img]);
    }
    
    public function create(Tag $tag){
        return view('posts/create');
    }
    
    public function candidate(Request $request){
        $post = $request->post;
        $imgs = $request->file('image');
        //dd($request->file('image'));
        //dd($request->file($file->getRealPath());
        
        $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?key='
        .config('services.google.apikey')
        .'&location=35.690921,139.700258&radius=3000&language=ja&keyword='.$post['title'];
        $method = "GET";
        //接続
        $client = new Client();
        $response = $client->request($method, $url);
        $shops = $response->getBody();
        $shops = json_decode($shops, true);
        //dd($shops['results']);
        
        return view('posts/candidate_cre')->with(['shops'=>$shops['results'],'post'=>$post]);
    }
    
    public function store(Post $post,Request $request,Restaurant $restaurant){
        //dd($request);
        $input = $request->post;
        $id = Auth::id();
        $input['user_id'] = $id;
        $place = $request->shop_place;
        $place = explode(",",$place);
        $db_resta = Restaurant::where('api_id',$place[2])->get();
        /*if(empty($db_resta[0])){
            dd($db_resta,"空っぽ");
        }
        dd("データ在り");*/
        if(empty($db_resta[0])){
            $input_resta['api_id'] = $place[2]; //plaice_idをrestaテーブルに入れるための配列に入れる
            $input_resta['lat'] = $place[0]; //緯度
            $input_resta['lng'] = $place[1]; //経度
            $input_resta['name']= $place[3]; //飲食店名
            $restaurant->fill($input_resta)->save();
            $db_resta = Restaurant::where('api_id',$place[2])->get();
            //dd($db_resta[0]);
        }
        //$db_resta = $db_resta[0];
        //dd($db_resta,"notnull");
        $db_resta = $db_resta[0];
        $input['restaurant_id'] = $db_resta["id"];
        $post->fill($input)->save();
        //画像を複数読み取りたい
        $files = $request->file('image');
        if ($files!=null){
            $f = [];
            foreach($files as $file){
                $image = new Image;
                $f[] = $file;
                $image_url = Cloudinary::upload($file->getRealPath())->getSecurePath();
                $input_img['post_id'] = $post->id;
                $input_img['link'] = $image_url;
                $image->fill($input_img)->save();
            }
        }
        return redirect('/posts/' . $post->id);
    }
    
    
    public function resta(Request $request){
        $name = $request['post'];
        dd($name);
    }
}

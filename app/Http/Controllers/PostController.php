<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Restaurant;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\Post_tag;

use Illuminate\Support\Facades\Auth;
use Cloudinary;

use GuzzleHttp\Client;


class PostController extends Controller
{
    public function index(Post $post,Request $request,User $user){
        //$count = $post->withCount('likes')->get();
        $posts = $post->getByat();
        $keyword = $request->keyword;
        if(!empty($keyword)) {
            $posts = $post->where('title','LIKE',"%{$keyword}%")->orWhere('ramen_name','LIKE',"%{$keyword}%")->orWhere('text','LIKE',"%{$keyword}%")->withCount('likes')->get();
            $posts2 = Post::whereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'LIKE',"%{$keyword}%");
            })->withCount('likes')->get();
            $posts3 = Post::whereHas('tags', function ($query) use ($keyword) {
                $query->where('name', 'LIKE',"%{$keyword}%");
            })->withCount('likes')->get();
            $posts = $posts->merge($posts2);
            $posts = $posts->merge($posts3)->sortByDesc('updated_at');
            //dd($posts,$posts2);
        }
        
        return view('posts/index')->with(['posts' => $posts,'keyword'=>$keyword]);
    }
    
    public function map(Post $post,User $user,Restaurant $restaurant){
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
        
        return view('posts/map')->with(['restaurants'=>$restaurant->where('id','>=',2)->get(),'users'=>$user->get(),'posts' => $post->getByat()]);
    }
    
    public function show(Post $post,Image $image,Comment $comment){
        //dd($post->comment);
        $comment = $comment->getCom($post->id);
        $post = $post->getShow($post->id)[0];
        //dd($post);
        $img = $image->where('post_id', '=', $post->id)->get();
        return view('posts/show')->with(['post' => $post,'img' => $img,'comments'=>$comment]);
    }
    
    public function user(User $user,Post $post){
        $count = $user->getPost($user->id)[0];
        //dd($count);
        $posts = $post->getUser($user->id);
        return view('posts/user')->with(['posts' => $posts,'user'=>$count]);
    }
    
    public function create(Tag $tag,Restaurant $restaurant){
        return view('posts/create')->with(['tags'=>$tag->get()]);
    }
    
    public function candidate(Request $request,Tag $tag){
        $post = $request->post;
        $imgs = $request->file('image');
        //dd($request->file('image'));
        //dd($request->file($file->getRealPath());
        
        $client = new Client();
        $method = "GET";
        $station = "https://express.heartrails.com/api/json?method=getStations&name=$request->station";
        $response = $client->request($method,$station);
        $restaurants = json_decode($response->getBody(), true);
        //dd($restaurants["response"]["station"][0]);
        
        $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?key='
        .config('services.google.apikey')
        .'&location='.$restaurants["response"]["station"][0]["y"].",".$restaurants["response"]["station"][0]["x"].'&radius=3000&language=ja&keyword='.$post['title'];
        $method = "GET";
        //接続
        $client = new Client();
        $response = $client->request($method, $url);
        $shops = $response->getBody();
        $shops = json_decode($shops, true);
        //dd($shops['results']);
        
        return view('posts/candidate_cre')->with(['shops'=>$shops['results'],'post'=>$post,'tags'=>$tag->get()]);
    }
    
    public function cand(){
        return view('posts/cand_cre');
    }
    
    public function store(Post $post,Request $request,Restaurant $restaurant,Post_tag $post_tag){
        //$text = explode(("#"or"＃"),$request->post["text"]);
        $text = preg_split('/(#|＃|＃)/',$request->post["text"],PREG_SPLIT_NO_EMPTY|PREG_SPLIT_OFFSET_CAPTURE);
        $input = $request->post;
        $input["text"] = $text[0];
        $id = Auth::id();
        $input['user_id'] = $id;
        $place = $request->shop_place;
        $place = explode(",",$place);
        if($place[0]!=null){
            $db_resta = Restaurant::where('api_id',$place[2])->get();
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
        }
        //dd($input);
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
        //タグの処理
        foreach($text as $index => $tag_name){
            $tag = new Tag;
            if($index==0){
                continue;
            }
            $tag_name = str_replace(["\r\n", "\r", "\n"],"",$tag_name); //タグ内の改行を消す
            $hasTag = Tag::where('name',$tag_name)->get();
            if(empty($hasTag[0])){
                $input_tag['name'] = $tag_name;
                $tag->fill($input_tag)->save();
                $hasTag = Tag::where('name',$tag_name)->get();
            }
            $post->tags()->attach($hasTag[0]->id);
        }
        return redirect('/posts/' . $post->id);
    }
    
    public function comment(Request $request,Post $post,Comment $comment){
        $input['user_id'] = Auth::id();
        $input['post_id'] = $post->id;
        $input['text'] = $request->com;
        $comment->fill($input)->save();
        return redirect('/posts/'.$post->id);
    }
    
    public function like_product(Request $request){
        //dd($request);
        if ( $request->input('like_product') == 0) {
            //ステータスが0のときはデータベースに情報を保存
            Like::create([
                'post_id' => $request->input('post_id'),
                'user_id' => auth()->user()->id,
            ]);
            //ステータスが1のときはデータベースに情報を削除
        } elseif ( $request->input('like_product')  == 1 ) {
            Like::where('post_id', "=", $request->input('post_id'))
                ->where('user_id', "=", auth()->user()->id)
                ->delete();
        }
        return $request->input('like_product');
    }
    
    public function tag_page(Tag $tag){
        $posts = $tag->posts()->with('tags')->withCount('likes')->orderBy('updated_at', 'DESC')->get();
        return view('posts/tag')->with(['posts' => $posts,'tag'=>$tag]);
    }
    
    public function mypage(Post $post,User $user){
        $posts = $post->getUser(Auth::id());
        $user = $user->getPost(Auth::id())[0];
        return view('posts/mypage')->with(['posts'=>$posts,'user'=>$user]);
    }
    
    public function edit(Post $post, Request $request){
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(Request $request, Post $post){
        $input_post = $request->post;
        $post->fill($input_post)->save();
    
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post){
        dd('ok');
        $post->delete();
        return redirect('/');
    }
    
    public function test(){
        return view('posts/test');
    }
}

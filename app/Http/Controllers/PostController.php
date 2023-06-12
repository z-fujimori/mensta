<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    public function index(Tag $tag){
        return view('posts/index')->with(['tags' => $tag->get()]);;
    }
}

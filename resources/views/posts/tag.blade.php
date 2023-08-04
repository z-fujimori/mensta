<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>麺stagram</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"> <!--font awesome-->
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/create.css')  }}" >
        @vite(['resources/css/app.css', 'resources/js/app.js']) <!--jquery-->
    </head>
    <body background='{{asset('/img/men.webp')}}'>
        <header>
            <h1><a href='/'>麵stagram</a></h1>
        </header>
        
        <h2>{{$tag->name}}　のタグが付いている投稿</h2>
        {{--
        @if(Auth::id()==1)
            <form  method="POST" enctype="multipart/form-data">
                <input id="create_tag" name=tag placeholder="タグ作成"></input>
                <button type="button" onclick="multipleaction('/create_tag')" ></button>
            </form>
        @endif--}}
        
        <div class='posts'>
            @foreach ($posts as $post)
                <hr/>
                <div class='post'>
                    <a href="/posts/{{$post->id}}">
                        <h2 class="title text-xl">
                            {{ $post->title }}
                        </h2>
                    </a>
                    
                    <a href="/users/{{$post->user->id}}">
                        <p class='user'>
                            {{$post->user->name}}
                        </p>
                    </a>
                    
                    <h2 class='ramen_name'>
                        {{ $post->ramen_name }}
                    </h2>
                    
                    <div class='price'>
                        {{ $post->price }} 円
                    </div>
                    
                    <div class="content">
                        <h3 class="content__post">
                            {{ $post->text }}    
                        </h3>
                    </div>
                    <div class="img">
                        @foreach ($post->images as $image)
                            <img id="pre" src="{{ $image->link }}" class=pre>
                        @endforeach
                    </div>
                    
                    <div class=like>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        @auth
                            @if(!$post->isLikedBy(Auth::user()))
                                    <i id="like" class="far fa-heart" style="color: #ec7474;" post_id="{{ $post->id }}" like_product="0" user="1"></i>
                                    <h3 class="likeCount_{{$post->id}}">{{$post->likes_count}}</h3>
                            @else
                                    <i id="like" class="fas fa-heart" style="color: #ec7474;" post_id="{{ $post->id }}" like_product="1" user="1"></i>
                                    <h3 class="likeCount_{{$post->id}}">{{$post->likes_count}}</h3>
                            @endif
                        @endauth
                        @guest
                            <i class="fas fa-heart" style="color: #ec7474;" user="0"></i>
                            <h3 class="likeCount_{{$post->id}}">{{$post->likes_count}}</h3>
                        @endguest
                    </div>
                    
                </div>
            @endforeach
            
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
        <script type='module'>
            $(function(){
                $(".title").css("color","green")
            })
        </script>
        
        
        
        <script src="{{ asset('/js/like.js')  }}"></script>
    </body>
</html>
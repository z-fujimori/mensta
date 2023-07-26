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
        @vite(['resources/css/app.css', 'resources/js/app.js'])<!--jquery-->
    </head>
    <body>
        <header>
            <h1><a href='/'>麵stagram</a></h1>
        </header>
        
        <h2>マイページ</h2>
        
        <div class="user_profile">
            <i class="fa fa-user" aria-hidden="true"></i>
            <h2 class="user_name">{{$user->name}}</h2>
            <h2 class="post_count">投稿数：{{ $user->posts_count }}</h2>
        </div>
        
        
        <div class='posts'>
            @foreach ($posts as $post)
                <hr/>
                <div class='post'>
                    <a href="/posts/{{$post->id}}">
                        <h2 class="title text-xl">
                            {{ $post->title }}
                        </h2>
                    </a>
                    
                    <p class='user'>
                        {{$post->user->name}}
                    </p>
                    
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
                    
                    @foreach($post->tags as $tag)
                    <div class="tag">
                        <a href="/tags/{{$tag->id}}">{{ $tag->name }}</a>
                    </div>
                    @endforeach
                    
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
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">delete</button> 
                    </form>
                    
                </div>
            @endforeach
            
        </div>
        
        <script type='module'>
            $(function(){
                $(".title").css("color","green")
            })
        </script>
        
        <script>
            function deletePost(id) {
                'use strict'
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        
        <script src="{{ asset('/js/like.js')  }}"></script>
    </body>
</html>
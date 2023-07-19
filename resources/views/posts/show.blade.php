<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>麺stagram</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"> <!--font awesome-->
        @vite(['resources/css/app.css', 'resources/js/app.js']) <!--jquery-->
        
        <link rel="stylesheet" href="{{ asset('css/create.css')  }}" >
        
    </head>
    <body>
        <header>
            <h1><a href='/'>麵stagram</a></h1>
        </header>
        
        <h2 class="title">
            {{ $post->title }}
        </h2>
        
        
        @foreach($img as $image)
            <img id="pre" src="{{$image['link']}}" class=pre>
        @endforeach
        
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
        
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        
        
        <script src="{{ asset('/js/like.js')  }}"></script>
        
    </body>
</html>
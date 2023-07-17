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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <header>
            <h1><a herf='/'>麵stagram</a></h1>
        </header>
        
        <h3><a href='/posts/create'>create</a></h3>
        <h3><a href='/map'>map</a></h3>
        
        <div class='posts'>
            @foreach ($posts as $post)
                <hr/>
                <div class='post'>
                    <h2 class="title text-xl">
                        {{ $post->title }}
                    </h2>
                    
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
                    <div class="img">
                        @foreach ($post->images as $image)
                            <img id="pre" src="{{ $image->link }}" class=pre>
                        @endforeach
                    </div>
                    <a >map</a>
                    
                    <div class=like>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        @auth
                            @if(!$post->isLikedBy(Auth::user()))
                                    <i id="like" class="far fa-heart" style="color: #ec7474;" post_id="{{ $post->id }}" like_product="0"></i>
                            @else
                                    <i id="like" class="fas fa-heart" style="color: #ec7474;" post_id="{{ $post->id }}" like_product="1"></i>
                            @endif
                        @endauth
                        {{--
                        
                        @auth
                            <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
                            @if (!$post->isLikedBy(Auth::user()))
                                <span class="likes">
                                        <i class="fas fa-music like-toggle" data-review-id="{{ $post->id }}">aaaaa</i>
                                    <span class="like-counter">{{$item->likes_count}}</span>
                                </span><!-- /.likes -->
                            @else
                                <span class="likes">
                                        <i class="fas fa-music heart like-toggle liked" data-review-id="{{ $post->id }}">bbbb</i>
                                    <span class="like-counter">{{$item->likes_count}}</span>
                                </span><!-- /.likes -->
                            @endif
                        @endauth
                        @guest
                            <span class="likes">
                                    <i class="fas fa-music heart">cccc</i>
                                <span class="like-counter">{{$item->likes_count}}</span>
                            </span><!-- /.likes -->
                        @endguest
                        --}}
                    </div>
                    
                </div>
            @endforeach
            
        </div>
        
        <script type='module'>
            $(function(){
                $(".title").css("color","green")
            })
        </script>
        
        
        <script src="{{ asset('/js/like.js')  }}"></script>
    </body>
</html>
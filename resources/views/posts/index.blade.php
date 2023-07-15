<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>麺stagram</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
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
                    {{--
                    <div class=like>
                        @auth
                            @if (!$post->isLikedBy(Auth::user()))
                                <span class="likes">
                                    <i class="fas like-toggle" data-review-id="{{ $item->id }}"></i>
                                    <span class="like-counter">{{$item->likes_count}}</span>
                                </span><!-- /.likes -->
                            @else
                                <span class="likes">
                                    <i class="fas heart like-toggle liked" data-review-id="{{ $item->id }}"></i>
                                    <span class="like-counter">{{$item->likes_count}}</span>
                                </span><!-- /.likes -->
                            @endif
                        @endauth
                        @guest
                            <span class="likes">
                                <i class="fas heart"></i>
                                <span class="like-counter">{{$item->likes_count}}</span>
                            </span><!-- /.likes -->
                        @endguest
                    </div>
                    --}}
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
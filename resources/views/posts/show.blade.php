<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>麺stagram</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
         <script src="https://maps.google.com/maps/api/js?key={{config('services.google.apikey')}}&language=ja" async defer></script><!--map-->
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"> <!--font awesome-->
        @vite(['resources/css/app.css', 'resources/js/app.js']) <!--jquery-->
        
        <link rel="stylesheet" href="{{ asset('css/create.css')  }}" >
        <!--map-->
        <style>
        html { height: 70% }
        body { height: 90% }
        #map { height: 60%; width: 40%}
        </style>
        <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src="https://maps.${c}apis.com/maps/api/js?"+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
        key: "{{config('services.google.apikey')}}",
        // Add other bootstrap parameters as needed, using camel case.
        // Use the 'v' parameter to indicate the version to load (alpha, beta, weekly, etc.)
        });
        </script>
        
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
        
        @foreach($post->tags as $tag)
        <div class="tag">
            <a href="/tags/{{$tag->id}}">{{ $tag->name }}</a>
        </div>
        @endforeach
        
        
        <div id="map"></div>
        
            
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
        
        
        <div id="comment" class="comment">
            {{--
            @foreach($post->comment as $comme)--}}
            @foreach($comments as $comment)
                <h3>コメント：{{ $comment->text }}[{{$comment->user->name}} {{$comment->created_at}}]</h3>
            @endforeach
            @auth
            <div id="comment_btn" class="comment_btn">
                <i class="fa fa-comment" aria-hidden="true"></i>
                <h3>コメント</h3>
            </div>
            <form action='/posts/{{$post->id}}/comment'  method="POST" enctype="multipart/form-data">
                <div class="comment_input" id="comment_input">
                    @csrf
                </div>
                <button type="button" onclick="multipleaction('/posts/{{$post->id}}/comment')" ><i class="fa fa-comment" aria-hidden="true"></i></button>
            </form>
            @endauth
        </div>
        
        
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        
        <div class="edit"><a href="/posts/{{ $post->id }}/edit">edit</a></div>
        
        <script>
            console.log({{ $post->restaurant->lat }},{{ $post->restaurant->lng }});
            var MyLatLng = new google.maps.LatLng({{ $post->restaurant->lat }},{{ $post->restaurant->lng }});
            var Options = {
             zoom: 15,      //地図の縮尺値
             center: MyLatLng,    //地図の中心座標
             mapTypeId: 'roadmap'   //地図の種類
            };
            var map = new google.maps.Map(document.getElementById('map'), Options);
            let lat;
            let lng;
            let marker = [];
            lat = {{$post->restaurant->lat}};
            lng = {{$post->restaurant->lng}};
            marker = new google.maps.Marker({
                position : {lat:lat,lng:lng},
                map:map
            });
        </script>
        
        <script src="{{ asset('/js/like.js')  }}"></script>
        <script src="{{ asset('/js/comment.js')  }}"></script>
        
    </body>
</html>
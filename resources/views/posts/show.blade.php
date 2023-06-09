<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>麺stagram</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        
        <link rel="stylesheet" href="{{ asset('css/create.css')  }}" >
        
    </head>
    <body>
        <header>
            <h1><a herf='/'>麵stagram</a></h1>
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
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>
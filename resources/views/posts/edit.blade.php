<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>麺stagram</title>

        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        <script src="https://maps.googleapis.com/maps/api/place/textsearch/xml?key=YOUR_API_KEY&<parameters>&language=ja"></script>
        <script src="https://maps.googleapis.com/maps/api/place/detailes/xml?key=YOUR_API_KEY&<parameters>&language=ja"></script>
        
        <link rel="stylesheet" href="{{ asset('css/create.css')  }}" >
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1><a href='/'>麵stagram</a></h1>
        </header>
        
        <form action="/posts/{{ $post->id }}" method="POST">
            <div class='create'>
                @csrf
                @method('PUT')
                <div class="title">
                    <h3>タイトル</h3>
                    <input id="title" type="text" name="post[title]" placeholder="〇〇家" value="{{ $post->title }}"/>
                </div>
                <div class="ramen_name">
                    <h3>ラーメン</h3>
                    <input type="text" name="post[ramen_name]" placeholder="〇〇ラーメン" value="{{ $post->ramen_name }}"/>
                </div>
                <div class="price">
                    <h3>値段</h3>
                    <input type="text" name="post[price]" placeholder="850" value="{{ $post->price }}"/>円
                </div>
                <div class="text">
                    <h3>レビュー</h3>
                    <textarea name="post[text]" placeholder="すごくおいしかった。">{{ $post->text }}</textarea>
                </div>
                
                <div class="image">
                    @foreach($post->images as $image)
                        <img id="pre" src="{{$image['link']}}" class=pre>
                    @endforeach
                </div>
                
            </div>
        
            <input type="submit" value="編集"> 
        </form>
                
                

        </div>
        <script src="{{ asset('/js/create.js')  }}"></script>
    </body>
</html>
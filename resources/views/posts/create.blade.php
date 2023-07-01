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
            <h1><a herf='/'>麵stagram</a></h1>
        </header>
        
        <form method="POST" enctype="multipart/form-data">
            <div class='create'>
                @csrf
                <div class="title">
                    <h3>タイトル</h3>
                    <input id="title" type="text" name="post[title]" placeholder="〇〇家" value="{{ old('post.title') }}"/>
                </div>
                <div class="ramen_name">
                    <h3>ラーメン</h3>
                    <input type="text" name="post[ramen_name]" placeholder="〇〇ラーメン" value="{{ old('post.ramen_name') }}"/>
                </div>
                <div class="price">
                    <h3>値段</h3>
                    <input type="text" name="post[price]" placeholder="850" value="{{ old('post.price') }}"/>円
                </div>
                <div class="text">
                    <h3>レビュー</h3>
                    <textarea name="post[text]" placeholder="すごくおいしかった。">{{ old('post.text') }}</textarea>
                </div>
                 <div class="image">
                    <input id="image" type="file" multiple="multiple" name="image[]" accept="image/*">
                </div>
                <div id="preview" style="display:none"></div>
            </div>
            
            
            <button type="button" onclick="multipleaction('/candidate')">ページAに送信</button>
            <button type="button" onclick="multipleaction('/posts')" >投稿</button>
        </form>
        
        
            <button type="button" id="btn"> 候補表示 </button>
                
                

        </div>
        <script src="{{ asset('/js/create.js')  }}"></script>
    </body>
</html>
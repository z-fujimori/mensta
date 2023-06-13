<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>麺stagram</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1><a herf='/'>麵stagram</a></h1>
        </header>
        
        <form action="/posts" method="POST">
            <div class='create'>
                @csrf
                <div class="title">
                    <h3>タイトル</h3>
                    <input type="text" name="post[title]" placeholder="〇〇家" value="{{ old('post.title') }}"/>
                </div>
                <div class="ramen_name">
                    <h3>ラーメン</h3>
                    <input type="text" name="post[ramen_name]" placeholder="〇〇ラーメン" value="{{ old('post.ramen_name') }}"/>
                </div>
                <div class="price">
                    <h3>値段</h3>
                    <input type="text" name="post[price]" placeholder="〇〇ラーメン" value="{{ old('post.price') }}"/>円
                </div>
                <div class="text">
                    <h3>レビュー</h3>
                    <textarea name="post[text]" placeholder="すごくおいしかった。">{{ old('post.text') }}</textarea>
                </div>
            </div>
            
            <input type="submit" value="投稿"/>
        </form>
                
                
                

        </div>
    </body>
</html>
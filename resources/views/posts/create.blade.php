<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>麺stagram</title>

        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        <script src="https://maps.googleapis.com/maps/api/place/textsearch/xml?key=YOUR_API_KEY&<parameters>&language=ja"></script>
        <script src="https://maps.googleapis.com/maps/api/place/detailes/xml?key=YOUR_API_KEY&<parameters>&language=ja"></script>
        
        <script type="text/javascript" src="https://express.heartrails.com/api/express.js"></script>
        
        <link rel="stylesheet" href="{{ asset('css/create.css')  }}" >
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body background='{{asset('/img/men.webp')}}'>
            
            <header>
                <h1><a href='/'>麵stagram</a></h1>
            </header>
        
            <h3>店名検索</h3>
            <h4>最寄り駅名から店舗の位置情報を追加！</h4>
        
            <form method="POST" enctype="multipart/form-data">
                <div class='create'>
                    @csrf
                    
                    <div class='station'>
                        <body onload="HRELoadArea('area', 'line', 'station');">
                        駅名　　<input id="station" name="station"></input>駅
                    </div>
                    <div class="title">
                        店名　　　<input id="title" type="text" name="post[title]" placeholder="〇〇家" value="{{ old('post.title') }}"/>
                        <!--候補を表示-->
                    </div>
                    
                    
                    
                    <button type="button" onclick="multipleaction('/candidate')">店名検索</button>
                    
                    <br>
                    
                    <div>
                        <p>
                            店舗の位置情報を入力せずに投稿を作成するには<a href='/cand'>こちら</a>
                        </p>
                    </div>
                    {{--
                    <div class="title">
                        <h3>店名検索</h3>
                        <input id="title" type="text" name="post[title]" placeholder="〇〇家" value="{{ old('post.title') }}"/>
                        <!--候補を表示-->
                        <button type="button" onclick="multipleaction('/candidate')">店名検索</button>
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
                <button type="button" onclick="multipleaction('/posts')" >投稿</button>
                --}}
            </form>
                    
                    
    
            </div>
            <script src="{{ asset('/js/create.js')  }}"></script>
        
    
    </body>
</html>
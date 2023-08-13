<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>麺stagram</title>

        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        <script src="https://maps.googleapis.com/maps/api/place/textsearch/xml?key=YOUR_API_KEY&<parameters>&language=ja"></script>
        <script src="https://maps.googleapis.com/maps/api/place/detailes/xml?key=YOUR_API_KEY&<parameters>&language=ja"></script>
        
        <link rel="stylesheet" href="{{ asset('css/create.css')  }}" >
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body background='{{asset('/img/men.webp')}}'>
            
            <header>
                <h1><a href='/'>麵stagram</a></h1>
            </header>
        
        
        
            <form method="POST" enctype="multipart/form-data">
                <div class='create'>
                    @csrf
                    <div class="title">
                        <h3>タイトル</h3>
                        <input id="title" type="text" name="post[title]" placeholder="〇〇家" value="{{ $post['title'] }}"/>
                    </div>
                    
                    
                    <div class="shop">
                        <h3>お店</h3>
                        <select name="shop_place">
                            @foreach ($shops as $index => $shop)
                                <option value="{{$shop["geometry"]["location"]["lat"]}},{{$shop["geometry"]["location"]["lng"]}},{{$shop["place_id"]}},{{$shop["name"]}}">{{ $shop["name"] }}</option>
                            @endforeach
                            <option value="0,0,0,none">お店の位置情報をつけない</option>
                        </select>
                        <div class="serc-again-box">
                            <a href='/posts/create' class="serch again">お店を検索しなおす</a>
                        </div>
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
                    
                    
                    
                    <input type="hidden" id="ido">
                    <input type="hidden" id="keido">
                
                </div>
                
                
                
                <button type="button" onclick="multipleaction('/posts')" >投稿</button>
            </form>
            
            
                    
                    
    
            </div>
            <script src="{{ asset('/js/create.js')  }}"></script>
               
    </body>
</html>
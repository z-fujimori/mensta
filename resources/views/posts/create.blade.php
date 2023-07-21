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
        
        <form method="POST" enctype="multipart/form-data">
            <div class='create'>
                @csrf
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
                <div class="tag">
                    @foreach ($tags as $tag)
                        <label><input type="checkbox" name="tag[]" value={{$tag->id}}>{{$tag->name}}</label>
                    @endforeach
                    {{--
                    <select id="tag_check" name="tag" multiple>
                        <option value="">タグを選択</option>
                        @foreach ($tags as $tag)
                            <option  value="{{ $tag->id }}">
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>--}}
                </div>
                 <div class="image">
                    <input id="image" type="file" multiple="multiple" name="image[]" accept="image/*">
                </div>
                <div id="preview" style="display:none"></div>
            </div>
            
            
            
            <button type="button" onclick="multipleaction('/posts')" >投稿</button>
        </form>
                
                

        </div>
        <script src="{{ asset('/js/create.js')  }}"></script>
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>麺stagram</title>
        
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        
        <script src="https://maps.google.com/maps/api/js?key={{config('services.google.apikey')}}&language=ja" async defer></script>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/create.css')  }}" >
        <style>
        html { height: 90% }
        body { height: 80% }
        #map { height: 80%; width: 80%}
        </style>
        <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src="https://maps.${c}apis.com/maps/api/js?"+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
        key: "{{config('services.google.apikey')}}",
        // Add other bootstrap parameters as needed, using camel case.
        // Use the 'v' parameter to indicate the version to load (alpha, beta, weekly, etc.)
        });
        </script>
        
    </head>
    <body background='{{asset('/img/men.webp')}}'>   
        
            <header>
                <h1><a href='/'>麵stagram</a></h1>
            </header>
            
        
            <div id="map">地図が出ない場合は再読み込みをして下さい。</div>
            
            <div id="posts_map">
            </div>
            
            
            
            <script>
                var MyLatLng = new google.maps.LatLng(35.6987769,139.76471);
                //const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
                var Options = {
                 zoom: 12,      //地図の縮尺値
                 center: MyLatLng,    //地図の中心座標
                 mapTypeId: 'roadmap'   //地図の種類
                };
                var map = new google.maps.Map(document.getElementById('map'), Options);
                let lat;
                let lng;
                let marker = [];
                @foreach($restaurants as $restaurant)
                    lat = {{$restaurant->lat}};
                    lng = {{$restaurant->lng}};
                    var i = {{$restaurant->id}};
                    marker[i] = new google.maps.Marker({
                        position : {lat:lat,lng:lng},
                        map:map
                    });
                    markerEvent(i);
                @endforeach
                
                const posts = @json($posts);
                
                function markerEvent(i) {
                    marker[i].addListener('click', function() { // マーカーをクリックしたとき
                        //書いてある投稿を消す
                        const parent = document.getElementById('posts_map');
                        while(parent.firstChild){
                            parent.removeChild(parent.firstChild);
                        }
                        //選んだマーカー（お店）の投稿を選ぶ
                        var filterdPosts = posts.filter((post)=>{
                            console.log(post.restaurant_id ,i);
                            return post.restaurant_id == i;
                        })
                        var postslen = filterdPosts.length;
                        for(var l=0;l<postslen;l++){
                            let posts = document.getElementById('posts_map');
                            //改行
                            let tag = document.createElement('br');
                            posts.appendChild(tag);
                            //投稿
                            let post = document.createElement('div');
                            post.id = "post";
                            post.className = "post";
                            posts.appendChild(post);
                            //タイトル
                            let title = document.createElement('h2');
                            title.id = "title";
                            title.className = "title";
                            title.textContent = filterdPosts[l].title;
                            post.appendChild(title);
                            //書いた人
                            let user = document.createElement('p');
                            user.id = "user";
                            user.className = "user";
                            user.textContent = filterdPosts[l].user.name;
                            post.appendChild(user);
                            //ラーメン
                            let ramen_name = document.createElement('h3');
                            ramen_name.className = "ramen_name";
                            ramen_name.textContent = filterdPosts[l].ramen_name;
                            post.appendChild(ramen_name);
                            //値段
                            let price = document.createElement('h3');
                            price.className = "ramen_name";
                            price.textContent = filterdPosts[l].price;
                            post.appendChild(price);
                            //本文
                            let text = document.createElement('h3');
                            text.className = "ramen_name";
                            text.textContent = filterdPosts[l].text;
                            post.appendChild(price);
                            //たぐ
                            {{--let tag_list = @json($);--}}
                            {{--//let tag = document.createElement('h3');--}}
                            {{--//text.className = "tag";--}}
                            
                            //画像
                            if(filterdPosts[l].images){
                                let imglen = filterdPosts[l].images.length;
                                console.log(imglen);
                                for (let j=0;j<imglen;j++){
                                    console.log("aaa");
                                    var img = document.createElement('img');
                                    img.id = "pre";
                                    img.className = "pre";
                                    img.setAttribute("src", filterdPosts[l].images[j].link)
                                    post.appendChild(img);
                                }
                            }
                        }
                    });
                }
                
            </script>

    
    </body>
</html>
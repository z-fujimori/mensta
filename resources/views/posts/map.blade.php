<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>麺stagram</title>
        
        <script src="https://maps.google.com/maps/api/js?key={{config('services.google.api_key')}}&language=ja"></script>
        
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <style>
        html { height: 90% }
        body { height: 80% }
        #map { height: 80%; width: 80%}
        </style>
    </head>
    <body>
        <header>
            <h1><a herf='/'>麵stagram</a></h1>
        </header>
        
        <div id="map"></div>
        
        
        <script>
            var MyLatLng = new google.maps.LatLng(35.6811673, 139.7670516);
            var Options = {
             zoom: 15,      //地図の縮尺値
             center: MyLatLng,    //地図の中心座標
             mapTypeId: 'roadmap'   //地図の種類
            };
            var map = new google.maps.Map(document.getElementById('map'), Options);
            console.log("aaaa")
        </script>
        
        <script src="https://maps.google.com/maps/api/js?key={{config('services.google.api_key')}}&language=ja"></script>

        <!--<iframe id='map' src='https://www.google.com/maps/embed/v1/place?key={{config('services.google.apikey')}}&q=%E6%96%B0%E5%AE%BF' width='50%' height='300' frameborder='0'></iframe>
        -->
        
        <script>
        /*var MyLatLng = new google.maps.LatLng(35.690921,139.700258);
        var center = {
            lat: 34.7019399, // 緯度
            lng: 135.51002519999997 // 経度
        };
        var Options = {
         zoom: 15,      //地図の縮尺値
         center: MyLatLng,    //地図の中心座標
         mapTypeId: 'roadmap'   //地図の種類
        };
        var map1 = new google.maps.Map(document.getElementById('map'), Options);
        //var marker_Option = {
            //position: center // マーカーを立てる位置を指定
            //map: map1 // マーカーを立てる地図を指定
        //};
        //var marker = new google.maps.Marker({marker_Option}); // マーカーの追加
        */
        
        </script>
        
    </body>
</html>
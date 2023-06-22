<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>麺stagram</title>
        
        <script src="http://maps.google.com/maps/api/js?key={{config('services.google.api_key')}}&language=ja"></script>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
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
        </script>
        

        <iframe id='map' src='https://www.google.com/maps/embed/v1/place?key={{config('services.google.apikey')}}&q=%E6%96%B0%E5%AE%BF' width='50%' height='300' frameborder='0'></iframe>
        https://maps.googleapis.com/maps/api/place/details/json?place_id=ChIJrTLr-GyuEmsRBfy61i59si0&fields=address_components&key={{config('services.google.apikey')}}
        
    </body>
</html>
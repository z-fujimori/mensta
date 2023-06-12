<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>麺stagram</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Blog Name</h1>
        <div class='posts'>
            <div class='post'>
                <h2 class='title'>Title</h2>
                <p class='body'>This is a sample body.</p>
                @foreach ($tags as $tag)
                    <div class='post'>
                        <h2 class='title'>{{ $tag->name }}</h2>
                    </div>
                @endforeach
                <a href='/posts/create'>create</a>
            </div>
        </div>
    </body>
</html>
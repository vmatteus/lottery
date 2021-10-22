<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Game Result</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            
        </style>

    </head>
    <body >
    @foreach ($games as $key1 => $game)
        Game {{$key1}} - 
        @foreach ($game as $key2 => $numbers)
            {{ $numbers }} 
        @endforeach

        Número de acertos: {{ count($results[$key1]) }}

        <br />
    @endforeach

    <br />
    Resultado: 
    @foreach ($result as $key => $numbers)
        {{ $numbers }} 
    @endforeach


    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Resultados de la Búsqueda</title>

    <!-- Vincula el archivo CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>

    <div class="search-form">
        <form action="{{ url('/search') }}" method="GET">
            <input type="text" name="search" placeholder="Buscar anime..." required>
            <button type="submit">Buscar</button>
        </form>
    </div>

    <h1>Resultados de la Búsqueda de Anime</h1>

    @if(isset($animeList) && count($animeList) > 0)
        @foreach($animeList as $anime)
            <div>
                <h2>{{ $anime['title']['romaji'] }} ({{ $anime['title']['english'] }})</h2>
                <img src="{{ $anime['coverImage']['large'] }}" alt="{{ $anime['title']['romaji'] }}">
                <p>{!! $anime['description'] !!}</p>
            </div>
        @endforeach
    @elseif(isset($error))
        <p>{{ $error }}</p>
    @else
        <p>No se encontraron resultados.</p>
    @endif

</body>

</html>

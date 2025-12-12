<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Pokémon</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .pokemon-card {
            width: 30%;
            display: inline-block;
            text-align: center;
            margin: 10px;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 8px;
        }
        img {
            width: 120px;
            height: 120px;
        }
        .container {
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>

    @if(isset($pokemon))
        <h1>Reporte Individual</h1>

        <div class="container">
            <div class="pokemon-card">
                <h2>{{ ucfirst($pokemon['name']) }}</h2>
                <img src="{{ $pokemon['sprites']['front_default'] }}" alt="image">
            </div>
        </div>

    @else
        <h1>Lista de Pokémon</h1>

        <div class="container">
            @foreach($pokemons as $p)
                <div class="pokemon-card">
                    <h2>{{ ucfirst($p['name']) }}</h2>
                    <img src="{{ $p['image'] }}" alt="image">
                </div>
            @endforeach
        </div>
    @endif

</body>
</html>

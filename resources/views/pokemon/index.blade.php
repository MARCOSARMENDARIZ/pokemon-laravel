@extends('layouts.app')

@section('title', 'Proyecto Final')

@section('content')
<div class="container">

    <h1 class="text-center mb-4">Proyecto Final – Pokémon</h1>

    <!-- 🔍 BUSCADOR -->
    <form action="/" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Buscar Pokémon por nombre...">

            <button type="submit" class="btn btn-primary">
                Buscar
            </button>
        </div>
    </form>

    <!-- 📄 PDF LISTA COMPLETA -->
    <div class="text-center mb-4">
        <a href="{{ route('pokemon.pdf') }}" class="btn btn-success btn-lg">
            Imprimir lista completa 📄
        </a>
    </div>

    <div class="row">
        @foreach($pokemons as $pokemon)
        <div class="col-sm-4 mb-4">

            <div class="card text-center" style="width: 18rem; margin-top: 70px;">

                <img class="card-img-top mx-auto d-block"
                     style="height: 120px; width: 120px; margin-top: 20px;"
                     src="{{ $pokemon['image'] }}"
                     alt="{{ $pokemon['name'] }}">

                <div class="card-body">
                    <h5 class="card-title text-capitalize">
                        {{ $pokemon['name'] }}
                    </h5>

                    <p class="card-text">
                        Pokémon obtenido desde la PokeAPI.
                    </p>

                    <!-- 🔥 AQUI SOLO AGREGO EL BOTÓN PDF -->
                    <div class="btn-group" role="group">
                        <a href="/pokemon/{{ $pokemon['name'] }}" class="btn btn-primary">
                            Ver más
                        </a>

                        <a href="/pokemon/{{ $pokemon['name'] }}/pdf" class="btn btn-danger">
                            PDF
                        </a>
                    </div>
                    <!-- 🔥 NADA MÁS -->

                </div>
            </div>

        </div>
        @endforeach
    </div>

</div>
@endsection

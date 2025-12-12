@extends('layouts.app')

@section('title', isset($pokemon) ? ucfirst($pokemon['name']) : 'Pokémon no encontrado')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            @if(isset($pokemon))
                <div class="card text-center">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">Detalles del Pokémon</h4>
                    </div>

                    <div class="card-body">

                        <img style="height: 150px; width: 150px; background-color: #EFEFEF; margin: 20px;"
                             class="img-fluid"
                             src="{{ $pokemon['sprites']['front_default'] }}"
                             alt="{{ $pokemon['name'] }}">

                        <h5 class="card-title text-capitalize">
                            {{ $pokemon['name'] }}
                        </h5>

                        <p><strong>ID:</strong> {{ $pokemon['id'] }}</p>
                        <p><strong>Altura:</strong> {{ $pokemon['height'] }}</p>
                        <p><strong>Peso:</strong> {{ $pokemon['weight'] }}</p>

                        <p><strong>Tipos:</strong>
                            @foreach($pokemon['types'] as $type)
                                <span class="badge bg-primary">
                                    {{ $type['type']['name'] }}
                                </span>
                            @endforeach
                        </p>

                        <div class="mt-3">
                            <a href="{{ route('pokemon.index') }}" class="btn btn-primary">
                                ← Volver a la lista
                            </a>

                            <!-- 🖨️ BOTÓN PARA IMPRIMIR PDF -->
                            <a href="{{ url('/pokemon/' . $pokemon['name'] . '/pdf') }}"
                               class="btn btn-danger"
                               target="_blank">
                                🖨️ Imprimir PDF
                            </a>
                        </div>

                    </div>
                </div>
            @else
                <div class="alert alert-danger text-center">
                    <h4> Pokémon no encontrado</h4>
                    <p>No existe información para este Pokémon.</p>
                    <a href="{{ route('pokemon.index') }}" class="btn btn-primary">
                        Volver
                    </a>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection

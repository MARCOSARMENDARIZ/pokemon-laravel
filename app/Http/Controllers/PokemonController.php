<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;

class PokemonController extends Controller
{
    public function index(Request $request)
    {
        $search = strtolower($request->get('search'));

        if ($search) {
            $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$search}");

            if (!$response->successful()) {
                return view('pokemon.index', ['pokemons' => []]);
            }

            $pokemon = $response->json();

            $pokemons = [[
                'name'  => $pokemon['name'],
                'image' => $pokemon['sprites']['front_default']
            ]];
        } else {
            $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=30');
            $data = $response->json();

            $pokemons = [];

            foreach ($data['results'] as $item) {
                $detail = Http::get($item['url'])->json();

                $pokemons[] = [
                    'name'  => $detail['name'],
                    'image' => $detail['sprites']['front_default']
                ];
            }
        }

        return view('pokemon.index', compact('pokemons'));
    }

    public function show($name)
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$name}");

        if (!$response->successful()) {
            return view('pokemon.show', ['pokemon' => null]);
        }

        $pokemon = $response->json();

        return view('pokemon.show', compact('pokemon'));
    }


    // ==================================================
    // 🖨 PDF — LISTA COMPLETA (usa pdf.blade.php)
    // ==================================================
    public function pdfList()
    {
        $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=30');
        $data = $response->json();

        $pokemons = [];

        foreach ($data['results'] as $item) {
            $detail = Http::get($item['url'])->json();

            $pokemons[] = [
                'name'  => $detail['name'],
                'image' => $detail['sprites']['front_default']
            ];
        }

        // Usa el MISMO archivo pdf.blade.php
        $pdf = Pdf::loadView('pokemon.pdf', [
            'pokemons' => $pokemons,
            'pokemon' => null
        ]);

        return $pdf->stream('lista-pokemon.pdf');
    }

    // ==================================================
    // 🖨 PDF — POKÉMON INDIVIDUAL (usa pdf.blade.php)
    // ==================================================
    public function pdfSingle($name)
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$name}");

        if (!$response->successful()) {
            abort(404);
        }

        $pokemon = $response->json();

        $pdf = Pdf::loadView('pokemon.pdf', [
            'pokemon' => $pokemon,
            'pokemons' => null
        ]);

        return $pdf->stream('pokemon-' . $pokemon['name'] . '.pdf');
    }
}

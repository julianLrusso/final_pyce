<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Retorna la vista del listado de juegos
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $games = Game::with('genre')->get();
        return view('games.index', ['games' => $games]);
    }

    /**
     * Retorna la vista del detalle del juego
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        $game = Game::with('genre')->findOrFail($id);

        return view('games.show', ['game' => $game]);
    }
}

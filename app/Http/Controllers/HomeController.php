<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Purchase;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function adminIndex()
    {
        $totalPurchases = Purchase::count();
        $abandonedPurchases = Purchase::where('status', 0)->count();
        $abandonedPercentage = 0;
        if ($totalPurchases > 0) {
            $abandonedPercentage = round(($abandonedPurchases / $totalPurchases) * 100, 2);
        }

        $mostSoldGame = Game::withCount('purchases')
            ->orderByDesc('purchases_count')
            ->first();
        $mostSoldGameName = $mostSoldGame ? $mostSoldGame->title : 'Ninguno';

        return view('admin.dashboard',
            [
                'abandonedPercentage' => $abandonedPercentage,
                'mostSoldGameName' => $mostSoldGameName
            ]);
    }
}

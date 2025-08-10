<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Series;

class HomeController extends Controller
{
    public function index()
    {
        $latestEpisodes = Episode::with('series')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $randomSeries = Series::inRandomOrder()->take(5)->get();

        return view('home', compact('latestEpisodes', 'randomSeries'));
    }
}

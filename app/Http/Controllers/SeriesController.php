<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;
use App\Models\Episode;

class SeriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $series = Series::with('episodes')->paginate(12);
        return view('series.index', compact('series'));
    }

    public function show(Series $series)
    {
        $series->load('episodes');
        $isFollowing = auth()->user()->followedSeries()->where('series_id', $series->id)->exists();
        
        return view('series.show', compact('series', 'isFollowing'));
    }

    public function follow(Series $series)
    {
        $user = auth()->user();
        
        if (!$user->followedSeries()->where('series_id', $series->id)->exists()) {
            $user->followedSeries()->attach($series->id);
        }

        return back()->with('success', 'Following ' . $series->title);
    }

    public function unfollow(Series $series)
    {
        $user = auth()->user();
        $user->followedSeries()->detach($series->id);

        return back()->with('success', 'Unfollowed ' . $series->title);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $series = Series::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(12);

        $episodes = Episode::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with('series')
            ->paginate(12);

        return view('search', compact('series', 'episodes', 'query'));
    }
}

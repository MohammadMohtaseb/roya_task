<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\EpisodeLike;

class EpisodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Episode $episode)
    {
        $episode->load('series');
        $userLike = $episode->userLike(auth()->id());
        
        return view('episodes.show', compact('episode', 'userLike'));
    }

    public function like(Episode $episode)
    {
        $user = auth()->user();
        
        $existingLike = EpisodeLike::where('user_id', $user->id)
            ->where('episode_id', $episode->id)
            ->first();

        if ($existingLike) {
            $existingLike->update(['is_like' => true]);
        } else {
            EpisodeLike::create([
                'user_id' => $user->id,
                'episode_id' => $episode->id,
                'is_like' => true,
            ]);
        }

        return back()->with('success', 'Liked episode');
    }

    public function dislike(Episode $episode)
    {
        $user = auth()->user();
        
        $existingLike = EpisodeLike::where('user_id', $user->id)
            ->where('episode_id', $episode->id)
            ->first();

        if ($existingLike) {
            $existingLike->update(['is_like' => false]);
        } else {
            EpisodeLike::create([
                'user_id' => $user->id,
                'episode_id' => $episode->id,
                'is_like' => false,
            ]);
        }

        return back()->with('success', 'Disliked episode');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Series;

class AdminEpisodeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $episodes = Episode::with('series')->paginate(20);
        return view('admin.episodes.index', compact('episodes'));
    }

    public function create()
    {
        $series = Series::all();
        return view('admin.episodes.create', compact('series'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'series_id' => 'required|exists:series,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'airing_time' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_asset' => 'nullable|mimes:mp4,avi,mov,wmv|max:102400',
        ]);

        $data = $request->only(['series_id', 'title', 'description', 'duration', 'airing_time']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->hasFile('video_asset')) {
            $data['video_asset'] = $request->file('video_asset')->store('videos', 'public');
        }

        Episode::create($data);

        return redirect()->route('admin.episodes.index')->with('success', 'Episode created successfully');
    }

    public function show(Episode $episode)
    {
        $episode->load('series');
        return view('admin.episodes.show', compact('episode'));
    }

    public function edit(Episode $episode)
    {
        $series = Series::all();
        return view('admin.episodes.edit', compact('episode', 'series'));
    }

    public function update(Request $request, Episode $episode)
    {
        $request->validate([
            'series_id' => 'required|exists:series,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'airing_time' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_asset' => 'nullable|mimes:mp4,avi,mov,wmv|max:102400',
        ]);

        $data = $request->only(['series_id', 'title', 'description', 'duration', 'airing_time']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->hasFile('video_asset')) {
            $data['video_asset'] = $request->file('video_asset')->store('videos', 'public');
        }

        $episode->update($data);

        return redirect()->route('admin.episodes.index')->with('success', 'Episode updated successfully');
    }

    public function destroy(Episode $episode)
    {
        $episode->delete();
        return redirect()->route('admin.episodes.index')->with('success', 'Episode deleted successfully');
    }
}

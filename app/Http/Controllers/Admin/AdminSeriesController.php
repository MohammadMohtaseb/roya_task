<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Series;

class AdminSeriesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $series = Series::paginate(20);
        return view('admin.series.index', compact('series'));
    }

    public function create()
    {
        return view('admin.series.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'show_time' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'show_time']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Series::create($data);

        return redirect()->route('admin.series.index')->with('success', 'Series created successfully');
    }

    public function show(Series $series)
    {
        return view('admin.series.show', compact('series'));
    }

    public function edit(Series $series)
    {
        return view('admin.series.edit', compact('series'));
    }

    public function update(Request $request, Series $series)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'show_time' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'show_time']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $series->update($data);

        return redirect()->route('admin.series.index')->with('success', 'Series updated successfully');
    }

    public function destroy(Series $series)
    {
        $series->delete();
        return redirect()->route('admin.series.index')->with('success', 'Series deleted successfully');
    }
}

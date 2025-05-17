<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        return view('levels.index');
    }

    public function create()
    {
        return view('levels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:levels,name',
        ]);

        $validated['name'] = str_replace(' ', '_', strtolower($validated['name']));

        Level::create($validated);

        return back()->with(['status' => true, 'message' => 'Level created successfully']);
    }


    public function show(Level $level)
    {
        return view('levels.show', compact('level'));
    }

    public function destroy(Level $level)
    {
        $level->delete();

        return back()->with(['status' => true, 'message' => 'Level deleted successfully']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        return Announcement::with('parish')->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parish_id' => 'nullable|exists:parishes,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'is_global' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $announcement = Announcement::create($validated);

        return response()->json($announcement, 201);
    }

    public function show(Announcement $announcement)
    {
        return $announcement->load('parish');
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'parish_id' => 'sometimes|exists:parishes,id',
            'title' => 'sometimes|string|max:255',
            'message' => 'sometimes|string',
            'is_global' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $announcement->update($validated);

        return response()->json($announcement);
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return response()->json(['message' => 'Deleted']);
    }
}

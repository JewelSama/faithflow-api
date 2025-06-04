<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Event::with('parish')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'parish_id' => 'required|exists:parishes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'time' => 'nullable|string|max:50',
            'venue' => 'nullable|string|max:255',
        ]);

        try {
            $event = Event::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Event created successfully',
                'data' => $event,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create event',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $event = Event::with('parish')->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $event,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found',
            ], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();

            return response()->json([
                'success' => true,
                'message' => 'Event deleted successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete event',
            ], 404);
        }
    }
}

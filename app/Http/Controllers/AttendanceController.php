<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('parish')->latest()->get();
        return response()->json($attendances);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parish_id' => 'required|exists:parishes,id',
            'service_type' => 'required|string',
            'date' => 'required|date',
            'adults' => 'nullable|integer',
            'children' => 'nullable|integer',
            'men' => 'nullable|integer',
            'women' => 'nullable|integer',
        ]);

        $validated['adults'] = $validated['adults'] ?? 0;
        $validated['children'] = $validated['children'] ?? 0;
        $validated['men'] = $validated['men'] ?? 0;
        $validated['women'] = $validated['women'] ?? 0;
        $validated['total'] = $validated['adults'] + $validated['children'] + $validated['men'] + $validated['women'];

        $attendance = Attendance::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Attendance recorded successfully',
        ], 201);
    }

    public function show($id)
    {
        $attendance = Attendance::with('parish')->findOrFail($id);
        return response()->json($attendance);
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        $validated = $request->validate([
            'parish_id' => 'sometimes|exists:parishes,id',
            'service_type' => 'sometimes|string',
            'date' => 'sometimes|date',
            'adults' => 'nullable|integer',
            'children' => 'nullable|integer',
            'men' => 'nullable|integer',
            'women' => 'nullable|integer',
        ]);

        $attendance->fill($validated);

        $attendance->total = 
            ($validated['adults'] ?? $attendance->adults) +
            ($validated['children'] ?? $attendance->children) +
            ($validated['men'] ?? $attendance->men) +
            ($validated['women'] ?? $attendance->women);

        $attendance->save();

        return response()->json($attendance);
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return response()->json(['message' => 'Attendance deleted']);
    }
}

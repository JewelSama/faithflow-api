<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parish;

class ParishController extends Controller
{
    public function index()
    {
        $parishes = Parish::all();
        return response()->json($parishes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $parish = Parish::create($request->only([
            'name', 'location', 'city', 'country'
        ]));

        return response()->json([
            'message' => 'Parish created successfully',
            'data' => $parish,
        ], 201);
    }

    public function show($id)
    {
        $parish = Parish::findOrFail($id);
        return response()->json($parish);
    }

    public function update(Request $request, $id)
    {
        $parish = Parish::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'location' => 'nullable|string|max:255',
            'city' => 'sometimes|string|max:255',
            'country' => 'sometimes|string|max:255',
        ]);

        $parish->update($request->only([
            'name', 'location', 'city', 'country'
        ]));

        return response()->json([
            'message' => 'Parish updated successfully',
            'data' => $parish,
        ]);
    }

    public function destroy($id)
    {
        $parish = Parish::findOrFail($id);
        $parish->delete();

        return response()->json(['message' => 'Parish deleted successfully']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Testimony;
use Illuminate\Support\Facades\Log;

class TestimonyController extends Controller
{
    public function index()
    {
        try {
            $testimonies = Testimony::with(['member', 'parish'])->latest()->get();
            return response()->json(['success' => true, 'data' => $testimonies]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Failed to fetch testimonies'], 500);
        }
    }
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'member_id' => 'required|exists:members,id',
                'parish_id' => 'required|exists:parishes,id',
                'content' => 'required|string',
                'date' => 'nullable|date',
            ]);

            $testimony = Testimony::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Testimony created successfully',
                'data' => $testimony
            ], 201);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Failed to create testimony'], 500);
        }
    }

    public function show($id)
    {
        try {
            $testimony = Testimony::with(['member', 'parish'])->findOrFail($id);
            return response()->json(['success' => true, 'data' => $testimony]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Testimony not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $testimony = Testimony::findOrFail($id);
            $testimony->delete();

            return response()->json(['success' => true, 'message' => 'Testimony deleted successfully']);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Failed to delete testimony'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Offering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OfferingController extends Controller
{
    public function index()
    {
        try {
            $offerings = Offering::with(['member', 'parish'])->latest()->get();
            return response()->json(['success' => true, 'data' => $offerings]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Failed to fetch offerings'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'parish_id' => 'required|exists:parishes,id',
                'member_id' => 'nullable|exists:members,id',
                'amount' => 'required|numeric',
                'date' => 'required|date',
                'service_type' => 'required|string',
            ]);

            $offering = Offering::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Offering recorded successfully',
                'data' => $offering
            ], 201);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Failed to store offering'], 500);
        }
    }

    public function show($id)
    {
        try {
            $offering = Offering::with(['member', 'parish'])->findOrFail($id);
            return response()->json(['success' => true, 'data' => $offering]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Offering not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $offering = Offering::findOrFail($id);
            $offering->delete();

            return response()->json(['success' => true, 'message' => 'Offering deleted successfully']);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Failed to delete offering'], 500);
        }
    }
}

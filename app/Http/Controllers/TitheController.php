<?php

namespace App\Http\Controllers;

use App\Models\Tithe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TitheController extends Controller
{
    public function index()
    {
        try {
            $tithes = Tithe::with(['member', 'parish'])->latest()->get();
            return response()->json(['success' => true, 'data' => $tithes]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Failed to fetch tithes'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'parish_id' => 'required|exists:parishes,id',
                'member_id' => 'nullable|exists:members,id',
                'amount' => 'required|numeric',
                'month_year' => 'required|string',
            ]);

            $tithe = Tithe::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Tithe recorded successfully',
                'data' => $tithe
            ], 201);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Failed to store tithe'], 500);
        }
    }

    public function show($id)
    {
        try {
            $tithe = Tithe::with(['member', 'parish'])->findOrFail($id);
            return response()->json(['success' => true, 'data' => $tithe]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Tithe not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $tithe = Tithe::findOrFail($id);
            $tithe->delete();

            return response()->json(['success' => true, 'message' => 'Tithe deleted successfully']);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Failed to delete tithe'], 500);
        }
    }
}

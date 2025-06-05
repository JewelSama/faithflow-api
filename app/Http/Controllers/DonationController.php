<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
    public function index()
    {
        try {
            $donations = Donation::with(['member', 'parish'])->latest()->get();
            return response()->json(['success' => true, 'data' => $donations]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Failed to fetch donations'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'parish_id' => 'required|exists:parishes,id',
                'member_id' => 'nullable|exists:members,id',
                'category' => 'required|string',
                'mode' => 'required|string',
                'amount' => 'required|numeric',
                'donation_date' => 'required|date',
            ]);

            $donation = Donation::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Donation recorded successfully',
                'data' => $donation
            ], 201);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Failed to store donation'], 500);
        }
    }

    public function show($id)
    {
        try {
            $donation = Donation::with(['member', 'parish'])->findOrFail($id);
            return response()->json(['success' => true, 'data' => $donation]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Donation not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $donation = Donation::findOrFail($id);
            $donation->delete();

            return response()->json(['success' => true, 'message' => 'Donation deleted successfully']);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => 'Failed to delete donation'], 500);
        }
    }
}

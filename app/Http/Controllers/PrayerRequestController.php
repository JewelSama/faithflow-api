<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrayerRequest;

class PrayerRequestController extends Controller
{
    public function index()
    {
        try {
            $requests = PrayerRequest::with(['member', 'parish'])->get();

            return response()->json([
                'success' => true,
                'data' => $requests
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch prayer requests.'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'member_id' => 'required|exists:members,id',
                'parish_id' => 'required|exists:parishes,id',
                'request' => 'required|string',
            ]);

            $prayerRequest = PrayerRequest::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Prayer request submitted successfully.',
                'data' => $prayerRequest
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting the request.'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $prayerRequest = PrayerRequest::with(['member', 'parish'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $prayerRequest
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Prayer request not found.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve prayer request.'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $prayerRequest = PrayerRequest::findOrFail($id);
            $prayerRequest->delete();

            return response()->json([
                'success' => true,
                'message' => 'Prayer request deleted successfully.'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Prayer request not found.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete prayer request.'
            ], 500);
        }
    }
}

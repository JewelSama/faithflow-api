<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class MemberController extends Controller
{
    public function index()
    {
        try {
            $members = Member::all();

            return response()->json([
                'success' => true,
                'data' => $members,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch members',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'parish_id' => 'required|exists:parishes,id',
                'full_name' => 'required|string|max:255',
                'gender' => 'required|in:Male,Female',
                'phone' => 'required|string|max:20',
                'email' => 'nullable|email',
                'address' => 'nullable|string|max:255',
                'dob' => 'nullable|date',
                'joined_date' => 'nullable|date',
            ]);

            $member = Member::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Member created successfully',
                'data' => $member,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create member',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $member = Member::with(['parish', 'donations', 'department'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $member,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Member not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve member',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $member = Member::findOrFail($id);

            $member->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Member updated successfully',
                'data' => $member,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Member not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update member',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $member = Member::findOrFail($id);
            $member->delete();

            return response()->json([
                'success' => true,
                'message' => 'Member deleted successfully',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Member not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete member',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function assignDepartment(Request $request, $id)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
        ]);

        $member = Member::findOrFail($id);
        $member->department_id = $request->department_id;
        $member->save();

        return response()->json([
            'success' => true,
            'message' => 'Department assigned to member successfully',
            'data' => $member->load('department'),
        ]);
    }

}

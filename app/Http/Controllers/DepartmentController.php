<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        try {
            $departments = Department::with('parish')->get();
            return response()->json(['success' => true, 'data' => $departments]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error fetching departments', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'parish_id' => 'required|exists:parishes,id',
            ]);

            $department = Department::create([
                'name' => $request->name,
                'parish_id' => $request->parish_id,
            ]);

            return response()->json(['success' => true, 'message' => 'Department created successfully', 'data' => $department], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to create department', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $department = Department::with('parish')->findOrFail($id);
            return response()->json(['success' => true, 'data' => $department]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Department not found', 'error' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'sometimes|string|max:255',
                'parish_id' => 'sometimes|exists:parishes,id',
            ]);

            $department = Department::findOrFail($id);
            $department->update($request->only(['name', 'parish_id']));

            return response()->json(['success' => true, 'message' => 'Department updated successfully', 'data' => $department]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update department', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $department = Department::findOrFail($id);
            $department->delete();

            return response()->json(['success' => true, 'message' => 'Department deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete department', 'error' => $e->getMessage()], 500);
        }
    }
}

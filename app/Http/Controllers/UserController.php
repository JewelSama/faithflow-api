<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();

            return response()->json([
                'success' => true,
                'data' => $users,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch users',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'phone' => 'nullable|string|max:20',
                'password' => 'required|string|min:6',
                'role' => 'required|in:super_admin,parish_admin',
                'parish_id' => 'nullable|exists:parishes,id',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => $request->role,
                'parish_id' => $request->parish_id,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $user,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->update($request->only([
                'name', 'email', 'phone', 'role', 'parish_id',
            ]));

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
                $user->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => $user,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

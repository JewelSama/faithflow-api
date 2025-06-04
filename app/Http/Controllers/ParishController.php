<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parish;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ParishController extends Controller
{
    public function index()
    {
        try {
            $parishes = Parish::all();

            return response()->json([
                'success' => true,
                'data' => $parishes
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch parishes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
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
                'success' => true,
                'message' => 'Parish created successfully',
                'data' => $parish,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create parish',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $parish = Parish::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $parish
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Parish not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve parish',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
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
                'success' => true,
                'message' => 'Parish updated successfully',
                'data' => $parish,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Parish not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update parish',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $parish = Parish::findOrFail($id);
            $parish->delete();

            return response()->json([
                'success' => true,
                'message' => 'Parish deleted successfully',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Parish not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete parish',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function members($id)
    {
        try {
            $parish = Parish::with('members')->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $parish->members
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Parish not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch members',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function departments($id)
    {
        try {
            // $parish = Parish::with('departments')->findOrFail($id);
            $parish = Parish::with(['departments' => function ($query) {
                $query->withCount('members');
            }])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $parish->departments
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Parish not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch departments',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function testimonies($id)
    {
        try {
            $parish = Parish::with([
                'testimonies.member' => function ($query) {
                    $query->select('id', 'full_name');
                },
            ])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $parish->testimonies
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Parish not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch testimonies',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function events($id)
    {
        try {
            $parish = Parish::with([
                'events'
            ])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $parish->events
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Parish not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch events',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function prayerRequests($id)
    {
        try {
            $parish = Parish::with([
                'prayerRequests.member' => function ($query) {
                    $query->select('id', 'full_name');
                },
            ])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $parish->prayerRequests
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Parish not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch prayer requests',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

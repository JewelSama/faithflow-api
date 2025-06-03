<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Parish;

class MemberController extends Controller
{
    public function index()
    {
        return response()->json(Member::all());
    }
   
    public function parishMembers($id)
    {
        $parish = Parish::findOrFail($id);
        return response()->json($parish->members);
    }

    public function store(Request $request)
    {
        $request->validate([
            'parish_id' => 'required|exists:parishes,id',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'joined_date' => 'nullable|date',
        ]);

        $member = Member::create($request->all());

        return response()->json([
            'message' => 'Member created successfully',
            'data' => $member,
        ], 201);
    }

    public function show($id)
    {
        return response()->json(Member::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $member->update($request->all());

        return response()->json([
            'message' => 'Member updated successfully',
            'data' => $member,
        ]);
    }

    public function destroy($id)
    {
        Member::findOrFail($id)->delete();

        return response()->json(['message' => 'Member deleted successfully']);
    }
}

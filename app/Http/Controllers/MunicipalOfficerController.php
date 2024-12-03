<?php

namespace App\Http\Controllers;

use App\Models\MunicipalOfficer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MunicipalOfficerController extends Controller
{
    // List all municipal officers
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        // Fetch paginated officers with order and pagination settings
        $officers = MunicipalOfficer::orderBy('id', 'desc')
            ->paginate($limit, ['*'], 'page', $page);


            $officers->getCollection()->transform(function ($officer) {
                return [
                    'id' => $officer->id,
                    'full_name' => $officer->full_name,
                    'position' => $officer->position,
                    'department' => $officer->department,
                    'image' => $officer->image_url,
                    'created_at' => $officer->created_at,
                    'updated_at' => $officer->updated_at,
                ];
            });

        return response()->json([
            'message' => 'Municipal Officers retrieved successfully',
            'data' => $officers->items(),
            'meta' => [
                'sortBy' => 'id',
                'sortOrder' => 'desc',
                'page' => $officers->currentPage(),
                'limit' => $officers->perPage(),
                'total' => $officers->total(),
                'count' => $officers->count(),
                'totalPages' => $officers->lastPage(),
            ]
        ], 200);
    }

    // Store a new municipal officer
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle image upload if available
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/officers', 'public');
        }

        $officer = MunicipalOfficer::create([
            'full_name' => $request->full_name,
            'position' => $request->position,
            'department' => $request->department,
            'image' => $imagePath,
        ]);

        return response()->json(['status' => 'success', 'data' => $officer], 201);
    }

    // Update a municipal officer
    public function update(Request $request, $id)
    {
        $officer = MunicipalOfficer::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update fields
        $officer->full_name = $request->full_name;
        $officer->position = $request->position;
        $officer->department = $request->department;

        // Handle image upload if available
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($officer->image) {
                Storage::disk('public')->delete($officer->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('images/officers', 'public');
            $officer->image = $imagePath;
        }

        // Save the updated officer
        $officer->save();

        return response()->json(['status' => 'success', 'data' => $officer], 200);
    }

    // Delete a municipal officer by ID
    public function destroy($id)
    {
        $officer = MunicipalOfficer::findOrFail($id);

        // Delete the officer's image if it exists
        if ($officer->image) {
            Storage::disk('public')->delete($officer->image);
        }

        // Delete the officer record
        $officer->delete();

        return response()->json(['status' => 'success', 'message' => 'Officer deleted'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Tourism;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TourismController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        // Fetch paginated news with order and pagination settings
        $tour = Tourism::orderBy('id', 'desc')
                    ->paginate($limit, ['*'], 'page', $page);

        // Transform the paginated items to include the image URL
        $tour->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'desc' => $item->desc,
                'image' => Storage::url($item->image),
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'message' => 'CMS Data retrieved successfully',
            'data' => $tour->items(),
            'meta' => [
                'sortBy' => 'id',
                'sortOrder' => 'desc',
                'page' => $tour->currentPage(),
                'limit' => $tour->perPage(),
                'total' => $tour->total(),
                'count' => $tour->count(),
                'totalPages' => $tour->lastPage(),
            ]
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Typically returns a view for creating news, but we're using JSON, so this can be left empty.
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Handle image upload if provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/tourism', 'public');
        }

        // Create news
        $tour = Tourism::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'image' => $imagePath,
        ]);

        return response()->json([
            'message' => 'Data created successfully',
            'data' => $tour,
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        // Typically returns a view for editing news, but we're using JSON, so this can be left empty.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $tour = Tourism::findOrFail($id);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image from storage if a new one is uploaded
            if ($tour->image) {
                Storage::disk('public')->delete($tour->image);
            }
            $tour->image = $request->file('image')->store('images/tourism', 'public');
        }

        // Update news
        $tour->update([
            'title' => $request->title,
            'desc' => $request->desc,
        ]);

        return response()->json([
            'message' => 'Data updated successfully',
            'data' => $tour,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tour = Tourism::findOrFail($id);

        // Delete the image from storage if it exists
        if ($tour->image) {
            Storage::disk('public')->delete($tour->image);
        }

        // Delete news
        $tour->delete();

        return response()->json([
            'message' => 'Data deleted successfully',
        ], 200);
    }

    public function show($title)
    {
        // Check if the title is numeric (e.g., an ID)
        if (is_numeric($title)) {
            // If numeric, search by ID
            $tour = Tourism::find($title);
        } else {
            // Otherwise, search by title
            $tour = Tourism::where('title', $title)->first();
        }

        // Check if news was found
        if ($tour) {
            return response()->json([
                'message' => 'Data fetched successfully',
                'data' => $tour
            ], 200);
        }

        // If not found, return a 404 response
        return response()->json([
            'message' => 'Data not found',
        ], 404);
    }

}

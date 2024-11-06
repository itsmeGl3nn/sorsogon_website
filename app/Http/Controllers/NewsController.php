<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        // Fetch paginated news with order and pagination settings
        $news = News::orderBy('id', 'desc')
                    ->paginate($limit, ['*'], 'page', $page);

        // Transform the paginated items to include the image URL
        $news->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'description' => $item->description,
                'content' => $item->content,
                'author' => $item->author,
                'category' => $item->category,
                'external' => $item->external,
                'image' => Storage::url($item->image),
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'message' => 'CMS News retrieved successfully',
            'data' => $news->items(),
            'meta' => [
                'sortBy' => 'id',
                'sortOrder' => 'desc',
                'page' => $news->currentPage(),
                'limit' => $news->perPage(),
                'total' => $news->total(),
                'count' => $news->count(),
                'totalPages' => $news->lastPage(),
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
            'description' => 'nullable|string',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category' => 'required|string|max:255',
            'external' => 'nullable|string',
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
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        // Create news
        $news = News::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'author' => $request->author,
            'image' => $imagePath,
            'category' => $request->category,
            'external' => $request->external,
        ]);

        return response()->json([
            'message' => 'News created successfully',
            'data' => $news,
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
            'description' => 'nullable|string',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category' => 'required|string|max:255',
            'external' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $news = News::findOrFail($id);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image from storage if a new one is uploaded
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $news->image = $request->file('image')->store('news_images', 'public');
        }

        // Update news
        $news->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'author' => $request->author,
            'category' => $request->category,
            'external' => $request->external,
        ]);

        return response()->json([
            'message' => 'News updated successfully',
            'data' => $news,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        // Delete the image from storage if it exists
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        // Delete news
        $news->delete();

        return response()->json([
            'message' => 'News deleted successfully',
        ], 200);
    }

    public function show($title)
    {
        // Check if the title is numeric (e.g., an ID)
        if (is_numeric($title)) {
            // If numeric, search by ID
            $news = News::find($title);
        } else {
            // Otherwise, search by title
            $news = News::where('title', $title)->first();
        }

        // Check if news was found
        if ($news) {
            return response()->json([
                'message' => 'News fetched successfully',
                'data' => $news
            ], 200);
        }

        // If not found, return a 404 response
        return response()->json([
            'message' => 'News not found',
        ], 404);
    }

}

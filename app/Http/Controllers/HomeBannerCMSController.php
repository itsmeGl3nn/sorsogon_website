<?php

namespace App\Http\Controllers;

use App\Models\HomeBannerCMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeBannerCMSController extends Controller
{
    // List all banners
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        // Fetch paginated banners with order and pagination settings
        $banners = HomeBannerCMS::orderBy('id', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

        // Transform the paginated items to include the image URL
        $banners->getCollection()->transform(function ($banner) {
            return [
                'id' => $banner->id,
                'title' => $banner->title,
                'image' => $banner->image_url,  // Use the accessor to get full URL
                'created_at' => $banner->created_at,
                'updated_at' => $banner->updated_at,
            ];
        });

        return response()->json([
            'message' => 'CMS Data retrieved successfully',
            'data' => $banners->items(),
            'meta' => [
                'sortBy' => 'id',
                'sortOrder' => 'desc',
                'page' => $banners->currentPage(),
                'limit' => $banners->perPage(),
                'total' => $banners->total(),
                'count' => $banners->count(),
                'totalPages' => $banners->lastPage(),
            ]
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $banner = HomeBannerCMS::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update title
        $banner->title = $request->title;

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image
            Storage::disk('public')->delete($banner->image);

            $imagePath = $request->file('image')->store('images/banners', 'public');
            $banner->image = $imagePath;
        }

        // Save the changes
        $banner->save();

        return response()->json(['status' => 'success', 'data' => $banner], 200);
    }


    // Store a new banner
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $imagePath = $request->file('image')->store('images/banners', 'public');

        $banner = HomeBannerCMS::create([
            'title' => $request->title,
            'image' => $imagePath,
        ]);

        return response()->json(['status' => 'success', 'data' => $banner], 201);
    }

    // Delete a banner by ID
    public function delete($id)
    {
        $banner = HomeBannerCMS::findOrFail($id);
       // Storage::disk('public')->delete($banner->image);
        $banner->delete();

        return response()->json(['status' => 'success', 'message' => 'Banner deleted'], 200);
    }


    public function restore($id)
    {
        $banner = HomeBannerCMS::withTrashed()->find($id);

        if ($banner) {
            $banner->restore(); // Restore the complaint
            return response()->json([
                'message' => 'Banner restored successfully',
                'data' => $banner
            ]);
        }

        return response()->json(['message' => 'Banner not found'], 404);
    }


      public function trashedComplaints(Request $request)
    {
        // Fetch trashed complaints with pagination
        $perPage = $request->input('limit', 10); // Default to 10 items per page if no limit is provided
        $banners = HomeBannerCMS::onlyTrashed()
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        // Transform the collection
        $banners->getCollection()->transform(function ($banner) {
            return [
                'id'           => $banner->id,
                'first_name'   => $banner->first_name,
                'last_name'    => $banner->last_name,
                'address'      => $banner->address,
                'banner'    => $banner->banner,
                'mobile_num'   => $banner->mobile_num,
                'email'        => $banner->email,
                'proof'        => $banner->image_url,
                'created_at'   => $banner->created_at,
                'updated_at'   => $banner->updated_at,
                'deleted_at'   => $banner->deleted_at,
            ];
        });

        return response()->json([
            'message' => 'Trashed banners retrieved successfully',
            'data'    => $banners->items(), // Paginated items
            'meta'    => [
                'sortBy'      => 'id',
                'sortOrder'   => 'desc',
                'page'        => $banners->currentPage(),
                'limit'       => $banners->perPage(),
                'total'       => $banners->total(),
                'count'       => $banners->count(),
                'totalPages'  => $banners->lastPage(),
            ]
        ], 200);
    }

}

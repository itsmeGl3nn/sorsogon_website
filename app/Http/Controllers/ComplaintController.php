<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Storage;
use App\Mail\ComplaintCreated;
use Illuminate\Support\Facades\Mail;

class ComplaintController extends Controller
{
    /**
     * Store a newly created complaint in storage.
     */
    public function create(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'address'    => 'required|string|max:255',
            'complaint'  => 'required|string|max:255',
            'mobile_num' => 'required|string|max:15',
            'email'      => 'required|string|email|max:255',
            'proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:3048',
        ]);

        $imagePath = $request->file('proof')->store('images/complaints', 'public');

        // Create a new complaint record in the database
        $complaint = Complaint::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'address'    => $request->address,
            'complaint'  => $request->complaint,
            'mobile_num' => $request->mobile_num,
            'email'      => $request->email,
            'proof' => $imagePath,
        ]);

        // Send email notification
        Mail::to($request->email)->send(new ComplaintCreated($complaint));

        // Return a response
        return response()->json([
            'message' => 'Complaint created successfully. A confirmation email has been sent.',
            'data'    => $complaint
        ], 201);
    }

    public function getcomplaint(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        $complaints = Complaint::orderBy('id', 'desc')
            ->whereNull('deleted_at') // Exclude soft-deleted records
            ->paginate($limit, ['*'], 'page', $page);

        $complaints->getCollection()->transform(function ($complaint) {
            return [
                'id'           => $complaint->id,
                'first_name'   => $complaint->first_name,
                'last_name'    => $complaint->last_name,
                'address'      => $complaint->address,
                'complaint'    => $complaint->complaint,
                'mobile_num'   => $complaint->mobile_num,
                'email'        => $complaint->email,
                'proof' => $complaint->image_url,
                'created_at'   => $complaint->created_at,
                'updated_at'   => $complaint->updated_at,
            ];
        });


        return response()->json([
            'message' => 'Complaints retrieved successfully',
            'data'    => $complaints->items(),
            'meta'    => [
                'sortBy'      => 'id',
                'sortOrder'   => 'desc',
                'page'        => $complaints->currentPage(),
                'limit'       => $complaints->perPage(),
                'total'       => $complaints->total(),
                'count'       => $complaints->count(),
                'totalPages'  => $complaints->lastPage(),
            ]
        ], 200);
    }


    public function delete($id)
    {


        $complaint = Complaint::findOrFail($id);
      //  Storage::disk('public')->delete($complaint->proof);


        // Delete the complaint record
        $complaint->delete();

        return response()->json([
            'message' => 'Complaint deleted successfully'
        ], 200);
    }


    public function trashedComplaints(Request $request)
    {
        // Fetch trashed complaints with pagination
        $perPage = $request->input('limit', 10); // Default to 10 items per page if no limit is provided
        $complaints = Complaint::onlyTrashed()
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        // Transform the collection
        $complaints->getCollection()->transform(function ($complaint) {
            return [
                'id'           => $complaint->id,
                'first_name'   => $complaint->first_name,
                'last_name'    => $complaint->last_name,
                'address'      => $complaint->address,
                'complaint'    => $complaint->complaint,
                'mobile_num'   => $complaint->mobile_num,
                'email'        => $complaint->email,
                'proof'        => $complaint->image_url,
                'created_at'   => $complaint->created_at,
                'updated_at'   => $complaint->updated_at,
                'deleted_at'   => $complaint->deleted_at,
            ];
        });

        return response()->json([
            'message' => 'Trashed complaints retrieved successfully',
            'data'    => $complaints->items(), // Paginated items
            'meta'    => [
                'sortBy'      => 'id',
                'sortOrder'   => 'desc',
                'page'        => $complaints->currentPage(),
                'limit'       => $complaints->perPage(),
                'total'       => $complaints->total(),
                'count'       => $complaints->count(),
                'totalPages'  => $complaints->lastPage(),
            ]
        ], 200);
    }

    public function restore($id)
    {
        $complaint = Complaint::withTrashed()->find($id);

        if ($complaint) {
            $complaint->restore(); // Restore the complaint
            return response()->json([
                'message' => 'Complaint restored successfully',
                'data' => $complaint
            ]);
        }

        return response()->json(['message' => 'Complaint not found'], 404);
    }
}

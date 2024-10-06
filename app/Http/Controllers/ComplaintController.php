<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

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
            'email'      => 'required|string|email|max:255|unique:complaints,email',
        ]);

        // Create a new complaint record in the database
        $complaint = Complaint::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'address'    => $request->address,
            'complaint'  => $request->complaint,
            'mobile_num' => $request->mobile_num,
            'email'      => $request->email,
        ]);

        // Return a response
        return response()->json([
            'message' => 'Complaint created successfully',
            'data'    => $complaint
        ], 201);
    }


    public function getcomplaint(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        $complaints = Complaint::orderBy('id', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

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

        $complaint = Complaint::find($id);

        if (!$complaint) {
            return response()->json([
                'message' => 'Complaint not found'
            ], 404);
        }

        $complaint->delete();
        return response()->json([
            'message' => 'Complaint deleted successfully'
        ], 200);
    }
}

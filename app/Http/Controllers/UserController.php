<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        $users = User::orderBy('id', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'message' => 'Appointments retrieved successfully',
            'data'    => $users->items(),
            'meta'    => [
                'sortBy'      => 'id',
                'sortOrder'   => 'desc',
                'page'        => $users->currentPage(),
                'limit'       => $users->perPage(),
                'total'       => $users->total(),
                'count'       => $users->count(),
                'totalPages'  => $users->lastPage(),
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'role'       => 'required|string|max:50',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'role'       => $request->role,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'data'    => $user
        ], 201);
    }

    public function delete($id)
    {
        $users = User::find($id);

        if (!$users) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $users->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }
}

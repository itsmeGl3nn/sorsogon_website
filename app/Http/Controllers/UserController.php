<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request){
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
}

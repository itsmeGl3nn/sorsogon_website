<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!auth()->attempt($credentials)) {
            return response()->json(['error' => 'The provided credentials do not match our records.'], 401);
        }

        $user = auth()->user();
        $token = JWTAuth::fromUser($user);
        $expiration = JWTAuth::setToken($token)->getPayload()->get('exp');
        return response()->json([
            'user' => $user,
            'message' => 'success',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expiration - time(),
        ]);
    }


    public function refresh()
    {
        $user = auth()->user();
        $token = JWTAuth::refresh(JWTAuth::getToken());
        $expiration = JWTAuth::setToken($token)->getPayload()->get('exp');
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expiration - time()
        ]);
    }

}

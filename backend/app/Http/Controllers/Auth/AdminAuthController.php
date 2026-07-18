<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        if (!Auth::guard('admin')->attempt($credentials)) {

            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }


        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();


        $token = $admin->createToken('admin-token')->plainTextToken;


        return response()->json([
            'message' => 'Login successful',
            'admin' => $admin,
            'token' => $token,
        ]);
    }


    public function profile(Request $request)
    {
        return response()->json([
            'admin' => $request->user(),
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();


        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}

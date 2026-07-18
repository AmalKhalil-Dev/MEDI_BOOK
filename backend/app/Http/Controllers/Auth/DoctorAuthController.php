<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        if (!Auth::guard('doctor')->attempt($credentials)) {

            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }


        /** @var \App\Models\Doctor $doctor */
        $doctor = Auth::guard('doctor')->user();


        $token = $doctor->createToken('doctor-token')->plainTextToken;


        return response()->json([
            'message' => 'Login successful',
            'doctor' => $doctor,
            'token' => $token,
        ]);
    }


    public function profile(Request $request)
    {
        return response()->json([
            'doctor' => $request->user(),
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

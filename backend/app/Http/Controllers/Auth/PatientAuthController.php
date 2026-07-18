<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PatientAuthController extends Controller
{

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'password' => 'required|string|min:8',
        ]);


        $patient = Patient::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);


        return response()->json([
            'message' => 'Patient registered successfully',
            'patient' => $patient,
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        if (!Auth::guard('patient')->attempt($credentials)) {

            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        /** @var \App\Models\Patient $patient */
        $patient = Auth::guard('patient')->user();

        $token = $patient->createToken('patient-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'patient' => $patient,
            'token' => $token,
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'patient' => $request->user(),
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

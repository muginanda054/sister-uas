<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validateuser = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'usertype' => 'required'
            ]
            );
 
            if ($validateuser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateuser->errors()
                ],401);
            }
 
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
 
            return response()->json([
                'status' => true,
                'message' => 'User sukses dibuat',
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            // Return Json Response
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validateuser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required',
                ]
            );
 
            if ($validateuser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateuser->errors()
                ], 401);
            }
 
            if (!Auth::attempt(($request->only(['email','password'])))) {
                return response()->json(['status' => false,
                    'status' => false,
                    'message' => 'Terjadi kesalahan',
                ],401);
            }
 
            $user = User::where('email', $request->email)->first();
 
            return response()->json([
                'status' => true,
                'message' => 'Sukses login',
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ], 200);
 
        } catch (\Throwable $th) {
            // Return Json Response
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function profile()
    {
        // Profile Detail 
        $userData = auth()->user();
 
        // Return Json Response
        return response()->json([
            'status' => true,
            'message' => 'Profile Info',
            'data' => $userData,
            'id' => auth()->user()->id,
        ], 200);
    }
 
    public function logout()
    {
        auth()->user()->tokens()->delete();
 
        // Return Json Response
        return response()->json([
            'status' => true,
            'message' => 'Sukses Logout',
            'data' => []
        ], 200);
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:100'],
            'email'    => ['required','email','unique:users,email'],
            'password' => ['required','string','min:6'],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('mobile')->plainTextToken;

        return $this->success([
            'user'  => $user,
            'token' => $token,
        ], 'Registered', 201);
    }

   public function login(Request $request)
{
    $data = $request->validate([
        'email'    => ['required','email'],
        'password' => ['required','string'],
    ]);

    $user = User::where('email', $data['email'])->first();

    if (! $user || ! Hash::check($data['password'], $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $token = $user->createToken('mobile')->plainTextToken;

    return response()->json([
        'status' => true,
        'message' => 'Logged in',
        'data' => [
            'user'  => $user,
            'token' => $token,
        ]
    ], 200);
}


    public function me(Request $request)
    {
        return $this->success($request->user(), 'Me');
    }

    public function logout(Request $request)
    {
        // إلغاء التوكين الحالي فقط
        $request->user()->currentAccessToken()->delete();
        return $this->success(null, 'Logged out');
    }
}

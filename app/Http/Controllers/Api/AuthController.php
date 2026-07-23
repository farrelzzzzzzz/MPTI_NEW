<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Register a new user via API.
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password'              => ['required', 'confirmed', Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil.',
            'user'    => $user,
            'token'   => $token,
        ], 201);
    }

    /**
     * Login via API and return JWT token.
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Check if user exists and is locked out
        $user = User::where('email', $request->email)->first();

        if ($user && $user->isLocked()) {
            $remaining = $user->getRemainingLockTime();
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda terkunci. Silakan coba lagi dalam ' . $remaining . '.',
                'locked_until' => $user->locked_until,
            ], 429);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            // Failed login: increment attempts for existing user
            if ($user) {
                $user->incrementLoginAttempts();
            }

            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah.',
            ], 401);
        }

        // Successful login: reset login attempts
        if ($user) {
            $user->resetLoginAttempts();
        }

        $user = auth()->user();

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil.',
            'user'    => $user,
            'token'   => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }

    /**
     * Get the authenticated user.
     */
    public function me(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'user'    => auth()->user(),
        ]);
    }

    /**
     * Logout (invalidate token).
     */
    public function logout(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil.',
        ]);
    }

    /**
     * Refresh a token.
     */
    public function refresh(): JsonResponse
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());

            return response()->json([
                'success' => true,
                'message' => 'Token berhasil diperbarui.',
                'token'   => $newToken,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat memperbarui token.',
            ], 401);
        }
    }
}


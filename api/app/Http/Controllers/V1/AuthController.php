<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    /**
     * @param LoginUserRequest $request
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        $request->validated($request->all());
        if (! Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('', 'Credentials are not matched', 401);
        }
        $data = User::where('email', $request->email)->first();
        return response()->json([
            'data' => $data,
            'token' => $data->createToken('API token of ' . $data->name)->plainTextToken
        ]);
    }

    /**
     * @param UserRequest $request
     * @return UserResource
     */
    public function register(UserRequest $request): UserResource
    {
        $request->validated($request->all());
        $data = User::create([
            'name' => $request->name,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return new UserResource($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Token deleted'
        ], 201);
    }
}

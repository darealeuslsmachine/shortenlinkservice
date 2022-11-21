<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthPostRequest;

class AuthController extends Controller
{
    /**
     * Register user & get api token
     *
     * @param AuthPostRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(AuthPostRequest $request) {

        $validatedFields = $request->validated();

        $user = User::create([
            'name' => $validatedFields['name'],
            'email' => $validatedFields['email'],
            'password' => Hash::make($validatedFields['password'])
        ]);

        $token = $user->createToken('apptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token'=> $token
        ];

        return response($response, 201);
    }

    /**
     * Delete user api token
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        $response = [
            'message' => 'Logged out'
        ];

        return response($response, 201);
    }

    /**
     * Get authorization token
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //Check email
        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                    'message' => 'Bad creds'
            ], 401);
        }

        return response(['token'=> $user->showToken('apptoken')->plainTextToken], 201);
    }
}

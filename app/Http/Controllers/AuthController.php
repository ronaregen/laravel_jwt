<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hobby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }



    public function register()
    {
        $validator = Validator::make(request()->all(), [
            'nama' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'integer|required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $user = User::create([
            'nama' => request('nama'),
            'email' => request('email'),
            'phone' => request('phone'),
            'password' => Hash::make(request('password'))
        ]);

        if ($user) {
            $hobbies = request('hobbies');
            foreach ($hobbies as $hobby) {
                $userhobby = [
                    'user_id' => $user->id,
                    'hobby' => $hobby['hobby']
                ];
                Hobby::create($userhobby);
            }
            return response()->json(['message' => 'Registered Successfully']);
        } else {
            return response()->json(['message' => 'Failed to Register'], 501);
        }
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    public function me()
    {
        $user = User::with('Hobby')->where('id', auth()->user()->id)->first();
        return response()->json($user);
    }


    public function update()
    {
        $user = User::where('id', auth()->user()->id)->update([
            'nama' => request('nama'),
            'phone' => request('phone')
        ]);

        if ($user) {
            return response()->json(['message' => 'Updated Successfully']);
        } else {
            return response()->json(['message' => 'Update Failed']);
        }
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}

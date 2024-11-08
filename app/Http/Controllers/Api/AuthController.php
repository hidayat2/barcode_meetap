<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
        {
            $validator = Validator::make(
                $request->all(),
                [
                'username' => 'required',
                'password' => 'required',
                ]);

                    if($validator->fails())
                    {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'validation error',
                        'errors' => $validator->errors(),
                        'data'  =>[]
                    ]);
                    }

                    $user = User::where('username', $request->username)->first();

                    if(!$user || !Hash::check($request->password, $user->password))
                    {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'User/Password salah',
                    ],);
                    }

                    $token = $user->createToken('auth_token')->plainTextToken;

                    return response()->json([
                        'status' => 'success',
                        'message' => 'oke',
                        'data' => [
                            'id' => $user->id,
                            'nama' => $user->nama,
                            'token' => $token
                            ]
                        ], 200);
            }

            public function logout(Request $request)
                {
                    $user = $request->user();

                    if($user)
                    {
                        $user->tokens()->delete();
                        return response()->json([
                        'status' => 'success',
                        'message' => 'logout berhasil',
                        ], 200);
                    } else {
                        return response()->json([
                        'status' => 'failde',
                        'message' => 'user tidak ditemukan atau sudah logout',

                        ], 404);

                    }
                }


}

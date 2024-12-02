<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowUserRequestApi;
use App\Http\Requests\StoreUserRequestApi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequestApi $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user){
            return response()->json([
                'message' => 'El correo ya esta en uso'
            ], 422);
        }
        $user = User::create($request->all());

        return response()->json([
            'message' => 'Usuario registrado con exito',
            'user' => $user,
            'token' => $user->createToken("Auth_Token")->plainTextToken
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowUserRequestApi $request)
    {
        $request->validated();

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password) || !$user->is_active){
            return response()->json([
                'message' => 'Credenciales invalidas',
            ], 422);
        }

        return response()->json([
            'user' => $user,
            'token' => $user->createToken("Auth_Token")->plainTextToken
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada con exito'
        ], 200);
    }
}

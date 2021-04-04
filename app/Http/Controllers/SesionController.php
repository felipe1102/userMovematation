<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SesionController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            "email" => "required",
            "password" => "required|string"
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'   => $validator->errors()->all(),
                'errors'    => 'Dados invalidos'
            ], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Error in Login',
                'error' => 'Usuário ou senha incorretos'
            ], 400);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso',
            'data' => [
                'user'=> $user,
                'token' => $token
            ]
        ], 200);
    }

    public function logoff(){
        Auth::user()
            ->tokens()
            ->delete();

        return response()->json([
            'message' => 'Logoff realizado com sucesso',
        ], 201);
    }
}

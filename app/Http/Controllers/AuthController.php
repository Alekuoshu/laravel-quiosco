<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistroRequest;
use function Symfony\Component\String\b;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        // validar el login
        $data = $request->validated();

        // Revisar credenciales
        if (!auth()->attempt($data)) {
            return response([
                'errors' => ['Credenciales incorrectas']
            ], 422);
        } else {
            // Retornar una respuesta
            $user = Auth::user();
            return [
                'token' => $user->createToken('token')->plainTextToken,
                'user' => $user
            ];
        }
    }

    public function register(RegistroRequest $request)
    {
        // validar el registro
        $data = $request->validated();

        // crear el usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // Retornar una respuesta
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return [
            'user' => null,
            'message' => 'Sesión cerrada'
        ];
    }
}

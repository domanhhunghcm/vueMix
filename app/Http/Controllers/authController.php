<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
class authController extends Controller
{
    public function register(Request $request)
    {
        $data=$request->validate([
            "name"=>"required|string",
            "email"=>"required|unique:users,email|string",
            "password"=>[
                "required",
                "confirmed",
                Password::min(8)->mixedCase()->numbers()->symbols()
            ]
        ]);
        $user=User::create([
            "name"=>$data["name"],
            "email"=>$data["email"],
            "password"=>bcrypt($data["password"])
        ]);
        $token=$user->createToken("main")->plainTextToken;
        return response([
            "user"=>$user,
            "token"=>$token
        ]);

    }
}

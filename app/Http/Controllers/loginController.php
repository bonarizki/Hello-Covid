<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = User::where('email', $request->email)->first();
        $remember = $request->has('remember') ? true : false;
        if ($data != null) {
            if (Hash::check($request->password, $data->password)) {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                    return response()->json(["data" => "success", "message" => "login success"], 200);
                } else {
                    response()->json(["data" => "error", "message" => "internal server error"], 500);
                }
            } else {
                return response()->json(["data" => "password", "message" => "password not valid"], 400);
            }
        } else {
            return response()->json(["data" => "email", "message" => "email not valid"], 400);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/login');
    }
}

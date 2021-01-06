<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class loginController extends Controller
{
    public function login(LoginRequest $request)
    {
        dd($request);
    }
}

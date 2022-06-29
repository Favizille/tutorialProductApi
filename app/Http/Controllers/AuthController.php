<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);

        $user = User::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'email' => $fields ['email'],
            'password' => bcrypt($fields['password']),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User has successfully registered',
            'data' => $user,
        ]);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

            //check email
            $user = User::where('email', $fields ['email'])->first();

            //check password
            if (!$user || !Hash::check($fields['password'],$user->password)) {
                return response([
                    'status'=>'fail',
                    'message' => 'Invalid Login Credentials'
                ],422);
            }

            return response([
                'status' => 'success',
                'message' => 'User successfully logged in'
            ],200);
    }

}

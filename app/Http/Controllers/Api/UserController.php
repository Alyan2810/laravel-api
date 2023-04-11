<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
            $validatedData = $request->validate([
            'name' => 'required',
            'email' => ['required' , 'email'],
            'password' => ['min:8' , 'confirmed']
            
        ]);
        
        // $email = User::where('email' ,'=', $validatedData['email'])->get();
        //  echo "<pre>";
        //  print_r($email);
        //  die;
        
        $user = User::create($validatedData);
        // echo "<pre>";
        // print_r($user);
        // die;
        $token = $user->createToken('auth_token')->accessToken;
        // echo "<pre>";
        // print_r($token);
        // die;
        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => 'User Created successfully',
            'status' => 1
        ]);
    }
    public function login(Request $request)
    {
     
        $validatedData = $request->validate([
            'email' => ['required' , 'email'],
            'password' => [ 'required']
            
        ]);
       
        $user = User::where(['email' =>$validatedData['email'] ,  'password' =>$validatedData['password']])->first();
        $token = $user->createToken('auth_token')->accessToken;
        // echo "<pre>";
        // print_r($token);
        // die;
        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => 'User Login successfully',
            'status' => 1
        ]);
    }
    public function getUser($id)
    {
        $user = User::find($id);
       
       if(is_null($user))
       {
        return response()->json([
            'user' => null,
            'message' => 'User Not Found',
            'status' => 0
        ],400);
       }
       else
       {
        return response()->json([
            'user' => $user,
            'message' => 'User Found successfully',
            'status' => 1
        ],200);
       }
        
    }
}

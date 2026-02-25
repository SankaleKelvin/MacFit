<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request){
        $validated=$request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:3|max:15|confirmed',
            'user_image'=>'nullable|string|max:255|mimes:jpeg,jpg,png',
            'role_id'=>'required|integer|exists:roles,id',
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->role_id = $validated['role_id'];

        if($request->hasFile('user_image')){
            $filename = $request->file('user_image')->store('users', 'public');
        } else{
            $filename = null;
        }
        $user->user_image = $filename;

        try{
            $user->save();
            return response()->json($user);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Registration Failed',
                'message'=>$exception->getMessage()
            ], 500);
        }
    }

    public function login(Request $request){
        $validated=$request->validate([
            'email'=>'required|email',
            'password'=>'required|string|min:3|max:15',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if(!$user || !Hash::check($validated['password'], $user->password)){
            throw ValidationException::withMessages([
                'error'=>'Invalid Credentials'
            ], 401);
        }

        $token = $user->createToken('auth-token')->plainTextToken;
        return response()->json([
            'message'=>'Login Successful',
            'token'=>$token,
            'user'=>$user
        ], 201);


    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json("Logout Successful");
    }
}

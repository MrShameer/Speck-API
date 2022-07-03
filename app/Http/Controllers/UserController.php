<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        $user->sendEmailVerificationNotification();

		if(!$user->exists){
			return response()->json([
				'message' => 'Cannot register'
			], 401);
		}
        $user->createToken('auth_token')->plainTextToken;

        session()->flash('message', 'Your registration is Successful. Please check your email to verify your account.');

        return redirect()->to('/register');
    }

    public function verify($user_id, Request $request) {
        if (!$request->hasValidSignature()) {
            return redirect()->to('/');
        }
        $user = User::findOrFail($user_id);
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
        $message = 'E-MEL anda telah Disahkan';
        return view('welcome',compact('message'));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'E-MEL atau Kata Laluan Tidak Sah',
            ], 401);
        }
        
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Butiran Log Masuk Tidak Sah'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        if (!$user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Sila Sahkan E-MEL Anda'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }

}

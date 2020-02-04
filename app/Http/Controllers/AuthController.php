<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
class AuthController extends Controller
{
    public function register(UserRegisterRequest $request) {
      $user = User::create([
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'password' => bcrypt($request->password),
      ]);

      if(!$token = auth()->attempt($request->only(['email', 'password']))) {
        return abort(401);
      };

      return (new UserResource($request->user()))->additional([
        'meta' => [
          'token' => $token,
        ],
      ]);
    }

    public function login(UserLoginRequest $request) {
      if(!$token = auth()->attempt($request->only(['email', 'password']))) {
        return response()->json([
          'errors' => [
            'email' => ['Sorry, we the username or password is incorrect.'],
          ],
        ], 422);
      }

      return (new UserResource($request->user()))->additional([
        'meta' => [
          'token' => $token,
        ],
      ]);
    }

    public function user(Request $request){
      return new UserResource($request->user());
    }

    public function logout(Request $request){
      auth()->logout();
    }

    public function userUpdate(Request $request){
      $user = auth()->guard('api')->user();
      $user->first_name = $request->get('first_name', $user->first_name);
      $user->last_name = $request->get('last_name', $user->last_name);
      $user->email = $request->get('email', $user->email);
      $user->phone_number = $request->get('phone_number', $user->phone_number);
      $user->save();
      return $user;
    }




}

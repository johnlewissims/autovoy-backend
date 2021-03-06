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
    public function register(Request $request) {
      $user = User::create([
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'update_settings' => $request->update_settings,
        'zip' => $request->zip,
        'referral' => $request->referral,
        'user_type' => $request->user_type,
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
      // return (new UserResource($request->user()))->additional([
      //   'test' => 'A Test',
      // ]);
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
      $cleanedNumber = preg_replace("/[^a-zA-Z0-9]/", "", $request->phone_number);

      $user->phone_number = $cleanedNumber;
      $user->save();
      return $user;
    }

    //Get All Users for Admin Panel
    public function usersList(Request $request){
      $user = auth()->guard('api')->user();
      $adminIds = array(1, 2, 3, 8, 30);
      if(in_array($user->id, $adminIds)) {
        $users = User::select('first_name','last_name', 'email', 'phone_number', 'zip', 'referral', 'created_at')->orderBy('id', 'DESC')->get();
        return $users;
      } else {
        return response()->json('Forbidden', 403);
      }
    }




}

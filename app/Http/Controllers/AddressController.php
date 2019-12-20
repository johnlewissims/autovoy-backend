<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\User;

class AddressController extends Controller
{
  //Create Address
  public function createAddress(Request $request, Address $address){
    $newAddress = Address::create([
      'street' => $request->street,
    ]);

    //Associate With User
    $user = auth()->guard('api')->user();
    $newAddress->user()->associate($user->id);
    $newAddress->save();

    return $address;
  }
}

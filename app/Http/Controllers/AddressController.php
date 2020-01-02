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
      'lng' => $request->lng,
      'lat' => $request->lat,
      'street' => $request->street,
      'street_number' => $request->street_number,
      'city' => $request->city,
      'state' => $request->state,
      'country' => $request->country,
      'postal_code' => $request->postal_code,
    ]);

    //Associate With User
    $user = auth()->guard('api')->user();
    $newAddress->user()->associate($user->id);
    $newAddress->save();

    return $newAddress;
  }
}

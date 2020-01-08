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
      'street_address' => $request->street_address,
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

  //Patch Address
  public function patch(Request $request, Address $address){
    $user = auth()->guard('api')->user();
    if($user->id == $address->user_id) {
      $address->lat = $request->get('lat', $address->lat);
      $address->lng = $request->get('lng', $address->lng);
      $address->street_address = $request->get('street_address', $address->street_address);
      $address->city = $request->get('city', $address->city);
      $address->state = $request->get('state', $address->state);
      $address->country = $request->get('country', $address->country);
      $address->postal_code = $request->get('postal_code', $address->postal_code);
      $address->save();
      return $address;
    }
  }
}

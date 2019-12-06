<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;

class AddressController extends Controller
{
  //Create Address
  public function createAddress(Request $request, Address $address){
    $address = Address::create([
      'street' => $request->street,
    ]);

    return $address;
  }
}

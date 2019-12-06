<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;

class ListingController extends Controller
{
  //Create Listing
  public function createListing(Request $request, Listing $listing){
    $listing = Listing::create([
      'title' => $request->title,
    ]);

    return $listing;
  }

  //Attach Listing to Pickup Address
  public function pickupAddress(Request $request, Listing $listing){
    $listing->pickupAddress()->attach($request->pickup_address_id);
    return $listing;
  }

  //Attach Listing to Dropoff Address
  public function dropoffAddress(Request $request, Listing $listing){
    $listing->dropoffAddress()->attach($request->dropoff_address_id);
    return $listing;
  }
}

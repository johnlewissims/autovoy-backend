<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;
use App\User;

class ListingController extends Controller
{
  //Create Listing
  public function createListing(Request $request, Listing $listing){
    $newListing = Listing::create([
      'title' => $request->title,
    ]);

    //Associate With User
    $user = auth()->guard('api')->user();
    $newListing->user()->associate($user->id);
    $newListing->save();

    return $newListing;
  }

  //Attach Listing to Pickup Address
  public function pickupAddress(Request $request, Listing $listing){
    $listing->pickup()->associate($request->pickup_address_id);
    $listing->save();
    return $listing;
  }

  //Attach Listing to Dropoff Address
  public function dropoffAddress(Request $request, Listing $listing){
    $listing->dropoff()->associate($request->dropoff_address_id);
    $listing->save();
    return $listing;
  }

  //Get Listing
  public function getListing(Listing $listing){
    $selectedListing = Listing::with('pickup', 'dropoff', 'user')->get();
    return $selectedListing;
  }
}

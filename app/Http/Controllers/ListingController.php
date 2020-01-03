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
      'vin' => $request->vin,
      'trailer_type' => $request->trailer_type,
      'running' => $request->running,
      'payment' => $request->payment,
      'price' => $request->price,
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
    $selectedListing = Listing::where('id', $listing->id)->with('pickup', 'dropoff', 'user')->get();
    return $selectedListing;
  }

  //Get All Listings
  public function getAllListings(Listing $listing){
    $allListings = Listing::with('pickup', 'dropoff', 'user')->get();
    return $allListings;
  }

  //Get All Listings by User
  public function myListings(Listing $listing){
    $user = auth()->guard('api')->user();
    $allListings = Listing::where('user_id', $user->id)->with('pickup', 'dropoff', 'user')->get();
    return $allListings;
  }

  //Patch Listing
  public function patch(Request $request, Listing $listing){
    $user = auth()->guard('api')->user();
    if($user->id == $listing->user_id) {
      $listing->title = $request->get('title', $listing->title);
      $listing->trailer_type = $request->get('trailer_type', $listing->trailer_type);
      $listing->running = $request->get('running', $listing->running);
      $listing->payment = $request->get('payment', $listing->payment);
      $listing->price = $request->get('price', $listing->price);
      $listing->save();
      return $listing;
    }
  }
}

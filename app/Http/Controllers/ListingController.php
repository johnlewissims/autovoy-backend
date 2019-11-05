<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListingController extends Controller
{
  public function createListing(Request $request, Listing $listing){
    // $watermark = Comment::create([
    //   'video_id' => $video->id,
    //   'user_id' => $request->user_id,
    //   'comment' => $request->comment,
    // ]);

    return response()->json(['response' => 'The listing has been added.'], 200);
  }
}

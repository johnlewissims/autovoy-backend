<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SubscribeController extends Controller
{
  public function intent() {
    $user = auth()->guard('api')->user();
    return $user->createSetupIntent();
  }

  public function createSubscription(Request $request){
    //User Information
    $user = auth()->guard('api')->user();

    $paymentMethodID = $request->get('payment_method');
    //return $request;

    if( $user->stripe_id == null ){
        $user->createAsStripeCustomer();
    }

    $user->addPaymentMethod( $paymentMethodID );
    $user->updateDefaultPaymentMethod( $paymentMethodID );

    return response()->json( null, 204 );
  }

  public function getPaymentMethods() {
    $user = auth()->guard('api')->user();
    $methods = array();

    if( $user->hasPaymentMethod() ){
        foreach( $user->paymentMethods() as $method ){
            array_push( $methods, [
                'id' => $method->id,
                'brand' => $method->card->brand,
                'last_four' => $method->card->last4,
                'exp_month' => $method->card->exp_month,
                'exp_year' => $method->card->exp_year,
            ] );
        }
    }

    return response()->json( $methods );
  }
}

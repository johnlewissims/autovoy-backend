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

  public function removePaymentMethod( Request $request ){
    $user = auth()->guard('api')->user();
    $paymentMethodID = $request->get('id');

    $paymentMethods = $user->paymentMethods();

    foreach( $paymentMethods as $method ){
      if( $method->id == $paymentMethodID ){
        $method->delete();
        break;
      }
    }

    return response()->json( null, 204 );
  }

  public function updateSubscription( Request $request ){
    $user = auth()->guard('api')->user();
    $planID = $request->get('plan');
    $paymentID = $request->get('payment');

    if( !$user->subscribed() ){
        $user->newSubscription( 'Subscription', $planID )
                ->create( $paymentID );
    } else {
        $user->subscription('Subscription')->swap( $planID );
    }

    return response()->json([
        'subscription_updated' => true
    ]);
  }

  public function cancelSubscription( Request $request ){
    $user = auth()->guard('api')->user();
    $user->subscription('Subscription')->cancel();

    return response()->json([
        'subscription_canceled' => true
    ]);
  }

  public function getCurrentSubscription( Request $request ){
    $user = auth()->guard('api')->user();
    $subscriptionStatus = [];
    if($user->asStripeCustomer()["subscriptions"]["data"]) {
      $nextBilling = ["renewal_date" => \Carbon\Carbon::createFromTimeStamp($user->asStripeCustomer()["subscriptions"]->data[0]["current_period_end"])->toFormattedDateString()];
      $canceled = ["canceled" => $user->asStripeCustomer()["subscriptions"]->data[0]["cancel_at_period_end"]];
      array_push($subscriptionStatus, $user->asStripeCustomer()["subscriptions"]->data[0]['plan'], $nextBilling, $canceled);
    }

    return $subscriptionStatus;
  }
}

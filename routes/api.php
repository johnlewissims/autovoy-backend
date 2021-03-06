<?php

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/user', 'AuthController@user')->middleware('auth:api');
Route::get('/users-list', 'AuthController@usersList')->middleware('auth:api');
Route::post('/user/update', 'AuthController@userUpdate')->middleware('auth:api');
Route::post('/logout', 'AuthController@logout');
Route::post('/forgot/password', 'ForgotPasswordController@forgot');

Route::group(['prefix' => 'listing'], function(){
  Route::post('/', 'ListingController@createListing')->middleware('auth:api');
  Route::post('/pickup-address/{listing}', 'ListingController@pickupAddress')->middleware('auth:api');
  Route::post('/dropoff-address/{listing}', 'ListingController@dropoffAddress')->middleware('auth:api');;
  Route::get('/{listing}', 'ListingController@getListing')->middleware('auth:api');
  Route::get('/', 'ListingController@getAllListings')->middleware('auth:api');
  Route::post('/update/{listing}', 'ListingController@patch');
  Route::post('/toggle/{listing}', 'ListingController@toggleListing');
});
Route::get('/my-listings', 'ListingController@myListings');

Route::group(['prefix' => 'address'], function(){
  Route::post('/', 'AddressController@createAddress')->middleware('auth:api');
  Route::post('/update/{address}', 'AddressController@patch');
});
//Route::get('/', 'VideoController@index')->middleware('auth:api');

Route::group(['prefix' => 'subscribe'], function(){
  Route::get('/intent', 'SubscribeController@intent')->middleware('auth:api');
  Route::get('/payment-methods', 'SubscribeController@getPaymentMethods')->middleware('auth:api');
  Route::get('/current-subscription', 'SubscribeController@getCurrentSubscription')->middleware('auth:api');
  Route::post('/', 'SubscribeController@createSubscription')->middleware('auth:api');
  Route::post('/remove', 'SubscribeController@removePaymentMethod')->middleware('auth:api');
  Route::post('/subscription', 'SubscribeController@updateSubscription')->middleware('auth:api');
  Route::post('/cancel', 'SubscribeController@cancelSubscription')->middleware('auth:api');
});


?>

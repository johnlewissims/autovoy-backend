<?php

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/user', 'AuthController@user');
Route::post('/logout', 'AuthController@logout');

Route::post('/logout', 'AuthController@logout');

Route::group(['prefix' => 'listing'], function(){
  Route::post('/', 'ListingController@createListing')->middleware('auth:api');
  Route::post('/pickup-address/{listing}', 'ListingController@pickupAddress')->middleware('auth:api');
  Route::post('/dropoff-address/{listing}', 'ListingController@dropoffAddress')->middleware('auth:api');;
  Route::get('/{listing}', 'ListingController@getListing')->middleware('auth:api');
  Route::get('/', 'ListingController@getAllListings')->middleware('auth:api');
  Route::post('/update/{listing}', 'ListingController@patch');
});
Route::get('/my-listings', 'ListingController@myListings');

Route::group(['prefix' => 'address'], function(){
  Route::post('/', 'AddressController@createAddress')->middleware('auth:api');
  Route::post('/update/{address}', 'AddressController@patch');
});
//Route::get('/', 'VideoController@index')->middleware('auth:api');

?>

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
  Route::get('/{listing}', 'ListingController@getListing')->middleware('auth:api');;
});

Route::group(['prefix' => 'address'], function(){
  Route::post('/', 'AddressController@createAddress');
});
//Route::get('/', 'VideoController@index')->middleware('auth:api');

?>

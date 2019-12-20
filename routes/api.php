<?php

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/user', 'AuthController@user');
Route::post('/logout', 'AuthController@logout');

Route::post('/logout', 'AuthController@logout');

Route::group(['prefix' => 'listing'], function(){
  Route::post('/', 'ListingController@createListing');
  Route::post('/pickup-address/{listing}', 'ListingController@pickupAddress');
  Route::post('/dropoff-address/{listing}', 'ListingController@dropoffAddress');
  Route::get('/{listing}', 'ListingController@getListing');
});

Route::group(['prefix' => 'address'], function(){
  Route::post('/', 'AddressController@createAddress');
});
//Route::get('/', 'VideoController@index')->middleware('auth:api');

?>

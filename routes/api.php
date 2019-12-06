<?php

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/user', 'AuthController@user');
Route::post('/logout', 'AuthController@logout');

Route::post('/logout', 'AuthController@logout');

Route::group(['prefix' => 'listing'], function(){
  Route::post('/', 'ListingController@createListing');
  Route::put('/pickupAddress/{listing}', 'ListingController@pickupAddress');
  Route::put('/dropoffAddress/{listing}', 'ListingController@dropoffAddress');
});

Route::group(['prefix' => 'address'], function(){
  Route::post('/', 'AddressController@createAddress');
});
//Route::get('/', 'VideoController@index')->middleware('auth:api');

?>

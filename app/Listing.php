<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
  protected $fillable = [
      'user_id', 'pickup_address_id', 'dropoff_address_id', 'title'
  ];

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function pickupAddress()
  {
      return $this->hasMany('App\Address', 'id', 'pickup_address_id');
  }

  public function dropoffAddress()
  {
      return $this->hasMany('App\Address', 'id', 'dropoff_address_id');
  }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  protected $fillable = [
      'user_id', 'street_number', 'lat', 'lng', 'street', 'city', 'state', 'country', 'postal_code', 'postal_code_suffix'
  ];
  public function user()
  {
      return $this->belongsTo('App\User');
  }
}

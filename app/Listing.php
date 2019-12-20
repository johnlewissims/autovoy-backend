<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
  protected $fillable = [
      'user_id', 'pickup_id', 'dropoff_id', 'title'
  ];
  public function user()
  {
      return $this->belongsTo('App\User');
  }
  public function pickup()
  {
      return $this->belongsTo('App\Address', 'pickup_id');
  }
  public function dropoff()
  {
      return $this->belongsTo('App\Address', 'dropoff_id');
  }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddressListingUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('address_listing_user', function (Blueprint $table) {
          $table->string('pickup_address_id')->nullable();
          $table->string('dropoff_address_id')->nullable();  
          $table->string('listing_id')->nullable();
          $table->string('user_id')->nullable();
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

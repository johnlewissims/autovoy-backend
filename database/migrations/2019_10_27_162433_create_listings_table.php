<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('pickup_id')->nullable();
            $table->bigInteger('dropoff_id')->nullable();
            $table->string('title')->nullable();
            $table->string('trailer_type')->nullable();
            $table->string('running')->nullable();
            $table->string('payment')->nullable();
            $table->string('price')->nullable();
            $table->string('vin')->nullable();
            $table->bigInteger('hidden')->nullable();
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
        Schema::dropIfExists('listings');
    }
}

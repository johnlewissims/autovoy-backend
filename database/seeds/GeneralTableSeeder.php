<?php

use Illuminate\Database\Seeder;

class GeneralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'first_name' => 'John',
          'last_name' => 'Sims',
          'email' => 'john@ejincollective.com',
          'password' => bcrypt('password'),
      ]);

      DB::table('addresses')->insert([
          'user_id' => 1,
      ]);

      DB::table('listings')->insert([
          'user_id' => 1,
          'pickup_id' => 1,
          'dropoff_id' => 1,
          'title' => 'Chevy Equinox',
      ]);
    }
}

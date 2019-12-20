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
    }
}
